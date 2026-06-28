<?php
	// include database and object files
	include_once 'database.php';
	include_once 'objects/comment.php';
	 
	// instantiate database and comment object
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$comment = new comment($db);
	 
	// set values
	$comment->comment=$_POST['comment'];
	$comment->com_id=$_POST['com_id'];
	     
	// update 
	$comment->update();
?>