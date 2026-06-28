<?php
// Include your database connection file (e.g., config.php or db_connect.php)
// Make sure $pdo is initialized and connected to your database
require_once '../include/config.php'; // Adjust this path to your actual config file
 session_start();
$userid = intval($_SESSION['user_login']);



header('Content-Type: application/json'); // Set header to indicate JSON response






$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


// Check if group_id is provided and is a valid integer
if (isset($_POST['group_id']) && filter_var($_POST['group_id'], FILTER_VALIDATE_INT)){
    
    $groupId = $_POST['group_id'];
    

        try {
            // 1. Check if the user is already a member of the group
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM group_members WHERE group_id = :group_id AND user_id = :user_id");
            $stmt->execute([':group_id' => $groupId, ':user_id' => $userid]);
            $isMember = $stmt->fetchColumn();

            if ($isMember > 0) {
                $response['message'] = 'You are already a member of this group.';
            } else {
                // 2. Insert the user into the group_members table
                $stmt = $pdo->prepare("INSERT INTO group_members (group_id, user_id) VALUES (:group_id, :user_id)");
                if ($stmt->execute([':group_id' => $groupId, ':user_id' => $userid])) {
                    // 3. Update the group's member count (optional, but good practice)
                    $updateGroupStmt = $pdo->prepare("UPDATE groups SET member_count = member_count + 1 WHERE group_id = :group_id");
                    $updateGroupStmt->execute([':group_id' => $groupId]);

                    $response['status'] = 'success';
                    $response['message'] = 'Successfully joined the group!';
                } else {
                    $response['message'] = 'Failed to join the group. Database error.';
                }
            }
        } catch (PDOException $e) {
            // Log the error for debugging
            error_log("Database error in join_group.php: " . $e->getMessage());
            $response['message'] = 'A database error occurred. Please try again later.';
        }
    } else {
        $response['message'] = 'User not logged in.';
    }
} else {
    $response['message'] = 'Invalid group ID.';
}

echo json_encode($response);
exit(); // Always exit after sending JSON response
?>