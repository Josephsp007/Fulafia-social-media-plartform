<?php

include('../include/config.php');
session_start();

if(!isset($_SESSION['user_login']))
	{	
header('location:../register-login.php');
}
			
	$userid = intval($_SESSION['user_login']);
		

		
		$sql=$pdo-> prepare("SELECT * from users where userid =:userid");
		$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$sql->execute();
		$row=$sql->fetch();
		$userimage = (!empty($row["profilepix"]) ? "../images/profilepix/".$row["profilepix"]: "../images/site/user.png");
		
		$ptitles = "Option will be available once group is created";
		
		//generate group token
		$nums = str_shuffle(112233445566778899);
		$token = substr($nums,0,10);
	
?>

<style>
.top-menu{
	overflow:auto;
	flex-wrap: nowrap!important;
	}
@media(min-width:600px){
	
	.top-menu::-webkit-scrollbar-thumb{
		background-color:#fff;
		border-radius:15px;
	}
	.top-menu::-webkit-scrollbar-track{
		background-color:transparent;
	}
	
	.top-menu::-webkit-scrollbar{
		width:0.2px;
	}
	.top-menu:hover::-webkit-scrollbar-thumb{
		background-color:#dfdfdf;
		width:0.2px;
	}
}
	
	
	
	.prevCard{
	max-height:500px;
	overflow-x:hidden;
	box-shadow:none!important;
    border:1px solid #dfdfdf!important;
	}
	
	.prevCard::-webkit-scrollbar-thumb{
		border-radius:1px;
		background:#dfdfdf;
	}
	.prevCard::-webkit-scrollbar-track{
		background-color:#f1f1f1;
		border-left:1px solid #e8e9eb;
	}
	.prevCard::-webkit-scrollbar{
		width:auto;
	}
	.prevCard:hover::-webkit-scrollbar-thumb{
		background-color:#dfdfdf;
		width:auto;
	}

	
.dummies span{
font-weight:450;
color:#6c757d;
}	
.span2 span{
font-weight:500;
color:#6c757d;
cursor:not-allowed;
}

.post-handler{
background:#ecf0f5;
padding:15px;
border-radius:0px 0px 4px 4px;
}

.nav-pills .bg{
	padding:10px!important;
	background: #fbfbfb;
    border: 1px solid #ccd9e9;
	border-radius:20px!important;
	margin:2px;
	font-weight:500!important;
	font-size:15px!important;
	transition:0.2s;
}

.sticky-top .active{
	background-color: #e8f0f9!important;
    border-color: #89a4bd!important;
    color: #56626c!important;
}

.sticky-top .nav-link:hover{
	background-color: #e8f0f9!important;
    border-color: #89a4bd!important;
    color: #56626c!important;
	transition:0.2s;
}

.dark-mode .sticky-top .active{
background: #3f4c58!important;
border: 2px solid #252e34!important;
transition:0.2s;
}

.dark-mode .sticky-top .nav-link:hover{
background: #3f4c58!important;
border: 2px solid #252e34!important;
transition:0.2s;
}










.imgFilter:hover{
	filter:none;
	transition:0.7s;
}

.imgFilter{
	transition:0.7s;
	filter:grayscale(100%) brightness(120%) contrast(0.7);
	-webkit-filter:grayscale(100%) brightness(120%) contrast(0.7);
}

.select2-container--default .select2-selection--single{
	display:none!important;
}
.select2-container--bootstrap4 .select2-selection--single {
    height: 50px!important;
    padding: 5px;
}
.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
    color: #939ba2!important;
    font-size: 20px;
	 line-height: calc(1.8em)!important;
}


.dummies{
	color:#2e445a;
}


.dark-mode .bg{
	color:#cccdcf!important;
	background:#292e34!important;
	border:2px solid #4f5962!important;
}

.dark-mode .dummies, .dark-mode .dummies span {
	color: #cccdcf;
}

/*normal gray*/
.dark-mode #dummy,.dark-mode #h4,.dark-mode .info{
	color:#cccdcf!important;
}

/*gray border and dark bg*/
.dark-mode .prevCard::-webkit-scrollbar-track{
	background:transparent;
	border:none;
}


</style>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-sacle=1.0, user-scalable=no">
  <title>All Groups</title>

	<script src="../js/jquery.min.js"></script>
	
	<!-- JQUERY ALERT BOX -->
	<link rel="stylesheet" href="../js/jqueryAlertBox/jquery-confirm.min.css">
	<script src="../js/jqueryAlertBox/jquery-confirm.min.js"></script>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../theme/plugins/toastr/toastr.min.css">
  

	<!-- Loader CSS -->
	<link rel="stylesheet" href="../css/loader-style.css">
	<link rel="stylesheet" href="../css/styles.css">
	
	<!--Form Select-->
	<link rel="stylesheet" href="../theme/plugins/select2/css/select2.min.css">
	
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../theme/plugins/fontawesome-free/css/all.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../theme/dist/css/adminlte.min.css">
	
	<!-- Font awesome -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <link rel="stylesheet" href="../theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  
	
	</head>




		<body class="hold-transition dar-mode sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
		<div class="wrapper">

 
			<!--LOADER-->
            <div id='loader-image'>
			<div id="loader-wrapper">
			<div id="loader"></div>
			</div></div>
			
			
			
			
		
			

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="profile.php" class="nav-link">Advert profile</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

   
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
   
      
    </ul>
  </nav>
  <!-- /.navbar -->

  

  



  			
<!--ONLINE USERS RIGHT BAR-->
	<div class="online-users-sidebar z-50 col-md-4" id="right" style="z-index: 9999 !important;">
	<div class="head-user border-bottom-0">
		Users List <span class="times" onclick="hidebars()"> &times;</span>
	</div>
	<?php
	$stmt=$pdo->prepare("SELECT * FROM users WHERE userid!=:userid");
	$stmt->execute(array(":userid"=>$userid));
	$user=$stmt->fetchAll();
	if($stmt->rowCount()>0){
		
		
	foreach($user as $user){
		$profileimage = (!empty($user["profilepix"]) ? "../images/profilepix/".$user["profilepix"]: "../images/site/user.png");

		echo  
		"<div class='user-img-name border-top p-2'>
		<a href='../profile.php?profileid=".intval($user['userid'])."'>
		<img src='" .$profileimage ."' class='user-img'>
		" . $user["name"] ." 
		</a>
		
		<a href='../chats/?receiverid=".$user['userid']."' style='float:right; margin-top: -2px;'>
		<button class='btn btn-default border-round'>
		<i class='far fa-comment'></i>
		</button>
		</a>
		</div>";
		}
	}
	?>	
	<div class="border-top" style="margin-bottom: 100px;"></div>
	</div>

	
	
	
	<!--/ONLINE USERS RIGHT BAR-->	
	
	
	<style>
	
.online-users-sidebar{
	transition:0.3s;
	right:-1000px;
	opacity:0;
}

@media(max-width:800px){
	.online-users-sidebar{
		transition:0.3s;
		right:-1000px;
		width:100%!important;
	}
}


</style>
	
	
	
		<script>
	//buttons for this action is on the header.php
	//display right bar users when user icon is clicked
function showbars(){
	document.getElementById("right").style.right="0px";
	document.getElementById("right").style.transition="0.3s";
	document.getElementById("right").style.opacity="12";
}

function hidebars(){
	document.getElementById("right").style.right="-300px";
	document.getElementById("right").style.transition="0.3s";
	document.getElementById("right").style.opacity="0";
}
</script>	










  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../images/site/elogo.png" alt="eBlaze Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
     <span class="brand-text font-weight-light" style="font:normal 19px 'Cookie', cursive; font-weight:600;">Fulafia Connect</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="padding-left:2px">
          <img src="<?php echo $userimage;?>" class="img-circle elevation-2" alt="Profile Image" style="width:50px;height:50px;">
        </div>
        <div class="info">
          <a href="../profile.php?profileid=<?= intval($userid)?>" class="d-block"><?php echo htmlspecialchars($row["name"]);?><br>Manager</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>





      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Manager Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../profile.php?profileid=<?= $userid;?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Your Profile</p>
                </a>
              </li>
			 <li class="nav-item ">
            <a href="../index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
		  
		  
		  
		  
		  
		  
		 
          <li class="nav-item">
            <a href="discover.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Groups
              </p>
            </a>
          </li>
		  
		  
	
           <li class="nav-item ">
            <a href="#" onclick="showbars()" class="nav-link">
              <i class="nav-icon fa fa-comment"></i>
              <p>
               Chat Users
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="../advert-manager/manage.php" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Post Premium Ads
                <span class="right badge badge-success">Ads</span>
              </p>
            </a>
          </li>



           <li class="nav-item ">
            <a href="../advert-manager/profile.php" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Advert Profile
              </p>
            </a>
          </li>
          
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
   

    <!-- Main content -->
 

			
			
	 <section class="content" style="padding:0px;">
      <div class="container-fluid">
       



		  <div class="row" style="">
          <div class="col-12">
		  
           
		   
			<div class="card sticky-top" style="margin-bottom:-2px;margin-top:-5px;border-radius: 0.25rem 0.25rem 0 0;box-shadow: 0 0 1px rgb(0 0 0 / 30%), 0 0px 2px rgb(0 0 0 / 20%); top: 54px;">
            <div class="card-body" style="padding:8px;">	
			<ul class="nav nav-pills p-2 top-menu" style="display:flex;white-space:nowrap;">
				
			<li class="nav-item"><a class="bg nav-link" href="#tab_1" data-toggle="tab">
			<i style="color:#6792bd" class="far fa-bell"></i>&nbsp; Create Group &nbsp;</a></li> &nbsp;
				
			<li class="nav-item"><a class="nav-link bg active" href="#tab_2" data-toggle="tab">
			<i style="color:#6792bd" class="far fa-bell"></i>&nbsp; Groups &nbsp;</a></li> &nbsp;
				
			<li class="nav-item"><a class="nav-link bg" href="#tab_3" data-toggle="tab">
			<i style="color:#6792bd" class="far fa-bell"></i>&nbsp; Joined Group &nbsp;</a></li> &nbsp;
				
      <li class="nav-item">
      <a class="nav-link bg" href="#tab_4" data-toggle="tab">
        <i style="color:#6792bd" class="far fa-bell"></i>&nbsp; Groups you manage &nbsp;
      </a>
      </li>
      &nbsp;
				
      
                
			</ul>
			</div>
			</div>
			
			
            
			
			<div class="card">
              <div class="card-body" style="padding:8px;">
                <p><div class="tab-content">
				<!-- /.tab-pane 1-->
                  <div class="tab-pane" id="tab_1">
                    
		
					
					
					
					
					
					
					
					
					
   
			<div class="row" style="margin:auto;justify-content: space-between;">
			
			<div class="col-md-4">
			<div class="card card-b" style="box-shadow:none;border:1px solid #dfdfdf">
		    <div class="card-header with-border">
			
			<div class="user-panel mt-3 mb-3 d-flex">
			<a href="../profile.php?profileid=MQ==">
			<img class="img-circle" src="<?php echo $userimage;?>" style="width:55px; height:55px;border:2px solid #bbb;">
			</a>
			<div class="info" style="margin-left:3px; text-transform:capitalize"><b><?php echo htmlspecialchars($row["name"]);?></b><br>
			<div style="color:#869099;font-size:14px;white-space:normal"><span id="privs">Public</span> · <i class="glyphicon glyphicon-globe"></i> Group</div>
			</div>
			</div>
			</div>
			
			<div class="card-body" style="padding:0px">
			
			
			
			<div style="padding:15px;">
			
			<!--Continue after create-->
			<div id="continue"></div>
			
			<form id="quickForm" novalidate="novalidate" class="" name="adsForm">
			<div id="errs" align="center" style="color:#eb1111;margin:10px 5px;font-weight:400;"></div>
		
			
			<div class="form-group">
			<input type="text" class="form-control" name="group_name" id="group_name" placeholder="Group name" style="padding:25px;font-size:20px;">
			</div>
			
		
		
			
		<div class="form-group">
		<div style="display:flex">
		<div class="input-group-prepend" style="margin-right:-4px">
        <span class="input-group-text" style="background:transparent; color:#869099">
		<i class="fas fa-sitemap"></i>
		</span>
        </div>
        <select class="form-control select2bs4" name="category" id="category" style="width: 100%;height:50px;font-size:20px" 
		data-select2-id="17" tabindex="-1" aria-hidden="true">
		<option value="">Category</option>
		
			<?php 	
			$stmt = $pdo->prepare("SELECT * FROM group_categories ORDER BY category_id ASC");
			$stmt->execute();
			$gcategorys = $stmt->fetchAll();
			foreach($gcategorys as $gcategory){
			?>
			<option value="<?php echo htmlspecialchars($gcategory["category_id"]);?>"><?php echo htmlspecialchars($gcategory["category_name"]);?></option>
			<?php }?>
        </select>
        </div>
        </div>
		
	
		

        <div class="form-group">
        <div style="display:flex">
        <div class="input-group-prepend" style="margin-right:-4px">
        <span class="input-group-text" style="background:transparent; color:#869099">
        <i class="fa fa-lock"></i> <i class="glyphicon glyphicon-globe display-none"></i>
        </span>
        </div>
        <select class="form-control select2bs4" id="privacy" name="privacy" style="width: 100%;height:50px;font-size:20px" 
        data-select2-id="18" tabindex="-1" aria-hidden="true">
        <option value="">Choose Privacy</option>
        <option value="Private">Private</option>
        <option value="Public">Public</option>
        </select>
        </div>
        </div>
		
			
			<div class="form-group">
			<textarea class="form-control" rows="3" maxlength="400" name="description" id="description" placeholder="What is your group all about" 
			style="margin-top: 0px; margin-bottom: 0px; height: 91px;"></textarea>
			</div>
			
			<p>
			
			<button type="submit" id="publish" class="btn btn-primary btn-block">Publish</button>
			
			</form>
			</div>
			
			
			
			</div>
			</div>
			</div>
			
			
			
	


			<div class="col-md-8">
	
			<div class="card card-b" style="box-shadow:none;">
		    <div class="card-header card-b" style="border:1px solid #dfdfdf; border-bottom: none;padding:0px">
            <h5 style="padding:10px 10px 5px;">
			<i style="color:#6792bd" class="material-icons">devices</i>&nbsp; Preview 
			</h5>
			</div>
			
			
		    
			<div class="prevCard card-b">

			<img src="images/img/groupBg.png" style="width:100%; margin:auto" class="imgFilter">
			
			<div class="dummies" style="font-size:15px; text-transform:capitalize; line-height:1.8; font-weight:400;">
			<h2 style="font-weight:600;padding:15px 15px 0px" id="gname">Group name</h2>
			
			<div style="margin-top:-20px!important;margin-bottom:-15px;padding:15px"><span id="des"> Brief Description </span><p>
			<span><i class="fas fa-sitemap"></i>&nbsp;<span id="cat">Group Category</span></span>&nbsp; &nbsp;
			<span><i class="fa fa-lock"></i>&nbsp;<span id="priv">Privacy</span></span></div>
			
			<div class="dropdown-divider"></div>
			
			<div class="span2" style="padding:15px">
			<span title="<?php echo $ptitles;?>" data-toggle="tooltip">About</span>&nbsp; &nbsp;
			<span title="<?php echo $ptitles;?>" data-toggle="tooltip">Posts</span>&nbsp; &nbsp;
			<span title="<?php echo $ptitles;?>" data-toggle="tooltip">Members</span>&nbsp; &nbsp;
			<span title="<?php echo $ptitles;?>" data-toggle="tooltip">Events</span>
			</div>
			
			
			
			
			<div class="row post-handler" style="border:1px solid #cdcdcd;">
			
			<div class="col-md-7">
			<div class="card" style="padding:15px;min-height:130px;">
			<div class="author-avatar" style="display:flex;">
			<div>
			<img src="../images/site/no-img.png" width="50" style="border:2px solid #bbb;border-radius:50%;">
			</div>
			<span class="pmind" style="background:#f0f2f5;color:#bbb; font-size:14px; padding:10px; border-radius:15px;width:100%; margin-left:10px; height:44px;">
			&nbsp; What's on your mind?
			</span>
            </div>
			
            <div class="span2" style="display:flex;width:100%;left:0;position:absolute;font-size:14px;font-weight:500; top:70px; justify-content:space-evenly;">
              <span style="cusor:not-allowed" title="<?php echo $ptitles;?>" data-toggle="tooltip">
			  <i class="material-icons">collections</i> Posts</span>

              <span style="cusor:not-allowed" title="<?php echo $ptitles;?>" data-toggle="tooltip">
			   <i class="material-icons">group</i> Tag people</span>

              <span style="cusor:not-allowed" title="<?php echo $ptitles;?>" data-toggle="tooltip">
			   <i class="material-icons">mood</i> Activities</span>
			
			</div>
			</div>
			</div>
			<!--col 1-->
			
			
			<!--col 2-->
			<div class="col-md-5">
			<div class="card" style="padding:15px;min-height:130px;">
		
              <span> About</span><p>
              <span> <i class="fa fa-group"></i> General</span>
		
			</div>
			
			</div>
			<!--col 2-->
			
			
			
			</div>
			<!--row-->
			
			
			
			
			
			
			
			
			
			
			
			</div>
		    </div>
           	<!-- /.inner card -->
         
	
			</div>
			 <!-- /.card -->
			
			
			
			</div><!-- /.col -->	
			</div>
			<!-- /body row -->
			
			
			</div>
			<!-- /.tab 1-->
					
					
					
					
					
					
				  
				  
				  
                  <!-- /.tab-pane 2-->
            <div class="tab-pane active" id="tab_2">
                    
			<h4 class="m-0 text-center" style="margin:2px 0px 25px!important">Suggested for you
			<div style="color:#869099;font-size:14px;font-weight:400;white-space:normal">
			Groups you might be interested in &nbsp;<i class="fas fa-users"></i></div></h4>
						




<div style='display:flex;flex-wrap:wrap;width:100%;justify-content:center'>

<?php
// Prepare an array to store IDs of groups the user has already joined
$joinedGroupIds = [];

// If a user is logged in, fetch their joined groups
if ($userid) {
    try {
        $stmtJoined = $pdo->prepare("SELECT group_id FROM group_members WHERE user_id = :user_id");
        $stmtJoined->execute([':user_id' => $userid]);
        $joinedGroupIds = $stmtJoined->fetchAll(PDO::FETCH_COLUMN); // Fetches only the group_id column into a simple array
    } catch (PDOException $e) {
        // Log the error for debugging purposes
        error_log("Error fetching joined groups for user ID: " . $userid . " - " . $e->getMessage());
        // In a real application, you might show a user-friendly message or handle it differently
    }
}

// Fetch all groups to suggest
$stmt = $pdo->prepare("SELECT * FROM groups ORDER BY RAND()");
$stmt->execute();
$getGroups = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array for easier access

if ($stmt->rowCount() > 0) {
    foreach ($getGroups as $getGroup) {

        // Check if group cover is illustration or uploaded pix and change folder img var location
        $il = "eblaze_illustrate";
        $ils = substr($il, 0, 17);
        $cover = substr($getGroup["cover"], 0, 17);

        if ($cover == $ils) {
            $getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/illustrations/" . $getGroup["cover"] : "images/group-cover/illustrations/illustrate7.png");
        } else {
            $getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/" . $getGroup["cover"] : "images/group-cover/illustrations/illustrate7.png");
        }

        // Determine if the current group is already joined by the user
        // Ensure you use the correct primary key for the group, typically 'id' or 'group_id'
        // I'm using 'id' here, please adjust if your primary key is actually 'group_id'
        $isJoined = in_array($getGroup["group_id"], $joinedGroupIds); // Assuming 'id' is the primary key in 'groups' table
        ?>

        <div class="grp" style="border:1px solid #ced4da;border-radius:8px;width:305px; margin:8px">
            <a href="../groupchat/?groupid=<?php echo intval($getGroup["group_id"]);?>">
            <img class="d-block w-100" src="<?php echo $getGroupCover;?>"
            style="height:200px;width:200px;border-radius:8px 8px 0px 0px; border-bottom:1px solid #bbb">
            </a>

            <div style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding:8px">
  
            <a href="../groupchat/?groupid=<?php echo intval($getGroup["group_id"]);?>">
            <h5 style="margin-bottom:-1px"><?php echo htmlspecialchars($getGroup["group_name"]);?></h5>
            </a>

                <font style="color:#869099;font-size:15px;"><?php echo htmlspecialchars($getGroup["description"]);?></font><br>
                <font style="color:#869099;font-size:14px;font-weight:600"><span id="memberCount_<?php echo htmlspecialchars($getGroup["group_id"]); ?>"><?php echo htmlspecialchars($getGroup["member_count"]); ?></span> Members</font>

                <?php if ($isJoined): ?>
                    <button class="btn btn-success btn-block" style="margin-top:20px;font-weight:600; opacity: 0.7; cursor: default;" disabled>Already Joined</button>
                <?php else: ?>
                    <?php if ($userid): // Only show join button if user is logged in ?>
                        <button class="btn btn-default btn-block join-group-btn"
                                data-group-id="<?php echo htmlspecialchars($getGroup["group_id"]); ?>"
                                style="margin-top:20px;font-weight:600">Join Group</button>
                    <?php else: // User not logged in, maybe show a login prompt or just hide the button ?>
                        <button class="btn btn-secondary btn-block" style="margin-top:20px;font-weight:600;" disabled>Log in to Join</button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    <?php
    } // End foreach
} else {
    // Message if no groups are found in the database
    echo '<p class="text-center text-muted">No groups suggested at the moment.</p>';
}
?>
</div>
					
      
    </div>
				  
				  
				  
                  
                  








<div class="tab-pane" id="tab_3">
<h4 class="m-0 text-center" style="margin:2px 0px 25px!important">Your Joined Groups
<div style="color:#869099;font-size:14px;font-weight:400;white-space:normal">
Groups you are a member of &nbsp;<i class="fas fa-users"></i>
</div>
</h4>

<div id="joinedGroupsContainer" style='display:flex;flex-wrap:wrap;width:100%;justify-content:center'>
<?php

try {
// Select groups the user has joined, joining with the 'groups' table to get group details
$stmt = $pdo->prepare(
"SELECT g.*
FROM groups g
INNER JOIN group_members gm ON g.group_id = gm.group_id
WHERE gm.user_id = :user_id
ORDER BY g.group_name ASC
");
$stmt->execute([':user_id' => $userid]);
$joinedGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($joinedGroups) > 0) {
foreach ($joinedGroups as $getGroup) {
// Check if group cover is illustration or uploaded pix and change folder img var location
$il = "eblaze_illustrate";
$ils = substr($il, 0, 17);
$cover = substr($getGroup["cover"], 0, 17);

if ($cover == $ils) {
$getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/illustrations/" . $getGroup["cover"] : "images/group-cover/illustrations/illustrate7.png");
} else {
$getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/" . $getGroup["cover"] : "images/group-cover/illustrations/illustrate7.png");
}
?>
<div class="grp" style="border:1px solid #ced4da;border-radius:8px;width:305px; margin:8px" data-group-id="<?php echo $getGroup["group_id"]; ?>">
<img class="d-block w-100" src="<?php echo $getGroupCover;?>"
style="height:200px;width:200px;border-radius:8px 8px 0px 0px; border-bottom:1px solid #bbb">

<div style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding:8px">
<h5 style="margin-bottom:-1px"><?php echo $getGroup["group_name"];?></h5>
<font style="color:#869099;font-size:15px;"><?php echo $getGroup["description"];?></font><br>
<font style="color:#869099;font-size:14px;font-weight:600"><span id="memberCount_<?php echo $getGroup["group_id"]; ?>"><?php echo $getGroup["member_count"]; ?></span> Member(s)</font>
<button class="btn btn-danger btn-block leave-group-btn"
data-group-id="<?php echo $getGroup["group_id"]; ?>"
style="margin-top:20px;font-weight:600">Leave Group</button>
</div>
</div>
<?php
}
} else {
echo '<p class="text-center text-muted">You haven\'t joined any groups yet.</p>';
}
} catch (PDOException $e) {
error_log("Database error in joined groups display: " . $e->getMessage());
echo '<p class="text-center text-danger">An error occurred while loading your groups. Please try again later.</p>';
}
?>
</div>
</div>








				  
				  
				  
                <!-- /.tab-pane 4-->
                <div class="tab-pane" id="tab_4">
                <h4 class="m-0 text-center" style="margin:2px 0px 25px!important">Groups You Manage
                <div style="color:#869099;font-size:14px;font-weight:400;white-space:normal">
                Groups where you are the administrator &nbsp;<i class="fas fa-users-cog"></i>
                </div>
                </h4>

                <div id="managedGroupsContainer" style='display:flex;flex-wrap:wrap;width:100%;justify-content:center'>
                <p class="text-center text-muted" id="loadingManagedGroups">Loading groups you manage...</p>
                </div>
                </div>

                <!-- Update Form -->
                <div id="groupUpdateFormTemplate" style="display: none;">
                <form class="update-group-form" data-group-id="">
                <input type="hidden" name="group_id" class="form-group-id">
                <div class="form-group">
                <label for="update_group_name">Group Name</label>
                <input type="text" name="group_name" class="form-control update-group-name" required minlength="3">
                </div>
                <div class="form-group">
                <label for="update_description">Description</label>
                <textarea name="description" class="form-control update-description" rows="3" required minlength="10"></textarea>
                </div>
                <div class="form-group">
                <label for="update_category">Category</label>
                <select name="category" class="form-control update-category" required>
                </select>
                </div>
                <div class="form-group">
                <label for="update_privacy">Privacy</label>
                <select name="privacy" class="form-control update-privacy" required>
                <option value="Public">Public</option>
                <option value="Private">Private</option>
                </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block update-group-submit-btn">Save Changes</button>
                <button type="button" class="btn btn-secondary btn-block cancel-update-btn">Cancel</button>
                </form>
                </div>

				  


				 
				  

                </div>
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
                </div>





                </div>
                </div><!-- /.row -->
		
		
		
		
		
		
		
		
		
		
		
		
		
      </div><!-- /.container-fluid -->
    </section>
			
			
			
			
			
			
			
			
			  
			  
			  
			
			




  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->





</div>
<!-- ./wrapper -->
















<!-- Bootstrap -->
<script src="../theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../theme/dist/js/adminlte.js"></script>

<!-- PAGE theme/plugins -->
<!-- jQuery Mapael -->
<script src="../theme/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../theme/plugins/raphael/raphael.min.js"></script>
<!-- overlayScrollbars -->
<script src="../theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Select2 -->
<script src="../theme/plugins/select2/js/select2.full.min.js"></script>
<script src="../theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../theme/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- SweetAlert2 -->
<script src="../theme/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toaster -->
<script src="../theme/plugins/toastr/toastr.min.js"></script>

<!-- InputMask -->
<script src="../theme/plugins/moment/moment.min.js"></script>
<script src="../theme/plugins/inputmask/jquery.inputmask.min.js"></script>








<script>

$(document).ready(function() {
    // Toaster (Ensure SweetAlert2 library is included in your HTML)
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Hide Loader initially
    $("#loader-image").hide();

    // --- Live Preview Controls (Refactored) ---
    // Use a single function for updates to keep it DRY (Don't Repeat Yourself)
    function updateGroupPreview() {
        const groupName = $("#group_name").val().trim();
        const description = $("#description").val().trim();
        const category = $("#category option:selected").text(); // Get text, not value, for display
        const privacy = $("#privacy").val();

        $("#gname").html(groupName === "" ? "Group name" : groupName);
        $("#des").html(description === "" ? "Service Description" : description);
        $("#cat").html("<b>Category: </b> <span style='color:#647b93'>" + (category === "" ? "Group Category" : category) + "</span>");
        $("#priv").html("<b>Privacy: </b> <span style='color:#647b93'>" + (privacy === "" ? "Privacy" : privacy) + "</span>");
        $("#privs").html(privacy === "" ? "Private" : privacy);
    }

    // Attach one listener to all relevant input changes
    $("#group_name, #description, #category, #privacy").on("keyup change", updateGroupPreview);

    // Initial call to set default previews if fields are pre-filled
    updateGroupPreview();

    // --- Form Validation and Submission ---
    $.validator.setDefaults({
        submitHandler: function(form) { // 'form' argument refers to the validated form element
            let formData = {
                group_name: $("#group_name").val(),
                description: $("#description").val(),
                category: $("#category").val(), // Send value to backend
                privacy: $("#privacy").val(),
                // Make sure 'token' is available globally or passed securely
                // It's safer to get the token from a hidden input if it's dynamic
                token: <?php echo intval($token); ?>,
            };

            $.ajax({
                url: 'create_group.php', // New PHP file to handle creation
                method: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                beforeSend: function() {
                    $("#loader-image").show(); // Show loader
                    $(form).find('button[type="submit"]').prop('disabled', true); // Disable submit button
                },
                success: function(response) {
                    $("#loader-image").hide(); // Hide loader
                    $(form).find('button[type="submit"]').prop('disabled', false); // Re-enable submit button

                    if (response.status === 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                        // Optional: Clear the form or redirect
                        $('#quickForm')[0].reset(); // Resets the form fields
                        updateGroupPreview(); // Reset preview
                        // If you want to redirect:
                        // setTimeout(function() { window.location.href = 'groups.php'; }, 1500);

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error: ' + response.message
                        });
                        // $("#errs").html(response.message); // You can still use this for persistent error messages
                    }
                },
                error: function(xhr, status, error) {
                    $("#loader-image").hide(); // Hide loader
                    $(form).find('button[type="submit"]').prop('disabled', false); // Re-enable submit button
                    console.error("AJAX Error: " + status + " - " + error);
                    Toast.fire({
                        icon: 'error',
                        title: 'An unexpected error occurred. Please try again.'
                    });
                }
            });
        }
    });

    $('#quickForm').validate({
        rules: {
            group_name: {
                required: true,
                minlength: 3
            },
            description: {
                required: true,
                minlength: 10
            },
            category: {
                required: true
            },
            privacy: {
                required: true
            },
        },
        messages: {
            group_name: {
                required: "Enter group name",
                minlength: "Must be at least 3 characters long"
            },
            description: {
                required: "Briefly describe your group",
                minlength: "Description is too short"
            },
            category: {
                required: "Select group category"
            },
            privacy: {
                required: "Select group privacy"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });






    // Toaster configuration (ensure this is at the top of your script.js)
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true, // Optional: Adds a progress bar
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });



    
    // --- Join Group Functionality ---
    $(document).on('click', '.join-group-btn', function() {
        var button = $(this);
        var groupId = button.data('group-id');

        button.prop('disabled', true).text('Joining...');

        $.ajax({
            url: 'join_group.php',
            type: 'POST',
            data: { group_id: groupId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    button.text('Joined').removeClass('btn-default').addClass('btn-success').prop('disabled', true);

                    var currentMembers = parseInt($('#memberCount_' + groupId).text());
                    $('#memberCount_' + groupId).text(currentMembers + 1);

                    // Show success toast
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });

                } else {
                    button.prop('disabled', false).text('Join Group');
                    // Show error toast
                    Toast.fire({
                        icon: 'error',
                        title: 'Error: ' + response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                button.prop('disabled', false).text('Join Group');
                console.error("AJAX Error: " + status + " - " + error);
                // Show generic error toast
                Toast.fire({
                    icon: 'error',
                    title: 'An error occurred. Please try again.'
                });
            }
        });
    });

    // --- Leave Group Functionality ---
    $(document).on('click', '.leave-group-btn', function() {
        var button = $(this);
        var groupId = button.data('group-id');
        var groupCard = button.closest('.grp');

        if (confirm('Are you sure you want to leave this group?')) { // Still good to keep this confirmation
            button.prop('disabled', true).text('Leaving...');

            $.ajax({
                url: 'leave_group.php',
                type: 'POST',
                data: { group_id: groupId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        groupCard.remove();

                        var memberCountSpan = $('#memberCount_' + groupId);
                        if (memberCountSpan.length > 0) {
                            var currentMembers = parseInt(memberCountSpan.text());
                            if (currentMembers > 0) {
                                memberCountSpan.text(currentMembers - 1);
                            }
                        }

                        // Check if no groups left in the container and update message
                        if ($('#joinedGroupsContainer .grp').length === 0) {
                            $('#joinedGroupsContainer').html('<p class="text-center text-muted">You haven\'t joined any groups yet.</p>');
                        }

                        // Show success toast
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                    } else {
                        button.prop('disabled', false).text('Leave Group');
                        // Show error toast
                        Toast.fire({
                            icon: 'error',
                            title: 'Error: ' + response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    button.prop('disabled', false).text('Leave Group');
                    console.error("AJAX Error leaving group: " + status + " - " + error);
                    // Show generic error toast
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occurred. Please try again.'
                    });
                }
            });
        }
    });
















// --- Managed Groups Functionality ---

    // Store categories globally once fetched to avoid re-fetching
    var allCategories = [];

      // Function to load managed groups
  function loadManagedGroups() {
  $('#loadingManagedGroups').show(); // Show loading message
  $('#managedGroupsContainer').empty(); // Clear previous content

  $.ajax({
  url: 'get_managed_groups.php', // PHP script to fetch managed groups
  type: 'GET',
  dataType: 'json',
  success: function(response) {
    $('#loadingManagedGroups').hide(); // Hide loading message
    if (response.status === 'success') {
        // Store categories for later use when populating forms
        allCategories = response.categories || [];

        if (response.groups.length > 0) {
            $.each(response.groups, function(index, getGroup) {
                var groupCover = getGroup.cover;
                var getGroupCover;

                console.log(getGroup.group_id);

              // Replicate the PHP logic for cover image path
              var il = "eblaze_illustrate";
              var ils = il.substring(0, 17);
              var coverPrefix = groupCover.substring(0, 17);

              if (coverPrefix === ils) {
                  getGroupCover = (groupCover ? "images/group-cover/illustrations/" + groupCover : "images/group-cover/illustrations/illustrate7.png");
              } else {
                  getGroupCover = (groupCover ? "images/group-cover/" + groupCover : "images/group-cover/illustrations/illustrate7.png");
              }

              // Build the HTML for each managed group card
              var groupHtml = `
                  <div class="grp managed-group-card" data-group-id="${getGroup.group_id}" style="border:1px solid #ced4da;border-radius:8px;width:305px; margin:8px; overflow:hidden;">
                      <img class="d-block w-100" src="${getGroupCover}"
                      style="height:200px;width:200px;border-radius:8px 8px 0px 0px; border-bottom:1px solid #bbb">

                      <div class="group-display-area" style="display:block;padding:8px;">
                          <h5 style="margin-bottom:-1px">${getGroup.group_name}</h5>
                          <font style="color:#869099;font-size:15px;">${getGroup.description}</font><br>
                          <font style="color:#869099;font-size:14px;font-weight:600">
                              ${getGroup.member_count} Members &nbsp;
                              (Privacy: ${getGroup.privacy})
                          </font><br>
                          <font style="color:#869099;font-size:14px;font-weight:600">
                              Category: ${getGroup.category_name || 'N/A'}
                          </font>
                          <button class="btn btn-info btn-block update-group-toggle-btn"
                                  data-group-id="${getGroup.group_id}"
                                  data-group-name="${getGroup.group_name}"
                                  data-group-description="${getGroup.description}"
                                  data-group-category-id="${getGroup.category_id}"  data-group-privacy="${getGroup.privacy}"
                                  style="margin-top:20px;font-weight:600">Update Group</button>
                      </div>
                      <div class="group-update-form-area" style="display:none; padding:8px;">
                          </div>
                  </div>
              `;
              $('#managedGroupsContainer').append(groupHtml);
          });
      } else {
          $('#managedGroupsContainer').html('<p class="text-center text-muted">You do not manage any groups yet.</p>');
      }
  } else {
      $('#managedGroupsContainer').html('<p class="text-center text-danger">Error loading managed groups: ' + response.message + '</p>');
  }
},
error: function(xhr, status, error) {
  $('#loadingManagedGroups').hide();
  console.error("AJAX Error loading managed groups: " + status + " - " + error);
  $('#managedGroupsContainer').html('<p class="text-center text-danger">An error occurred while loading your managed groups. Please try again.</p>');
}
});
}

    // Load managed groups when tab_4 is shown
    $('a[href="#tab_4"]').on('shown.bs.tab', function(e) {
        loadManagedGroups();
    });



   // Event listener for "Update Group" button (to toggle form visibility)
    $(document).on('click', '.update-group-toggle-btn', function() {
        var button = $(this);
        var card = button.closest('.managed-group-card');
        var displayArea = card.find('.group-display-area');
        var formArea = card.find('.group-update-form-area');

        // Check if the form is currently hidden (meaning we want to show it)
        if (formArea.is(':hidden')) {
            // Hide any other open update forms first (optional, but good UX)
            $('.group-update-form-area').not(formArea).slideUp(200, function() {
                $(this).empty(); // Clear content of other forms
                $(this).siblings('.group-display-area').slideDown(200); // Show their display areas
            });


            // Clone the template form
            // IMPORTANT: Use .clone(true) if you had event handlers directly on template elements,
            // though for simple form elements, a plain clone is usually fine if events are delegated.
            var updateForm = $('#groupUpdateFormTemplate').find('form').clone();

            // Populate the form fields with data from the button's data attributes
            updateForm.find('.form-group-id').val(button.data('group-id'));
            updateForm.find('.update-group-name').val(button.data('group-name'));
            updateForm.find('.update-description').val(button.data('group-description'));

            // Populate category dropdown
            var categorySelect = updateForm.find('.update-category');
            categorySelect.empty(); // Clear existing options
            categorySelect.append('<option value="">Select Category</option>'); // Add default option

            // Dynamically add category options from the fetched list
            $.each(allCategories, function(i, category) {
                var option = $('<option></option>')
                    .val(category.category_id) // Use category.id as the option value
                    .text(category.category_name);
                categorySelect.append(option);
            });
            // Set the selected category based on data attribute (category_id)
            categorySelect.val(button.data('group-category-id'));


            // Set privacy dropdown
            updateForm.find('.update-privacy').val(button.data('group-privacy'));


            // Clear any old form content and append the new form
            formArea.empty().append(updateForm);

            // Hide display area, show form area
            displayArea.slideUp(200);
            formArea.slideDown(200, function() { // Callback after slideDown completes
                 // Re-apply validation to the newly added form
                 // Make sure to apply it *after* the form is in the DOM and visible
                 updateForm.validate({
                     rules: { /* your validation rules for update form fields */
                         group_name: { required: true, minlength: 3 },
                         description: { required: true, minlength: 10 },
                         category: { required: true },
                         privacy: { required: true }
                     },
                     messages: { /* your validation messages */
                        group_name: {
                            required: "Enter group name",
                            minlength: "Must be at least 3 characters long"
                        },
                        description: {
                            required: "Briefly describe your group",
                            minlength: "Description is too short"
                        },
                        category: {required: "Select group category"},
                        privacy: {required: "Select group privacy"}
                     },
                     submitHandler: function(formElement) {
                         submitUpdateGroupForm($(formElement));
                     },
                     errorElement: 'span',
                     errorPlacement: function (error, element) {
                         error.addClass('invalid-feedback');
                         element.closest('.form-group').append(error);
                     },
                     highlight: function (element, errorClass, validClass) {
                         $(element).addClass('is-invalid');
                     },
                     unhighlight: function (element, errorClass, validClass) {
                         $(element).removeClass('is-invalid');
                     }
                 });
            });


        } else {
            // If the form is currently visible (meaning we want to hide it)
            formArea.slideUp(200, function() {
                formArea.empty(); // Clear form content after hiding
                displayArea.slideDown(200);
            });
        }
    });







    // Event listener for "Cancel" button on the update form
    $(document).on('click', '.cancel-update-btn', function() {
        var button = $(this);
        var card = button.closest('.managed-group-card');
        var displayArea = card.find('.group-display-area');
        var formArea = card.find('.group-update-form-area');

        formArea.slideUp(200, function() {
            formArea.empty(); // Clear form content
            displayArea.slideDown(200);
        });
    });

    // --- AJAX Submission for Update Group Form ---
    function submitUpdateGroupForm(formElement) {
        var formData = formElement.serialize(); // Get all form data
        var submitButton = formElement.find('.update-group-submit-btn');
        var groupId = formElement.find('.form-group-id').val(); // Get group_id from hidden field

        submitButton.prop('disabled', true).text('Saving...');

        $.ajax({
            url: 'update_group.php', // PHP script to handle group update
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                submitButton.prop('disabled', false).text('Save Changes');

                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });

                    // Update the displayed group info in the card without reloading
                    var card = formElement.closest('.managed-group-card');
                    card.find('h5').text(response.updated_data.group_name);
                    card.find('font:eq(0)').text(response.updated_data.description); // First font element
                    card.find('font:eq(1)').html(`${response.updated_data.member_count} Members &nbsp; (Privacy: ${response.updated_data.privacy})`); // Second font element
                    card.find('font:eq(2)').html(`Category: ${response.updated_data.category_name}`); // Third font element for category

                    // Update data attributes on the toggle button for next edit
                    var toggleButton = card.find('.update-group-toggle-btn');
                    toggleButton.data('group-name', response.updated_data.group_name);
                    toggleButton.data('group-description', response.updated_data.description);
                    toggleButton.data('group-category-id', response.updated_data.category_id); // Ensure this is category_id
                    toggleButton.data('group-privacy', response.updated_data.privacy);


                    // Hide the form and show the display area
                    card.find('.group-update-form-area').slideUp(200, function() {
                        $(this).empty(); // Clear the form
                        card.find('.group-display-area').slideDown(200);
                    });


                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error: ' + response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                submitButton.prop('disabled', false).text('Save Changes');
                console.error("AJAX Error updating group: " + status + " - " + error);
                Toast.fire({
                    icon: 'error',
                    title: 'An error occurred while updating. Please try again.'
                });
            }
        });
    }



















		
//SELECT DROP
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    });
	
	
	//Trigger Tooltip Titles
	$('[data-toggle="tooltip"]').tooltip();
		

	
	
	});
  
  
</script>











			
</body>
</html>
