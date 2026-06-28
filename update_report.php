<?php
	// include database and object files
	include_once 'database.php';
	include_once 'objects/report.php';
	 
	// instantiate database and report object
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$report = new report($db);
	 
	// set values
	$report->report=$_POST['report'];
	$report->id=$_POST['id'];
	$report->title=$_POST['title'];
	
	// update 
	$report->update();
?>