<?php
require_once '../include/config.php'; // Adjust this path to your actual config file

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['group_id']) && filter_var($_POST['group_id'], FILTER_VALIDATE_INT)) {
$groupId = (int)$_POST['group_id'];

session_start(); // Ensure session is started here as well
if (isset($_SESSION['user_login'])) {
    $userid = $_SESSION['user_login'];

    try {
        // 1. Delete the user's membership from group_members table
        $stmt = $pdo->prepare("DELETE FROM group_members WHERE group_id = :group_id AND user_id = :user_id");
        if ($stmt->execute([':group_id' => $groupId, ':user_id' => $userid])) {
            // Check if any row was actually deleted (user was a member)
            if ($stmt->rowCount() > 0) {
                // 2. Decrement the group's member count
                $updateGroupStmt = $pdo->prepare("UPDATE groups SET member_count = member_count - 1 WHERE group_id = :group_id");
                $updateGroupStmt->execute([':group_id' => $groupId]);

                $response['status'] = 'success';
                $response['message'] = 'Successfully left the group.';
            } else {
                $response['message'] = 'You are not a member of this group.';
            }
        } else {
            $response['message'] = 'Failed to leave the group. Database error.';
        }
    } catch (PDOException $e) {
        error_log("Database error in leave_group.php: " . $e->getMessage());
        $response['message'] = 'A database error occurred. Please try again later.';
    }
} else {
    $response['message'] = 'User not logged in.';
}
} else {
$response['message'] = 'Invalid group ID.';
}
} else {
$response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit();
?>