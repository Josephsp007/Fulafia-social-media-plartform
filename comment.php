<?php

include('include/config.php');
include('include/timeago.php');
session_start();

if(!isset($_SESSION['user_login']))
{	
header('location:register-login.php');
} 

//Check if Post ID isset properly, Get the POst ID from (read.php)
if(isset($_GET["postid"])){
$decoded = $_GET['postid'];

if(isset($_GET["Author"])){
$sql = "SELECT users.name,users.userid,posts.post_id,posts.userid FROM users,posts WHERE users.userid=posts.userid AND post_id =:decoded";
$query = $pdo -> prepare($sql);
$query-> bindParam(':decoded', $decoded, PDO::PARAM_STR);
$query->execute();
$poster = $query->fetch();
$author = str_replace(' ','-',$poster['name']);

if($_GET["Author"] != $author){
header('refresh:0, 404.php');
}
}
//INCASE USER want to manipulate id from URL (change it) check DB if the changed id is matched with any in DB
$sql = "SELECT post_id FROM posts where post_id=:decoded";
$query = $pdo -> prepare($sql);
$query-> bindParam(':decoded', $decoded, PDO::PARAM_STR);
$query->execute();
if($query->rowCount()>0){
//if true set session for postid to be send to read_comment.php
$_SESSION['postid'] = $decoded;
}else{
header('refresh:0, 404.php');
}
}else{
header('refresh:00, 404.php');
}




$userid = $_SESSION['user_login'];
$sql = "SELECT * from users where userid = (:userid);";
$query = $pdo -> prepare($sql);
$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
$query->execute();
$row=$query->fetch();
$userimage = (!empty($row["profilepix"]) ? "images/profilepix/".$row["profilepix"]: "images/site/user.png");



//SHOW POST ON COMMENT PAGE ABOVE! BEFORE THE COMMENTS
$stmt = "SELECT users.profilepix, users.name, users.userid, posts.post_id, posts.post, posts.background, posts.created, posts.modified, posts.attachment 
FROM users, posts WHERE users.userid=posts.userid AND post_id = ".$decoded;
$stmt=$pdo-> prepare($stmt);
$stmt->execute();
$POST=$stmt->fetch();
$posterpix = (!empty($POST["profilepix"]) ? "images/profilepix/" . $POST["profilepix"]: "images/site/user.png");


//SET $ago to created column and call function from timeago.php	
$postago = $POST["created"];
$postedTime = to_time_ago($postago);


?>








<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Comments</title>
	
<script src="js/jquery.min.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>


<link rel="stylesheet" href="css/bootstrap.min.css">


<!--modal slider and GRID ARRANGE POST IMAGES -->
<link rel="stylesheet" href="css/images-grid.css">

	<!-- Loader CSS -->
	<link rel="stylesheet" href="css/loader-style.css">
	
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/welcome-style.css">

	<!-- Font awesome -->
	
	<link rel="stylesheet" href="css/font-awesome.min.css">

   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">


	<link rel="stylesheet" href="css/font-awesome.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">

  
  
</head>

<style>
.vote-icon i{
font-size:16px;
margin-top:5px;
border-radius:50%;
border:2px solid;
transition:0.3s;
padding:5px;
}
</style>



<body class="hold-transition skin-darkblue sidebar-mini">
<div class="wrapper">


 <!-- include header -->
<?php include('include/header.php');?>
  
 <!-- include sidebar -->
<?php include('include/sidebar.php');?>
  
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<ol class="breadcrumb">
  <li><a href="index.php">
  Posts</a></li>
  <li><?php if(isset($_GET["Author"])){ 
      $gName = explode("-", $_GET["Author"]);
        echo htmlspecialchars(implode(" ", $gName));}?>'s Post</li>
  
</ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
	
        <!-- MAIN BODY -->
		
        <div class="col-md-9" style="margin: auto;">
          <div class="card card-primary" style="min-height:500px;">
		  
		  
            <div class="card-header with-border">
              <h3 class="card-title">AUTHOR - <b><?php if(isset($_GET["Author"])){ 
                $gName = explode("-", $_GET["Author"]);
                 echo htmlspecialchars(implode(" ", $gName));}?>
              </b>
              </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body no-padding">
              
			 

    <!--COMMENTS VALUE-->
    <div class='margin-bottom-1em overflow-hidden'>
    <div id='read-products' class='btn btn-primary display-none' style='max-width:700px; margin:auto;'>
    <span class='fa fa-reply'></span> Back to Comments
    </div>
    </div> 

    <div id='page-content'></div>

    <!-- Load Comment -->
    <script src="js/load-comment/commentscript.js"></script>
  
	
			  
	  
            </div>
            </div>
            <!-- /.card-body -->
          
          </div>
          <!-- /. card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  
</div>
<!-- ./wrapper -->


<script src="js/bootstrap.min.js"></script>


<!-- JQUERY ALERT card -->
<link rel="stylesheet" href="js/jqueryAlertBox/jquery-confirm.min.css">
<script src="js/jqueryAlertBox/jquery-confirm.min.js"></script>


<!-- FastClick -->
<script src="theme/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="theme/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->










<script>

$(document).ready(function(){
	$("#loader-image").hide();

	
});
</script>












</body>
</html>
