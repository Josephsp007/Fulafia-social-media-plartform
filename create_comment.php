<?php
// include database and object files
include_once 'database.php';
include_once 'objects/comment.php';


session_start();

$userid = intval($_SESSION['user_login']);


// instantiate database class
$database = new Database();
$db = $database->getConnection();

// initialize object
$comment = new comment($db);

// set values
$comment->comment=$_POST['comment'];
$comment->post_id=$_POST['post_id'];
$comment->userid= $userid;
$comment->posted = time();

// create comment
$comment->create();







//RETURN TO INDEX PAGE IF THE COMMENTED WITH COMMENT BOX

//Check if current user commented

if(isset($_POST['comment'])){
$post_id = intval($_POST['post_id']);

$sql =$db->prepare("SELECT * FROM postcomments WHERE post_id =:post_id");
$sql->bindParam(':post_id', $post_id, PDO::PARAM_STR);
$sql->execute();
if($sql->rowCount()>0){
	echo $sql->rowCount()."
	<script>
	Toast.fire({
	icon: 'success',
	title: 'Comment submitted'
	})
	</script>";
}
}


