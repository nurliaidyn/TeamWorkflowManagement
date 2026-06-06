CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    status ENUM('todo', 'in_progress', 'done') DEFAULT 'todo',
    assignee_name VARCHAR(100),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



INSERT INTO tasks (project_id, title, status, assignee_name) VALUES
(1, 'Draft schema.sql and data.sql files', 'todo', 'Niko'),
(1, 'Implement API endpoints for transaction history', 'in_progress', 'Janar');