// script.js

document.addEventListener("DOMContentLoaded", () => {
    // 1. Selectors
    const cards = document.querySelectorAll('.task-card');
    const columns = document.querySelectorAll('.kanban-column'); // Make sure your HTML uses 'kanban-column'
    
    // Check if modal exists on the page before initializing (prevents errors on other pages)
    const modalElement = document.getElementById('taskModal');
    const taskModal = modalElement ? new bootstrap.Modal(modalElement) : null;

    // Track where a card started in case the database update fails
    let originalColumn = null; 

    // ==========================================
    // DRAG AND DROP & API LOGIC
    // ==========================================
    
    cards.forEach(card => {
        // --- DRAG START ---
        card.addEventListener('dragstart', () => {
            card.classList.add('dragging');
            originalColumn = card.closest('.kanban-column'); // Remember starting position
        });

        // --- DRAG END & DATABASE FETCH ---
        card.addEventListener('dragend', () => {
            card.classList.remove('dragging');
            
            const newColumn = card.closest('.kanban-column');
            const newStatus = newColumn.dataset.status;
            const taskId = card.id; // e.g., "task-101"
            
            // If the user dropped the card in the exact same column, do nothing
            if (originalColumn === newColumn) return;

            // Send data to PHP asynchronously 
            fetch('controllers/update_task.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    task_id: taskId,
                    new_status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Database confirmed:', data.message);
                    if (typeof updateCounters === "function") updateCounters(); 
                } else {
                    console.error('Server error:', data.message);
                    revertCard(card, originalColumn); // Snap back on failure
                }
            })
            .catch(error => {
                console.error('Network error connecting to the API:', error);
                revertCard(card, originalColumn); // Snap back on failure
            });
        });

        // ==========================================
        // MODAL CLICK LOGIC
        // ==========================================
        
        card.addEventListener('click', (e) => {
            // Prevent opening the modal if the user is just dragging the card
            if (card.classList.contains('dragging') || !taskModal) return;

            // Get the task ID and title from the clicked card
            const taskId = card.id;
            const taskTitle = card.querySelector('.card-text') ? card.querySelector('.card-text').innerText : 'Task Title';

            // Populate the modal inputs
            document.getElementById('modalTaskId').value = taskId;
            document.getElementById('modalTaskTitle').value = taskTitle;
            document.getElementById('modalTaskDescription').value = "Loading description from database...";

            // Show the modal
            taskModal.show();
        });
    });

    // ==========================================
    // COLUMN DROP ZONES
    // ==========================================
    
    columns.forEach(column => {
        column.addEventListener('dragover', e => {
            e.preventDefault(); // Required to allow dropping
            
            // Add visual highlight to the column being hovered
            column.classList.add('drag-over');
            
            const draggingCard = document.querySelector('.dragging');
            const taskList = column.querySelector('.task-list');
            
            if (draggingCard && taskList) {
                taskList.appendChild(draggingCard);
            }
        });

        // Remove the visual highlight when the card leaves the column
        column.addEventListener('dragleave', () => {
            column.classList.remove('drag-over');
        });

        // Remove the visual highlight when the card is dropped
        column.addEventListener('drop', () => {
            column.classList.remove('drag-over');
        });
    });

    // ==========================================
    // MODAL SAVE ACTION
    // ==========================================
    
    const saveBtn = document.getElementById('saveTaskChanges');
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            const updatedId = document.getElementById('modalTaskId').value;
            const updatedTitle = document.getElementById('modalTaskTitle').value;
            
            console.log(`Ready for PHP: Update task ${updatedId} with new title: ${updatedTitle}`);
            
            // Future: Add a fetch() request here to update the title/description in the DB!
            
            taskModal.hide();
        });
    }

    // ==========================================
    // HELPER FUNCTIONS
    // ==========================================
    
    function revertCard(card, targetColumn) {
        if (targetColumn) {
            const taskList = targetColumn.querySelector('.task-list');
            taskList.appendChild(card);
            alert("Failed to save changes to the database. The card has been reverted.");
            if (typeof updateCounters === "function") updateCounters();
        }
    }
});