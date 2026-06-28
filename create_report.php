<?php
	// include database and object files
	include_once 'database.php';
	include_once 'objects/report.php';
	 
	// instantiate database class
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$report = new report($db);
	 
	// set values
	$report->report=$_POST['report'];
	$report->title=$_POST['title'];
	$report->userid=$_POST['userid'];
	$report->reporting_from=$_POST['reporting_from'];
	$report->post_comment_id=$_POST['post_comment_id'];
	$report->victim_reported=$_POST['victim_reported'];

	         
	// create report
	$report->create();
?>
