<?php
	// include database and object files
	include_once 'database.php';
	include_once 'objects/contact.php';
	 
	// instantiate database and contact object
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$contact = new contact($db);
	$contact->id=$_POST['id'];
	$contact->delete();
?>