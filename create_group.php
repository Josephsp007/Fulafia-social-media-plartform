<?php
// Include your database connection file
require_once '../include/config.php'; // Adjust this path to your actual config file

// Set header to indicate JSON response
header('Content-Type: application/json');

// Start session to get user ID
session_start();

$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_login'])) {
        $response['message'] = 'You must be logged in to create a group.';
        echo json_encode($response);
        exit();
    }

    $adminId = $_SESSION['user_login']; // The creator is the admin

    // Get and sanitize input data
    $group_name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT); 
    $privacy = filter_input(INPUT_POST, 'privacy', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // Basic validation
    if (empty($group_name) || empty($description) || $category_id === false || empty($privacy)) {
        $response['message'] = 'All fields are required and valid.';
        echo json_encode($response);
        exit();
    }

    

    $color = '#FFFFFF'; // Default color, or get from input
    $member_count = 1; // The creator is the first member


    // Create an array of image filenames
    $imageFilenames = [];
    for ($i = 1; $i <= 12; $i++) {
    $imageFilenames[] = "eblaze_illustrate{$i}.png";
    }

    // Shuffle the array to randomize order
    shuffle($imageFilenames);

    // Get a random filename (first element after shuffle)
    $cover = $imageFilenames[0];



    try {
        // Start a transaction to ensure both inserts succeed or fail together
        $pdo->beginTransaction();

        // 1. Insert into 'groups' table
        $stmt = $pdo->prepare("INSERT INTO groups (group_name, category_id, admin, color, cover, description, member_count, privacy) VALUES (:group_name, :category_id, :admin, :color, :cover, :description, :member_count, :privacy)
        ");

        $stmt->execute([
            ':group_name' => $group_name,
            ':category_id' => $category_id,
            ':admin' => $adminId, // Set the creator's user_id as the admin
            ':color' => $color,
            ':cover' => $cover,
            ':description' => $description,
            ':member_count' => $member_count,
            ':privacy' => $privacy,
        ]);

        $newGroupId = $pdo->lastInsertId(); // Get the ID of the newly created group

        // 2. Insert the creator as a member in 'group_members' table
        $stmt = $pdo->prepare(" INSERT INTO group_members (group_id, user_id, is_admin)
            VALUES (:group_id, :user_id, 1)");
        $stmt->execute([
            ':group_id' => $newGroupId,
            ':user_id' => $adminId
        ]);

        // If both inserts are successful, commit the transaction
        $pdo->commit();

        $response['status'] = 'success';
        $response['message'] = 'Group "' . $group_name . '" created successfully!';
        $response['group_id'] = $newGroupId; // Optionally return the new group ID

    } catch (PDOException $e) {
        // Rollback the transaction on error
        $pdo->rollBack();
        // Log the error for debugging (e.g., to a file or a service like Sentry)
        error_log("Database error creating group: " . $e->getMessage());
        $response['message'] = 'Failed to create group: ' . $e->getMessage();
        // For production, you might want a more generic message:
        // $response['message'] = 'Failed to create group. Please try again later.';
    }

} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit();
?>