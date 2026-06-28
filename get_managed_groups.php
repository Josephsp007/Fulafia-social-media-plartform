<?php
require_once '../include/config.php'; // Adjust this path to your actual config file

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => 'An unknown error occurred.', 'groups' => []);

session_start();
if (isset($_SESSION['user_login'])) {
    $currentUserId = $_SESSION['user_login'];

    try {
        // Fetch categories to send to the frontend for the select dropdown
        // This ensures the frontend has the correct list of categories
        $stmtCategories = $pdo->prepare("SELECT category_id, category_name FROM group_categories ORDER BY category_name ASC");
        $stmtCategories->execute();
        $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("
            SELECT g.*, c.category_name
            FROM groups g
            JOIN group_categories c ON g.category_id = c.category_id
            WHERE g.admin = :admin_id
            ORDER BY g.group_name ASC
        ");
        $stmt->execute([':admin_id' => $currentUserId]);
        $managedGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response['status'] = 'success';
        $response['message'] = 'Managed groups fetched successfully.';
        $response['groups'] = $managedGroups;
        $response['categories'] = $categories; // Include categories in the response

    } catch (PDOException $e) {
        error_log("Database error in get_managed_groups.php: " . $e->getMessage());
        $response['message'] = 'A database error occurred. Please try again later.';
    }
} else {
    $response['message'] = 'User not logged in.';
}

echo json_encode($response);
exit();
?>