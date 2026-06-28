<?php

include("include/config.php");

session_start();

if(!isset($_SESSION["user_login"])){
	header("location: login.php");
}


		//DESTROY POSTING SESSION IF URL IS NOT COMMENT.PHP
		$link = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		if($link != "comment.php" && isset($_SESSION['postid'])){
		unset($_SESSION['postid']);
		}

?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta name="theme-color" content="black">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Page not Found</title>

	<link rel="stylesheet" href="css/styles.css">
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/welcome-style.css">

</head>




<body>

<?php
include("include/header.php");
	$userid = $_SESSION["user_login"];		
	$stmt=$pdo->prepare("SELECT * FROM users WHERE userid=:userid");
	$stmt->execute(array(":userid"=>$userid));
	$row=$stmt->fetch();
?>



	<div class="ts-main-content">
	<?php include('include/leftbar.php');?>


		<div class="content-wrapper">
		<div class="container-fluid">
		
		
	<!--ONLINE USERS RIGHT BAR-->
	<?php include("include/right-bar.php")?>
	<!--/ONLINE USERS RIGHT BAR-->	
		
		
		
		<div class="col-md-12">
		<div class="row">
		<div class="panel panel-default">
									
									
		<div class="panel-heading">
	Error 
		</div>
									

	
	<div class="panel-body">



<div class='error-alert errors'><span class='closebtn'>&times;</span>  
  <strong>Page was not found</strong></div>

<script>
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

<div style="margin-bottom:100px;"></div>
	</div>
	
	
	
	
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>



<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/main.js"></script>
	
</body>

</html>


	