<?php
	// include database and object files
	include_once 'database.php';
	include_once 'objects/contact.php';
	 
	// instantiate database class
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$contact = new contact($db);
	 
	// set values
	$contact->contact=$_POST['contact'];
	$contact->title=$_POST['title'];
	$contact->userid=$_POST['userid'];
	$contact->contacted = time();
	         
	// create contact
	$contact->create();
?>
