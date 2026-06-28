<?php

include('include/config.php');
session_start();

if(!isset($_SESSION["user_login"])){
	header("location: login.php");
}
		
		$userid = $_SESSION["user_login"];		
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid=:userid");
		$stmt->execute(array(":userid"=>$userid));
		$row=$stmt->fetch();

		//DESTROY POSTING SESSION IF URL IS NOT COMMENT.PHP
		$link = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		if($link != "comment.php" && isset($_SESSION['postid'])){
		unset($_SESSION['postid']);
		}

?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	

<script src="js/jquery.min.js"></script>
<script src="js/jquery3.5.min.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script src="js/emojionearea.min.js"></script>
	<script
			 src="js/jquery-3.5.0.js"
			  integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
			  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="js/emojionearea.min.css">

	<!-- Loader CSS -->
	<link rel="stylesheet" href="css/loader-style.css">

		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap4.css">
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/welcome-style.css">

</head>




<body>

<?php
include('include/header.php');
?>



	<div class="ts-main-content">
	<?php include('include/leftbar.php');?>


		<div class="content-wrapper">
		<div class="container-fluid">
		
		
	<!--ONLINE USERS RIGHT BAR-->
	<?php include('include/right-bar.php');?>
	<!--/ONLINE USERS RIGHT BAR-->	
		
		
		
		<div class="col-md-12">
		<div class="row">
		<div class="panel panel-default">
									
									
		<div class="panel-heading">
		FeedBack | Contact Us
		</div>
									

	
	<div class="panel-body">

		
			<div id='success' class="display-none success alert"><span class="closebtn">×</span> 
			<font style="font-family:tahoma; font-weight:700">Feedback Received</font> <i class="fa fa-check-square"></i>
			<br> Thank You. We Will Be In Touch!</div>
			
			<div id='img_success' class="display-none success alert"><span class="closebtn">×</span> 
			<font style="font-family:tahoma; font-weight:700">File(s) Received </font> <i class="fa fa-check-square"></i>
			<br>Thank You. We Will Be In Touch!</div>
			<br>
			<div id='contact-content'></div> 
			
            	<!--USE THIS AS LOADER IMAGE - ADD THE CSS FROM CSS FOLDER-->
             <div id='loader-image'>
			<div id="loader-wrapper">
				<div id="loader"></div>
				</div>
			</div>
		<!--/LOADER IMAGE-->
		
			<script src="js/load-contact/contactscript.js"></script>
	
	
<script>
//SUCCESS CLOSE BUTTON
	var close = document.getElementsByClassName("closebtn");
	var i;
	for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
	}
	}
</script>
	
	</div>
	

	</div>
	</div>
	</div>
	</div>
	</div>



<!-- Loading Scripts -->
	<script src="js/main.js"></script>
	
</body>

</html>


	