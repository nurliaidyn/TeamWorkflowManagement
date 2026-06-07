// script.js

document.addEventListener("DOMContentLoaded", () => {
    // ==========================================
    // 1. SELECTORS & VARIABLES
    // ==========================================
    const cards = document.querySelectorAll('.task-card');
    const columns = document.querySelectorAll('.kanban-column'); 
    
    // Chat & Modal Selectors
    const modalElement = document.getElementById('kanbanTaskModal');
    const taskModal = modalElement ? new bootstrap.Modal(modalElement) : null;
    const chatHistory = document.getElementById('chatHistory');
    const commentForm = document.getElementById('commentForm');
    const commentInput = document.getElementById('commentInput');
    const activeTaskIdInput = document.getElementById('activeTaskId');

    let originalColumn = null; 
    let isDragging = false; // NEW: Flag to prevent modal from opening on drop

    // ==========================================
    // 2. MAIN CARD LOGIC (Drag & Click)
    // ==========================================
    cards.forEach(card => {
        
        // --- DRAG START ---
        card.addEventListener('dragstart', () => {
            isDragging = true; 
            card.classList.add('dragging');
            originalColumn = card.closest('.kanban-column'); 
        });

        // --- DRAG END & DATABASE FETCH ---
        card.addEventListener('dragend', () => {
            card.classList.remove('dragging');
            
            // NEW: Give the browser 100ms to ignore the 'click' event caused by dropping
            setTimeout(() => { isDragging = false; }, 100);
            
            const newColumn = card.closest('.kanban-column');
            if (!newColumn || originalColumn === newColumn) return; 

            const newStatus = newColumn.dataset.status;
            const taskId = card.id; 

            fetch('controllers/update_task.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ task_id: taskId, new_status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Database confirmed:', data.message);
                } else {
                    console.error('Server error:', data.message);
                    revertCard(card, originalColumn); 
                }
            })
            .catch(error => {
                console.error('Network error connecting to the API:', error);
                revertCard(card, originalColumn); 
            });
        });

        // --- CLICK TO OPEN CHAT MODAL ---
        card.addEventListener('click', (e) => {
            // NEW: If the user just dropped the card, abort opening the chat!
            if (isDragging || !taskModal) return;

            const taskId = card.id.replace('task-', '');
            const taskTitle = card.querySelector('.card-text') ? card.querySelector('.card-text').innerText : 'Task Details';

            document.getElementById('modalTaskTitle').innerText = taskTitle;
            activeTaskIdInput.value = taskId;
            
            chatHistory.innerHTML = '<div class="text-center text-secondary mt-5"><div class="spinner-border spinner-border-sm"></div> Loading discussion...</div>';
            taskModal.show();

            fetch(`controllers/get_comments.php?task_id=${taskId}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    renderComments(data.comments, data.current_user_id);
                }
            });
        });
    });

    // ==========================================
    // 3. COLUMN DROP ZONES (FIXED)
    // ==========================================
    columns.forEach(column => {
        column.addEventListener('dragover', e => {
            e.preventDefault(); // REQUIRED to allow dropping
            column.classList.add('drag-over');
        });

        column.addEventListener('dragleave', () => {
            column.classList.remove('drag-over');
        });

        // NEW: Only append the HTML element when the user lets go of the mouse
        column.addEventListener('drop', e => {
            e.preventDefault();
            column.classList.remove('drag-over');
            
            const draggingCard = document.querySelector('.dragging');
            const taskList = column.querySelector('.task-list');
            
            if (draggingCard && taskList) {
                taskList.appendChild(draggingCard);
            }
        });
    });

    // ==========================================
    // 4. SUBMIT NEW COMMENT
    // ==========================================
    if (commentForm) {
        commentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const taskId = activeTaskIdInput.value;
            const text = commentInput.value;
            const submitBtn = commentForm.querySelector('button');
            
            submitBtn.disabled = true;

            fetch('controllers/add_comment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ task_id: taskId, comment_text: text })
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                if (data.status === 'success') {
                    commentInput.value = ''; 
                    
                    const newComment = {
                        author_id: data.author_id,
                        nickname: data.nickname,
                        comment_text: text,
                        created_at: data.created_at
                    };
                    
                    appendCommentToUI(newComment, data.author_id);
                    chatHistory.scrollTop = chatHistory.scrollHeight; 
                }
            });
        });
    }

    // ==========================================
    // 5. HELPER FUNCTIONS
    // ==========================================
    function revertCard(card, targetColumn) {
        if (targetColumn) {
            const taskList = targetColumn.querySelector('.task-list');
            taskList.appendChild(card);
            alert("Failed to save changes to the database. The card has been reverted.");
        }
    }

    function renderComments(comments, currentUserId) {
        chatHistory.innerHTML = ''; 
        if (comments.length === 0) {
            chatHistory.innerHTML = '<div class="text-center text-secondary mt-5">No comments yet. Start the conversation!</div>';
            return;
        }
        comments.forEach(c => appendCommentToUI(c, currentUserId));
        chatHistory.scrollTop = chatHistory.scrollHeight; 
    }

    function appendCommentToUI(comment, currentUserId) {
        if (chatHistory.innerHTML.includes('No comments yet')) {
            chatHistory.innerHTML = ''; 
        }

        const isMe = String(comment.author_id) === String(currentUserId);
        const alignmentClass = isMe ? 'text-end' : 'text-start';
        const bubbleColor = isMe ? 'bg-primary text-white' : 'bg-secondary bg-opacity-25 text-light';
        const nameDisplay = isMe ? 'You' : comment.nickname;

        const timeString = new Date(comment.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

        const html = `
            <div class="mb-3 ${alignmentClass}">
                <div class="small text-secondary mb-1 px-1">${nameDisplay} <span class="ms-2 opacity-50" style="font-size: 0.7rem;">${timeString}</span></div>
                <div class="d-inline-block p-2 px-3 rounded shadow-sm ${bubbleColor}" style="max-width: 85%; text-align: left;">
                    ${comment.comment_text}
                </div>
            </div>
        `;
        
        chatHistory.insertAdjacentHTML('beforeend', html);
    }
});