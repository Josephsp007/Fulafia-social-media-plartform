<?php
	// get report id
	$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: report ID not found.');
	 
	// include database and object files
	include_once 'database.php';
	include_once 'objects/report.php';
	 
	// instantiate database and report object
	$database = new Database();
	$db = $database->getConnection();
	 
	// initialize object
	$report = new report($db);
	 
	// set report id property
	$report->id=$id;
	 
	// read single report
	$report->readOne();
	
	//GET TITLE AND ATTACHMENT, CHECK IF EMPTY OR NOT ON TITLE HIDDEN INPUT BELOW
		$stmt = "SELECT * FROM report WHERE id=:id";
		$stmt = $db-> prepare($stmt);
		$stmt-> bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row=$stmt->fetch();
		$attachment = $row["attachment"];
		$title = $row["title"];
?>


	<!--we have our html form here where new report information will be entered-->
					<div class="blank">
    						<div class="widget-area no-padding"  style="margin-bottom:80px!important">
								<div class="status-upload">
									<form id='update-report-form' action='#' method='post' border='0'>
									<input type='hidden' name='id' value='<?php echo $id ?>' /> 
									<input type='hidden' name='title' value='<?php if(empty($attachment)){echo $title;}else{echo "reported with attachment";}?>' /> 
										<textarea name='report' class='form-control' required><?php echo htmlspecialchars($report->report);?></textarea>
										
								<button type="submit" class="btn btn-navy" style="text-transform:none; margin-top:12px!important;">Done 
								<i style="vertical-align:bottom" class="fa fa-check"></i> </button>
									
				<span id="read-report" class="btn btn-navy" style="text-transform:none; margin-top:12px!important; margin-right:4px!important; padding:6.5px 10px 6.5px 10px; float:right">
									&nbsp; Report Page&nbsp;
									<i style="vertical-align:bottom" class="fa fa-home"></i>&nbsp;</span>
									</form>
								</div><!-- Status Upload  -->
								
							</div><!-- Widget Area -->
						</div>



<script>
$('#read-report').click(function(){
     
    // show a loader img
    $('#loader-image').show();
     
    // hide read products button
    $('#read-report').hide();
     
    // show products
    showReport();
});
</script>
