// script.js
const cards = document.querySelectorAll('.task-card');
const columns = document.querySelectorAll('.column');

// 1. Add listeners to all cards
cards.forEach(card => {
    card.addEventListener('dragstart', () => {
        card.classList.add('dragging');
    });

    card.addEventListener('dragend', () => {
        card.classList.remove('dragging');
        
        // FUTURE PHP PREPARATION:
        // Here is where we will eventually grab the card's ID 
        // and its new parent column's status, and send it to PHP!
        const newStatus = card.closest('.column').dataset.status;
        const taskId = card.id;
        console.log(`Ready for PHP: Update ${taskId} to status: ${newStatus}`);
    });
});

// 2. Allow columns to accept drops
columns.forEach(column => {
    column.addEventListener('dragover', e => {
        e.preventDefault(); // Required to allow dropping
        const draggingCard = document.querySelector('.dragging');
        const taskList = column.querySelector('.task-list');
        taskList.appendChild(draggingCard);
    });
});



// Initialize the Bootstrap Modal
const taskModal = new bootstrap.Modal(document.getElementById('taskModal'));

// Add click listeners to all cards
cards.forEach(card => {
    card.addEventListener('click', (e) => {
        // Prevent opening if the user is just dragging the card
        if (card.classList.contains('dragging')) return;

        // Get the task ID and title from the clicked card
        const taskId = card.id;
        const taskTitle = card.querySelector('.card-text').innerText;

        // Populate the modal inputs
        document.getElementById('modalTaskId').value = taskId;
        document.getElementById('modalTaskTitle').value = taskTitle;
        
        // FUTURE PHP: Here we would use fetch() to get the full description 
        // and current status from the MySQL database based on the taskId.
        document.getElementById('modalTaskDescription').value = "Sample description loaded for " + taskId;

        // Show the modal
        taskModal.show();
    });
});

// Handle the Save Button
document.getElementById('saveTaskChanges').addEventListener('click', () => {
    const updatedId = document.getElementById('modalTaskId').value;
    const updatedTitle = document.getElementById('modalTaskTitle').value;
    
    console.log(`Ready for PHP: Update task ${updatedId} with new title: ${updatedTitle}`);
    
    // Close the modal
    taskModal.hide();
});