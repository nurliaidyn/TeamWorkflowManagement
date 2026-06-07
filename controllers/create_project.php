<?php
session_start();
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['name']) && isset($data['start_date']) && isset($_SESSION['user_id'])) {
    try {
        $pdo->beginTransaction();

        $sqlProject = "INSERT INTO projects (name, description, start_date, end_date, created_by) 
                       VALUES (:name, :description, :start_date, :end_date, :created_by)";
        
        $stmtProject = $pdo->prepare($sqlProject);
        $stmtProject->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'] ?? '',
            ':start_date'  => $data['start_date'],
            ':end_date'    => !empty($data['end_date']) ? $data['end_date'] : null,
            ':created_by'  => $_SESSION['user_id']
        ]);

        $projectId = $pdo->lastInsertId();

        $sqlMember = "INSERT INTO project_members (project_id, user_id, project_role) 
                      VALUES (:project_id, :user_id, 'lead')";
        
        $stmtMember = $pdo->prepare($sqlMember);
        $stmtMember->execute([
            ':project_id' => $projectId,
            ':user_id'    => $_SESSION['user_id']
        ]);

        if (isset($data['team_members']) && is_array($data['team_members'])) {
            $sqlTeam = "INSERT INTO project_members (project_id, user_id, project_role) 
                        VALUES (:project_id, :user_id, 'active')";
            $stmtTeam = $pdo->prepare($sqlTeam);
            
            foreach ($data['team_members'] as $member_id) {
                if (is_numeric($member_id)) {
                    $stmtTeam->execute([
                        ':project_id' => $projectId,
                        ':user_id'    => (int)$member_id
                    ]);
                }
            }
        }


        $pdo->commit();

        echo json_encode([
            'status'      => 'success',
            'id'          => $projectId,
            'name'        => htmlspecialchars($data['name']),
            'description' => htmlspecialchars($data['description'] ?? '')
        ]);

    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
}
?>


