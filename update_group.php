<?php
require_once '../include/config.php'; // Adjust this path to your actual config file

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

session_start();
if (!isset($_SESSION['user_login'])) {
    $response['message'] = 'You must be logged in to update a group.';
    echo json_encode($response);
    exit();
}

$currentUserId = $_SESSION['user_login'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $groupId = filter_input(INPUT_POST, 'group_id', FILTER_VALIDATE_INT);
    $group_name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
    $privacy = filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // Basic validation
    if ($groupId === false || empty($group_name) || empty($description) || $category_id === false || empty($privacy)) {
        $response['message'] = 'Invalid or missing data for update.';
        echo json_encode($response);
        exit();
    }

    try {
        // First, verify that the logged-in user is indeed the admin of this group
        $stmtCheckAdmin = $pdo->prepare("SELECT admin, member_count FROM groups WHERE group_id = :group_id");
        $stmtCheckAdmin->execute([':group_id' => $groupId]);
        $groupData = $stmtCheckAdmin->fetch(PDO::FETCH_ASSOC);

        if (!$groupData || $groupData['admin'] != $currentUserId) {
            $response['message'] = 'You do not have permission to update this group.';
            echo json_encode($response);
            exit();
        }

        // Proceed with update
        $stmtUpdate = $pdo->prepare("
            UPDATE groups
            SET
                group_name = :group_name,
                description = :description,
                category_id = :category_id,
                privacy = :privacy
            WHERE group_id = :group_id
        ");

        $success = $stmtUpdate->execute([
            ':group_name' => $group_name,
            ':description' => $description,
            ':category_id' => $category_id,
            ':privacy' => $privacy,
            ':group_id' => $groupId
        ]);

        if ($success) {
            // Fetch the category name for the updated category_id to send back to frontend
            $stmtCategoryName = $pdo->prepare("SELECT category_name FROM group_categories WHERE category_id = :category_id");
            $stmtCategoryName->execute([':category_id' => $category_id]);
            $category_name = $stmtCategoryName->fetchColumn();

            $response['status'] = 'success';
            $response['message'] = 'Group updated successfully!';
            $response['updated_data'] = [
                'group_name' => $group_name,
                'description' => $description,
                'category_id' => $category_id,
                'category_name' => $category_name, // Send back the name
                'privacy' => $privacy,
                'member_count' => $groupData['member_count'] // Use the member_count fetched earlier
            ];

        } else {
            $response['message'] = 'Failed to update group. No changes made or database error.';
        }

    } catch (PDOException $e) {
        echo("Database error updating group: " . $e->getMessage());
        $response['message'] = 'A database error occurred during update. Please try again later.';
    }

} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit();
?>