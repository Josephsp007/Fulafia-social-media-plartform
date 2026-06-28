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
		
		
		$query=$pdo->prepare("SELECT * from groups");
		$query->execute();
		$groupVal=$query->fetch();
		$adminId = intval($groupVal["admin"]);
		
		//check if group cover is illustration or uploaded pix and change folder img var location
		$il = "eblaze_illustrate";						//name prefix for every illustration on folder
		$ils = substr($il,0,17);
		$cover = substr($groupVal["cover"],0,17);
		
		if($cover == $ils){
			$groupCover = (!empty($groupVal["cover"]) ? "images/group-cover/illustrations/".$groupVal["cover"]: "images/group-cover/illustrations/illustrate7.png");
		}else{
			$groupCover = (!empty($groupVal["cover"]) ? "images/group-cover/".$groupVal["cover"]: "images/group-cover/illustrations/illustrate7.png");
		}
		
		
		
		//Get Group Admin
		$sql=$pdo-> prepare("SELECT * from users where userid =:userid");
		$sql-> bindParam(':userid', $adminId, PDO::PARAM_STR);
		$sql->execute();
		$admin=$sql->fetch();
		//Group Admin image
		$adminImg = (!empty($admin["profilepix"]) ? "../images/profilepix/".$admin["profilepix"]: "../images/site/user.png");
		
		
?>

<style>


	.select-illustration::-webkit-scrollbar-thumb{
		background-color:#fff;
		border-radius:15px;
	}
	.select-illustration::-webkit-scrollbar-track{
		background-color:transparent;
	}
	
	.select-illustration::-webkit-scrollbar{
		width:0.2px;
	}
	.select-illustration:hover::-webkit-scrollbar-thumb{
		background-color:#dfdfdf;
		width:0.2px;
	}


.groupCard{
	margin-top:-10px;
	background:linear-gradient(180deg, #c6c8c9, #fff 40%);
}



/*READ LESS AND MORE*/

.readLessBtn:hover, .readMoreBtn:hover{
	text-decoration:underline;
	color:#000;
}
.readLessBtn, .readMoreBtn{
	font-weight:500;
	color:#555;
	cursor:pointer;
}

.readLess{
	height:0px;
	overflow:hidden;
	transition:0.2s;
}

.opts{
	padding:7px;
	display:flex;
	justify-content:space-between;
	font-size:0.9375rem;
	border-radius:5px;
	cursor:pointer;
	margin:5px 10px 0px 10px;
	transition:0.2s;
}
.opts:hover{
background:#f1f1f1;
transition:0.2s;
}


.gImage{
	width:100%;
	max-height:400px;
	border-radius:10px;
}
	
.dummies span{
font-size:16px;
font-weight:450;
color:#6c757d;
}	

.span2 span:hover{
background:#f6f6f6;	
}

.span2 span{
font-weight:500;
color:#6c757d;
cursor:pointer;
padding:5px;
border-radius:6px;
}

#abouts .fas,#abouts .fa ,#abouts .material-icons {
	color:#8c939d;
}

.title{
	font-weight:500;
	font-size:17px;
	color:#333;
}


.nav-pills .bg{
	padding:10px!important;
	font-weight:500!important;
	font-size:15px!important;
	transition:0.2s;
	border-bottom:4px solid transparent;
}

.top-menu{
	overflow: auto;
    flex-wrap:nowrap!important;
}
.top-menu .active{
	background-color:#fff!important;
    border-bottom-color:#c6363a!important;
    color: #c6363a!important;
	border-radius:5px 5px 0px 0px!important;
}

.top-menu .nav-link:hover{
	background-color: #f6f6f6!important;
    color: #56626c!important;
	transition:0.2s;
	border-radius:5px 5px 0px 0px!important;
}



.dark-mode .top-menu .active{
	background:#2d333a!important;
    border-bottom: 4px solid #575e66!important;
    transition: 0.2s;
	color:#ededed!important;
}

.dark-mode .top-menu .nav-link:hover{
background:#2d333a!important;
border-bottom: 4px solid #575e66!important;
transition:0.2s;
color:#ededed!important;
}

.dark-mode .carousels{	
background:#292e34!important;	
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
	font-size:15px; 
	text-transform:capitalize; 
	line-height:1.8; 
	font-weight:400;
}


.f-info-items i{
	color:#7c8289;
}
.f-info-items{
display:flex;
gap:12px;
place-items:center;
margin-bottom:10px;
}
.f-info{
	max-width:330px!important;
	padding:15px!important;
	font-weight:450!important;
}


.carousels {
  background: #fff;
  overflow:hidden;
  padding:0px 0px 20px;
  outline:none;
}

.carousel-cell a:hover{
	color:#26548d!important;
}
.carousel-cell a{
	color:#222;
	font-weight:450;
}
.carousel-cell {
	padding:0px;
	font-size:15px;
    width: 310px;
    margin: 10px;
    border-radius: 10px;
    height: 350px;
    box-shadow:0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
}


/* draggable */

.grp{
border:1px solid #ced4da;
border-radius:8px;
width:250px; 
margin:8px 0px 20px 10px;
box-shadow:0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%)
}

@media(min-width:500px){
	
.flickity-slider .grp,.flickity-slider .pst{
	left:-70!important;
}
}
@media(min-width:1000px){
.flickity-slider .grp{
	left:-100!important;
}
}
@media(min-width:1200px){
.flickity-slider .grp{
	left:-180!important;
}
}
@media(min-width:1400px){
.flickity-slider .grp{
	left:-250!important;
}
}

.card .feature-grp{
	border: 1px solid #e9ecef;
	box-shadow:none;
}

.flickity-enabled.is-draggable {
	border-radius: 10px;
  -webkit-tap-highlight-color: transparent;
          tap-highlight-color: transparent;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.flickity-enabled.is-draggable .flickity-viewport {
  cursor: move;
  cursor: -webkit-grab;
  cursor: grab;
}

.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
  cursor: -webkit-grabbing;
  cursor: grabbing;
}

/* ---- previous/next buttons ---- */

.flickity-prev-next-button {
  position: absolute;
  top: 50%;
  width: 44px;
  height: 44px;
  border: none;
  border-radius: 50%;
  background: #fff;
  box-shadow:inset #eee 0em 0em 5px;
  cursor: pointer;
  /* vertically center */
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.flickity-prev-next-button:hover { background: white; }

.flickity-prev-next-button:focus {
  outline: none;
  box-shadow: 0 0 0 5px #09F;
}

.flickity-prev-next-button:active {
  background:#e4e6eb;
  box-shadow:none;
}

.flickity-prev-next-button.previous { left: 10px; }
.flickity-prev-next-button.next { right: 10px; }

.flickity-prev-next-button:disabled {
  opacity: 0;
  cursor: auto;
}

.flickity-prev-next-button svg {
  position: absolute;
  left: 20%;
  top: 20%;
  width: 60%;
  height: 60%;
}
.dropdown-item.active, .dropdown-item:active{
	background:inherit!important;
	color:inherit!important;
}


.select-illustration input[type="radio"]{
	opacity:0;
	position:absolute;
}

.select-illustration{
	display:flex;
	width:auto;
	padding:4px;
	overflow:auto!important;
	padding-bottom:10px;
}

.select-illustration input[type="radio"]:checked + label{
	border: 2px solid #7083ab;
    border-radius: 7px;
    border-style: dashed;
    padding: 3px;
}

.select-illustration img{
	border-radius:5px;
	width:300px!important;
	height:160px!important;
}

.jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content label{
	min-width:90%!important;
	display:initial!important;
    margin-bottom:0!important;
	margin:4px;
	background:none;
}


#eventForm label{
	font-weight:500!important;
	margin-top:0px;
}


.dark-mode .dummies, .dark-mode .dummies span {
	color:#ebebeb;
}
.dark-mode .jconfirm.jconfirm-white .jconfirm-box, .dark-mode .jconfirm.jconfirm-light .jconfirm-box{
	background:#444b51;
    color:#e7e7e7;
}

/*normal gray*/
.dark-mode #dummy,.dark-mode #h4,.dark-mode .info{
	color:#ebebeb!important;
}

/*gray border and dark bg*/
.dark-mode .prevCard::-webkit-scrollbar-track{
	background:transparent;
	border:none;
}

/*Mild Gray Backround*/
.dark-mode .select2-container--bootstrap4 .select2-selection, .dark-mode .pmind{
    background-color: #343a40!important;
}
.dark-mode .groupCard{
	background:linear-gradient(180deg, #575f66, #343a40 40%);
}
</style>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-sacle=1.0, user-scalable=no"/>
  <title>Group</title>

	<script src="../js/jquery.min.js"></script>
	
	<!-- JQUERY ALERT BOX -->
	<link rel="stylesheet" href="../js/jqueryAlertBox/jquery-confirm.min.css">
	<script src="../js/jqueryAlertBox/jquery-confirm.min.js"></script>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../theme/plugins/toastr/toastr.min.css">
  
  
	<!--checkbox styling-->
	<link rel="stylesheet" href="../theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	
	
	<link rel="stylesheet" href="../theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="../theme/plugins/daterangepicker/daterangepicker.css">

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




		<body class="hold-transition dar-mode sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
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

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../" class="brand-link">
      <img src="../images/site/elogo.png" alt="eBlaze Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
     <span class="brand-text font-weight-light" style="font:normal 19px 'Cookie', cursive; font-weight:600;">EazyBlaze</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="padding-left:2px">
          <img src="<?php echo $userimage;?>" class="img-circle elevation-2" alt="Profile Image" style="width:50px;height:50px;">
        </div>
        <div class="info">
          <a href="../profile.php?profileid=MQ==" class="d-block"><?php echo htmlspecialchars($row["name"]);?><br>Manager</a>
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
                <a href="./profile.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Company profile</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="manage.php?account_token=<?php //echo $ads["token"];?>" class="nav-link">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-credit-card nav-icon"></i>
                  <p>Promote Ads</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="gallery.php" class="nav-link">
                  <i class="material-icons nav-icon">content_copy</i>
                  <p>Gallery</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Feedback</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-exclamation-circle nav-icon"></i>
                  <p>Support</p>
                </a>
              </li><br>
              <li class="nav-item">
                <a href="../index.php" class="nav-link">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
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
        
		
		
		
		
			<div class="row">
			<div class="col-md-12">
            
			
			<!-- /TOP CARD - for GROUP COVER -->
			<div class="card groupCard">
			
			<div class="col-md-8" style="margin:auto;">
			<center>
			<div id="coverImg">
			<img src="<?php echo htmlspecialchars($groupCover);?>" class="gImage">
			</div>
			</center>
			
		<div class="btn-group float-right" style="top:-55;right:15;">
		<button type="button"  class="btn btn-default bt-edit dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
		<i class="far fa-edit"></i> Edit </button>
        
		<div class="dropdown-menu dropdown-menu-right" style="padding:0px;">
		<label for="groupCover" class="dropdown-item" style="padding:10px;margin:0;font-weight:500">
		<span class="ash-hov" style="padding:6px; height:40px"><i class="material-icons">add_a_photo</i></span> Take a photo</label>
		<div class="dropdown-divider"></div>
        <label for="groupCover2" class="dropdown-item" style="padding:10px;margin:0;font-weight:500">
		<span class="ash-hov" style="padding:6px;"><i class="material-icons">create_new_folder</i></span> Upload a photo</label>
		<div class="dropdown-divider"></div>
        <label class="dropdown-item" id="illustrate" style="padding:10px;margin:0;font-weight:500">
		<span class="ash-hov" style="padding:6px;"><i class="material-icons">format_paint</i></span> Choose an illustration</label>
        </div></div>
			
		<input type='file' name='groupCover' class='display-none' id='groupCover' accept="image/*" capture="camera" />
		<input type='file' name='groupCover' class='display-none' id='groupCover2' accept="image/*" />
	
			
			
		<div class="dummies">
		<h2 style="font-weight:600;padding:15px 15px 0px" id="gname"><?php echo htmlspecialchars($groupVal["group_name"]);?></h2>
			
		
		
		<section style="display:flex;justify-content:space-between;flex-flow: wrap;">
		<div style="margin-top:-20px!important;margin-bottom:-15px;padding:15px">
		<span><?php if("open"=="Private"){echo '<i class="fa fa-lock"></i> Open Group';}	
						else{echo '<i class="glyphicon glyphicon-globe"></i> Public Group';}?></span> 
						<span style="vertical-align: text-bottom;">.</span>		
		<span><b>258 members</b></span>						
		</div>
			
		<div style="display:flex; float:right;">
		<button type="button" style="margin:3px" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-users"></i> Joined&nbsp; </button>
            <div class="dropdown-menu dropdown-menu-right" style="">
            <a class="dropdown-item" href="#">Dropdown link</a>
            <a class="dropdown-item" href="#">Dropdown link</a>
            </div>
				
        <button type="button" class="btn btn-danger" style="margin:3px">+ Invite</button>
        <button type="button" class="btn btn-default" id="tog-show" style="margin:3px">&nbsp;<i class="fas fa-angle-down"></i>&nbsp;</button>
        <button type="button" class="btn btn-default display-none" id="tog-hide" style="margin:3px">&nbsp;<i class="fas fa-angle-up"></i>&nbsp;</button>
        </div>

		</section>
		
		<p>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			<div id="feature-grp" style="height:0px;overflow:hidden;transition:1s;">
			<div class="card feature-grp">
			<div style="font-weight:500; margin:15px 15px">Related groups</div>
			
			<?php
			// $groupCat = $groupVal["category"];
			$stmt = $pdo->prepare("SELECT * FROM groups");
			// $stmt-> bindParam(':category', $groupCat, PDO::PARAM_STR);
			$stmt->execute();
			$getGroups = $stmt->fetchAll();
			if($stmt->rowCount()>0){
			?>
		
			<div class="carousels" data-flickity='{ "autoPlay": false, "pageDots": false }' style="transform: translateX(0.17%)!important;">
			
			<?php
			foreach($getGroups as $getGroup){
				
			//check if group cover is illustration or uploaded pix and change folder img var location
			$cover = substr($getGroup["cover"],0,17);
			if($cover == $ils){
			$getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/illustrations/".$getGroup["cover"]: "images/group-cover/illustrations/illustrate7.png");
			}else{
			$getGroupCover = (!empty($getGroup["cover"]) ? "images/group-cover/".$getGroup["cover"]:"images/group-cover/illustrations/illustrate7.png");
			}
			?>
			
			<div class="grp">
            <img class="d-block w-100" src="<?php echo $getGroupCover;?>" style="height:130px;width:100%;border-radius:8px 8px 0px 0px;">
			<div style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;padding:8px">
			<h5 style="margin-bottom:-1px"><?php echo $getGroup["group_name"];?></h5>
			<font style="color:#869099;font-size:15px;">
			<?php echo $getGroup["description"];?></font><br>
			
			<a href="#"> <span class="badge badge-secondary text-white" style="font-size:13px;">
			<i class="fa fa-folder-o"></i> <?php //echo htmlspecialchars($groupVal["category"]);?></span></a>
			
			<button class="btn btn-primary btn-block" style="margin-top:20px;font-weight:600">Join Group</button>
			</div>
			</div>
			
			<?php } ?>
			</div>
			<?php }else{ ?>
			
			<div style="display:grid;place-items:center;margin-bottom:25px">
			<img src="images/img/pipo.svg" width="120px">
			<h3>No recommendations to show</h3>
			<button class="btn btn-danger">Explore Group</button>
			</div>
			
			
			<?php } ?>
			</div>
			</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
			
			<div class="dropdown-divider"></div>
			
			
			<!--Tab Links -->
			<ul class="nav nav-pills top-menu" style="display:flex">
			<li class="nav-item tab_1"><a class="bg nav-link" href="#about" data-toggle="tab">About</li></a>
				
			<li class="nav-item tab_2"><a class="nav-link bg active" href="#discussion" data-toggle="tab">Discussion</li></a>
				
			<li class="nav-item tab_3"><a class="nav-link bg" href="#tab_3" data-toggle="tab">Featured</li></a>
			
			<li class="nav-item tab_4"><a class="nav-link bg" href="#tab_4" data-toggle="tab">Events</li></a>
			
			<li class="nav-item tab_5"><a class="nav-link bg" href="#tab_5" data-toggle="tab">Media</li></a>
			
			<li class="nav-item tab_6"><a class="nav-link bg" href="#tab_6" data-toggle="tab">Members</li></a>
			</ul>
			<!-- /Tab Links -->
			
			
			</div></div>
            </div>
			<!-- /TOP CARD -->
			
			</div>
			</div><!-- /row -->
		
			
			
			
		
		
			<!-- /Contents posts-->
			<div class="col-md-8" id="adjust" style="margin:auto;">
			<div class="row">
			<div class="tab-content col-md-7">
				 


				 
            <!-- /.tab-pane 1-->
            <div class="tab-pane" id="about">
				    
			<!--for about-->
				  	  
			</div>
			<!-- /.tab-pane 1-->
				  
				  
				  
				  
				  
				  
            <!-- /.tab-pane 2-->
            <div class="tab-pane active" id="discussion">
           
			<div class="card" style="padding:15px;height:140px;">
			<div class="author-avatar" style="display:flex;margin-bottom:10px;">
			<div>
			<img src="<?php echo $userimage;?>" width="45px" height="45px" style="border-radius:50%;">
			</div>
			<span class="pmind" style="background:#f0f2f5;color:#666; border: 1px solid #e1e1e1; padding:10px; border-radius:20px;width:100%; margin:2px 8px; height:48px;">
			&nbsp; What's on your mind?
			</span>
            </div>
			<div class="dropdown-divider"></div>
            <div class="span2" style="display:flex;width:100%;justify-content:space-between;font-size:14px;text-align:center; margin-top:5px;">
            <span style="width:49%;border:none!important" data-toggle="tooltip">
			<i style="color:#f02849" class="material-icons">collections</i> Photos/Posts</span>

            <span style="width:49%;border:none!important" data-toggle="tooltip">
			<i style="color:#45bd62" class="material-icons">link</i> Video Link</span>
			</div>
			</div>
			
			
			<div class="card"><div style="font-weight:500; margin:15px 15px">Featured
			<span class="float-right ash-hov dropdown-toggle" data-toggle="dropdown"><i class="material-icons">info_outline</i></span>
			
			<div class="dropdown-menu dropdown-menu-right f-info" style="">
			
			<?php if($userid == $adminId){?>
			<div class="title">About Featured</div>
			You can pin items to be displayed at the top of the group, including posts, rules and hashtags.<p>
			
			<div class="f-info-items"><i class="material-icons">remove_red_eye</i> 
			<span>Everyone in the group will see these items.</span></div>
			
			<div class="f-info-items"><i class="material-icons">access_time</i> 
			<span>Pinned items remain visible until you remove them.</span></div>
			
			<p><div class="dropdown-divider"></div>
			<div style="font-size:13px;margin:3px;color:#888">Only admins can see this.</div>
			<?php }else{?>
		
			<div class="title">About Featured</div>
			Your admins have pinned these items for the group to see.
			<?php }?>
			
			</div>
			
			</div>
			<div class="carousels" data-flickity='{ "autoPlay": false, "pageDots": false }'>
			
			<div class="carousel-cell pst">
			<img src="images/img/groupBg.png" style="width:100%;height:120px;border-radius:10px 10px 0 0">
			<div style="padding:15px">
			<h6>Feature the best of your group</h6>
			Pin posts, hashtags and rules at the top of your group in Featured, formerly known as Announcements.
			<br><br>To get you started, we've displayed your most recent pins.
			<p><div class="dropdown-divider"></div>
			<div style="font-size:13px;margin:3px;color:#888">Only admins can see this.</div>
			</div>
			</div>
			
			<div class="carousel-cell pst">
			
			<div class="author-avatar" style="display:flex; padding:10px 10px 0 10px;">
			<div>
			<img src="<?php echo $adminImg;?>" width="40px" height="40px" style="border-radius:50%;">
			</div>
			<span style="margin:2px 8px;font-weight:500">
			<?php echo htmlspecialchars($admin["name"]);?><br>
			<span style="font-size:13px;font-weight:400;color:#bbb">20 April, 2022 <span style="vertical-align:text-bottom;">.</span>
			<?php if("open"=="Private"){echo '<i class="fa fa-lock"></i>';}else{echo '<i class="glyphicon glyphicon-globe"></i>';}?>
			</span>
			</span>
            </div>
			
			<div style="padding:15px">
			<a href="#">
			Test
			</a>
			</div>
			
			<div style="overflow:hidden;max-height:150px">
			<?php
			if(!empty($feature["image"])){
			echo '<img src="images/features/'.$feature["image"].'" width="200px">';
			}else{
			echo '<img src="'.$groupCover.'" width="100%">';
			}
			
			?>
			</div> 
			<br>
			<div class="dropdown-divider"></div>
			<div style="font-size:13px;color:#888;padding:10px;">
			<?php echo htmlspecialchars($groupVal["group_name"]);?>&nbsp; |&nbsp;
			<a href="#"> <span class="badge badge-secondary text-white"><i class="fa fa-folder-o"></i> <?php echo htmlspecialchars("test");?></span></a>
			</div>
			</div>
			
			
			</div>
			</div>
			
			
			
			<p><br>
			
			
            </div>
			<!-- /.tab-pane 2-->





			
				  
				  
			<!-- /.tab-pane 3-->
            <div class="tab-pane" id="tab_3">
                   
			Featured
				   
            </div>
			<!-- /.tab-pane 3-->
				  
				 
				 
				   
			<!-- /.tab-pane 4-->
            <div class="tab-pane" id="tab_4">    
			
			<!-- for events -->
			
            </div>
			<!-- /.tab-pane 4-->
				  
				 
		 
				 
            
			<!-- /.tab-pane 5-->
            <div class="tab-pane" id="tab_5">
                    
			<!-- for Media -->
					
            </div>
			<!-- /.tab-pane 5-->
				 
				 
				 
            
			<!-- /.tab-pane 6-->
            <div class="tab-pane" id="tab_6">
                    
			<!-- for Members -->
					
            </div>
			<!-- /.tab-pane 6-->
				  
				 
               

			</div> 
			<!--TABS Col 1-->
				
				
				
				
				
			
			<!--col 2 - SIDEBAR-->
			<div class="col-md-5" id="right-bars">
			
			<?php if($userid == $adminId){?>
			<div class="card" style="min-height:130px;padding:0px">
		
            <div style="padding:15px;">
			<span class="title">Changes to public groups</span>
			<div class="text-muted">Learn about key updates to your group</div>
			</div>
			
			
            <div class="opts">
			<div style="margin-right:10px;"><img src="images/img/option.png" style=" border-radius:10px;"></div>
			<div><span class="title">Membership</span>
			<div class="text-muted">People can join straight away, but you control who can post.</div></div>
			<i style="margin-top:30px;margin-left:5px;" class="glyphicon glyphicon-menu-right"></i>
			</div>
			
            <div class="opts">
			<div style="margin-right:10px;"><img src="images/img/visit.png" style=" border-radius:10px;"></div>
			<div><span class="title">Visitors</span>
			<div class="text-muted">By default, people who haven't joined can post.</div></div>
			<i style="margin-top:30px;margin-left:5px;" class="glyphicon glyphicon-menu-right"></i>
			</div>
			
            <div class="opts">
			<div style="margin-right:10px;"><img src="images/img/set.png" style=" border-radius:10px;"></div>
			<div><span class="title">New tools</span>
			<div class="text-muted">There are now more ways to keep your group safe.</div></div>
			<i style="margin-top:30px;margin-left:5px;" class="glyphicon glyphicon-menu-right"></i>
			</div>
			
			<div class="lilCloud"><i class="fa fa-youtube-play"></i> Watch video</div>
		
			</div>
			<!--/card-->
			<?php }?>
			
			
			
			
			
			
			
			
			<div class="card" style="padding:15px;min-height:130px;">
			
			<div>
			<span class="title">About</span>
			<p>
			
			<?php 
			$des_length = htmlspecialchars($groupVal["description"]);
			if(strlen($des_length)<=120){
			echo $des_length;
			}else{
			$des_trim = substr($des_length,0,120);
			echo "<div class='text-muted readMore'>".$des_trim."... <span class='readMoreBtn'>See more</span></div>";
			}?>	 	 
			<div class="text-muted readLess"><?php echo $des_length; ?> <br> <span class='readLessBtn'>See less </span></div>
			
			</div>
			<p>
			  
             <div> 
			<?php if("open"=="Private"){echo '<span class="title"> &nbsp;<i class="fa fa-lock"></i> &nbsp;Private</span>
						<div class="text-muted" style="margin-left:23px;">Only members can see who\'s in the group and what they post.</div>';}
			else{echo '<span class="title">&nbsp; <i class="glyphicon glyphicon-globe"></i> &nbsp;Public</span> 
						<div class="text-muted" style="margin-left:20px;">Anyone can see who\'s in the group and what they post.</div>';}?>
			</div>
			<?php if(!empty($groupVal["location"])){?>
			<p>
            <div>
			<span class="title"><i class="material-icons">location_on</i>
			<?php echo htmlspecialchars($groupVal["location"])?></span>
			</div>
			<?php }?>
			<p>
            <div>
			<span class="title"><i class="fas fa-group"></i> &nbsp;General</span>
			</div>
			
			
			</div>
			<!--/card-->
			
			</div>
			<!--/SIDEBAR-->
				
				
				
				
				
				
           </div> 
		   <!--/row-->
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
			<!--for Event-->
			<section id="events" class="display-none"> 
			<div class="card" style="padding:15px">
			<section style="display:flex;justify-content:space-between;margin-bottom:10px">
            <div class="title" id="ups">Upcoming events</div>
            <div>
			<button class="btn btn-default" style="font-size:15px!important;font-weight:500;">Find <i class="fa fa-search"></i></button>
			<button id="createEvent" class="btn btn-primary" style="font-size:15px!important;font-weight:500;">Create +</button>
			<button id="cancelEvent" class="btn btn-danger display-none" style="font-size:15px!important;font-weight:500;">Cancel</button>
			</div>
			</section><div class="dropdown-divider"></div>
			
			
			
			<form id="eventForm" class="display-none">
			<div class="col-md-6" style="margin:10px auto auto auto;">
            
			<div class="text-red" style="margin:10px auto 6px auto;text-align:center" id="result"></div>
			
			<div class="form-group">
			<label for="eventTitle">Event title</label>
            <input type="text" name="eventTitle" class="form-control" id="eventTitle" placeholder="">
            </div>
			
			
			<!--Start Date Time-->
			<div class="row" style="justify-content:space-between;">
			<div class="form-group col-6">
            <label for="startDate">Start Date</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" name="startDate" id="startDate" class="form-control datetimepicker-input" data-target="#reservationdate" 
			data-toggle="datetimepicker">
            </div>
            </div>
			
			<div class="form-group col-6">
            <label for="startTime">Start time</label>
			<div class="input-group date" id="timepicker" data-target-input="nearest">
            <input type="text" name="startTime" id="startTime" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker">
            </div>
            </div>
			</div>
			
			
			<div class="text-priary prime-hover" id="addEndTime" style="margin:-12px 0px 20px;font-size:15px;">+ End Time</div>
			
			<!--End Date Time - optional-->
			<div class="row display-none" id="endTimeDrop" style="justify-content:space-between;place-items:center">
			<div class="form-group col-6">
            <label for="endDate">End Date</label>
            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
            <input type="text" name="endDate" id="endDate" class="form-control datetimepicker-input" data-target="#reservationdate2" 
			data-toggle="datetimepicker">
            </div>
            </div>
			
			<div class="form-group col-5">
            <label for="endTime">End time</label>
			<div class="input-group date" id="timepicker2" data-target-input="nearest">
            <input type="text" name="endTime" id="endTime" class="form-control datetimepicker-input" data-target="#timepicker2" data-toggle="datetimepicker"> 
            </div>
            </div>
			<i id="closeEndTimeDrop" style="margin-top:10px" class="fas fa-close prime-hover"></i>	
			</div>









				
			<div class="form-group icheck-primary d-inline">
			<div class="icheck-primary d-inline">
            <input type="checkbox" id="eventType" value="" name="eventType">
            <label for="eventType">Online Event</label>
            </div>
			<div class="text-muted" style="font-size:14px;margin-bottom:10px;">Create event that takes place online without a physical loaction</div>
			</div>
			
			<div class="form-group">
			<label for="eventLocation">Location</label>
            <input type="text" name="eventLocation" class="form-control" id="eventLocation">
			</div>
			
			<div class="form-group">
			<label for="eventDescription">Description</label>
            <textarea name="eventDescription" class="form-control" id="eventDescription"></textarea>
			</div>
			
			<button type="submit" class="btn btn-block btn-primary">Create</button>
			</div>
			</form>
			
			
			
			
			<?php
			$sql=$pdo-> prepare("SELECT * from users where userid =:userid");
			$sql-> bindParam(':userid', $adminId, PDO::PARAM_STR);
			$sql->execute();
			$admin=$sql->fetch();
			//Group Admin image
			$adminImg = (!empty($admin["profilepix"]) ? "../images/profilepix/".$admin["profilepix"]: "../images/site/user.png");
			?>
			
			<div id="upcomingEvent">
			
			<div id="noEvent" style="display:grid;place-items:center;margin:40px auto">
			<img src="images/img/event-light.png">
			<div class="text-muted">No upcoming events.</div><p>
			</div>
			
			</div>
			
			</div>
			<p><br>
		    </section>
		  
		  
		  
		  
		  
			
			<!--for about-->
			<section id="abouts" class="col-md-6 display-none" style="margin:auto;">
			<div class="card" style="padding:15px;min-height:130px;">
			<div>
			<div class="title" style="margin:0px 0px 10px">About this group</div>
			<div class="dropdown-divider" style="padding:10px 0px 5px"></div>
			<?php 
			$des_length = htmlspecialchars($groupVal["description"]);
			if(strlen($des_length)<=120){
			echo $des_length;
			}else{
			$des_trim = substr($des_length,0,120);
			echo "<div class='text-muted readMore'>".$des_trim."... <span class='readMoreBtn'>See more</span></div>";
			}?>	 	 
			<div class="text-muted readLess"><?php echo $des_length; ?> <br> <span class='readLessBtn'>See less </span></div>
			</div>
			<p>
            <div> 
			<?php if("open"=="Private"){echo '<span class="title"> &nbsp;<i class="fa fa-lock"></i> &nbsp;Private</span>
						<div class="text-muted" style="margin-left:23px;">Only members can see who\'s in the group and what they post.</div>';}
			else{echo '<span class="title">&nbsp; <i class="glyphicon glyphicon-globe"></i> &nbsp;Public</span> 
						<div class="text-muted" style="margin-left:20px;">Anyone can see who\'s in the group and what they post.</div>';}?>
			</div>
			<?php if(!empty($groupVal["location"])){?>
			<p>
            <div>
			<span class="title"><i class="material-icons">location_on</i>
			<?php echo htmlspecialchars($groupVal["location"])?></span>
			</div>
			<?php }?>
			<p>
            <div>
			<span class="title"><i class="fas fa-group"></i> &nbsp;General</span>
			</div>
			</div>
			<p><br>
			</section>
			


			 
			<!--for for media-->
			<section id="media" class="display-none"> 
			<div class="card" style="padding:15px;">
			<section style="display:flex;justify-content:space-between;">
            <div class="title">Media</div>
			</section>
			</div>
			<p><br>
			</section>

			 
			 
			 
			<!--for for members-->
			<section id="members" class="display-none"> 
			<div class="card" style="padding:15px;">
			<section>
            <div class="title">Members</div>
			</section>
			</div>
			<p><br>
			</section>










		  </div>
           <!--/col-8 -  -->
            
			
			
			
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div><!-- /.container-fluid -->
		</section>
			
			
			
			
			
			
			


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->





</div>
<!-- ./wrapper -->








<script src="../theme/plugins/moment/moment.min.js"></script>
<script src="../theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../theme/plugins/daterangepicker/daterangepicker.js"></script>

<script src="../js/flickity.js"></script>


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

$(document).ready(function(){
	$("#loader-image").hide();

		
	  //Toaster
	  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });
	
	
	
	//Adjust col on small screen
	if($(window).width() < 1300){
	$("#adjust").removeClass("col-md-8");
	$("#adjust").addClass("col-md-11");
	}
	if($(window).width() < 900){
	$("#adjust").removeClass("col-md-8, col-md-11");
	$("#adjust").addClass("col-md-12");
	}

	
	//READ MORE AND LESS - About
	$(".readMoreBtn").click(function(){
	$(".readLess").css({"height":"auto","transition":"0.2s"});
	$(".readMore").css({"height":"0px","overflow":"hidden","transition":"0.2s"});
	});

	$(".readLessBtn").click(function(){
	$(".readMore").css({"height":"auto","transition":"0.2s"});
	$(".readLess").css({"height":"0px","overflow":"hidden","transition":"0.2s"});
	});

  	
	//toogle TOP RELATED GROUP
	$("#tog-show").click(function(){
	$("#feature-grp").css({"height":"auto","opacity":"1"});	
	$("#tog-show").addClass("display-none");
	$("#tog-hide").removeClass("display-none");
	});
	$("#tog-hide").click(function(){
	$("#feature-grp").css({"height":"0px","opacity":"0"});	
	$("#tog-show").removeClass("display-none");
	$("#tog-hide").addClass("display-none");
	});
  
  
  
	
	
	
	
	
	//toogle Tabs based on clicked tab
  
	//for events
  	$(".tab_4").click(function(){
	$("#right-bars").addClass("display-none");	
	$("#abouts").addClass("display-none");	
	$("#media").addClass("display-none");	
	$("#members").addClass("display-none");	
	$("#events").removeClass("display-none");	
	});
	
	//for Discussion and featured
  	$(".tab_2, .tab_3").click(function(){
	$("#events").addClass("display-none");	
	$("#abouts").addClass("display-none");	
	$("#media").addClass("display-none");
	$("#members").addClass("display-none");
	$("#right-bars").removeClass("display-none");
	});
	
	//for about
  	$(".tab_1").click(function(){
	$("#events").addClass("display-none");	
	$("#right-bars").addClass("display-none");
	$("#media").addClass("display-none");
	$("#members").addClass("display-none");
	$("#abouts").removeClass("display-none");
	});
	
	//for media
  	$(".tab_5").click(function(){
	$("#events").addClass("display-none");	
	$("#right-bars").addClass("display-none");
	$("#abouts").addClass("display-none");
	$("#members").addClass("display-none");
	$("#media").removeClass("display-none");
	});
	
	//for Members
  	$(".tab_6").click(function(){
	$("#events").addClass("display-none");	
	$("#right-bars").addClass("display-none");
	$("#abouts").addClass("display-none");
	$("#media").addClass("display-none");
	$("#members").removeClass("display-none");
	});
	
	
  
  
  
	
	//CONTROLS
	
	//Create Event Toogle btn 
	$("#createEvent").click(function(){
		$("#upcomingEvent").fadeOut("fast", function(){
			
			//change Title
			$("#ups").html("Create event");
			//hide create btn
			$("#createEvent").addClass("display-none");
			//show cancel btn
			$("#cancelEvent").removeClass("display-none");
			
			//show create form
			$("#eventForm").removeClass("display-none").fadeIn();
			
		});
	
	});
	
	//Cancel Create Event Toogle 
	$("#cancelEvent").click(function(){
		$("#eventForm").fadeOut("fast", function(){
			
			//change Title
			$("#ups").html("Upcoming events");
			//show create btn
			$("#createEvent").removeClass("display-none");
			//hide cancel btn
			$("#cancelEvent").addClass("display-none");
			
			//Reset all form inputs
			$('#eventForm')[0].reset();
			
			//show upcoming Event
			$("#upcomingEvent").fadeIn();
		});
	
	});


	
	
	//Add Event Endtime - optional input

	$("#addEndTime").click(function(){
		$("#addEndTime").fadeOut(100,function(){
		$("#endTimeDrop").removeClass("display-none");	
		});
	});

	$("#closeEndTimeDrop").click(function(){
		$("#endTimeDrop").addClass("display-none");	
		$("#addEndTime").fadeIn(100);
		
		//clear input
		$("#endDate").val("");
		$("#endTime").val("");
		
	});



	



	

 //UPLOAD Group Cover option 2

 $('#groupCover2').change(function(){
  var form_data = new FormData();
  var files = $('#groupCover2')[0].files;


   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("groupCover2").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {

	//Toast error
    Toast.fire({
       icon: 'error',
       title: 'Please select a valid image file'
	})
	
	return false;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("groupCover2").files[i]);
    var f = document.getElementById("groupCover2").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 9194304) //9mb
    {
      
	//Toast error
    Toast.fire({
       icon: 'error',
       title: 'Image is too large. Allowed max size is 9MB'
	})
return false;
    }
    else
    {
     form_data.append("groupCover[]", document.getElementById('groupCover2').files[i]);
    }
   }
  

	if(files.length > 0){
   $.ajax({
    url:"groupScript.php?gimage=<?php //echo $token;?>",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){$("#loader-image").show();},   
    success:function(data){
				
		//hide Loader
		$("#loader-image").hide();
		
		//Embed image
		$("#coverImg").html(data);
		
		
		
    }
   });
	}
	 });
	
	
	
	
	//UPLOAD Group Cover option 3


	$('#illustrate').click(function(){

	$.confirm({
   	title: 'Update cover photo',
    animation: 'illustrate',
    closeAnimation: 'scaleY',
    content: 
	'<label>Select illustration</label>' +
	
	
    '<form>' +
    '<div class="select-illustration">' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate1.png" id="rad1" required />' +
	'<label for="rad1"><img src="images/group-cover/illustrations/eblaze_illustrate1.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate2.png" id="rad2" required />' +
	'<label for="rad2"><img tabindex="0" src="images/group-cover/illustrations/eblaze_illustrate2.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate3.png" id="rad3" required />' +
	'<label for="rad3"><img src="images/group-cover/illustrations/eblaze_illustrate3.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate4.png" id="rad4" required />' +
	'<label for="rad4"><img src="images/group-cover/illustrations/eblaze_illustrate4.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate5.png" id="rad5" required />' +
	'<label for="rad5"><img src="images/group-cover/illustrations/eblaze_illustrate5.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate6.png" id="rad6" required />' +
	'<label for="rad6"><img src="images/group-cover/illustrations/eblaze_illustrate6.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate7.png" id="rad7" required />' +
	'<label for="rad7"><img tabindex="0" src="images/group-cover/illustrations/eblaze_illustrate7.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate8.png" id="rad8" required />' +
	'<label for="rad8"><img src="images/group-cover/illustrations/eblaze_illustrate8.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate9.png" id="rad9" required />' +
	'<label for="rad9"><img src="images/group-cover/illustrations/eblaze_illustrate9.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate10.png" id="rad10" required />' +
	'<label for="rad10"><img src="images/group-cover/illustrations/eblaze_illustrate10.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate11.png" id="rad11" required />' +
	'<label for="rad11"><img src="images/group-cover/illustrations/eblaze_illustrate11.png"></label>' +
	
	'<input type="radio" name="illustration" value="eblaze_illustrate12.png" id="rad12" required />' +
	'<label for="rad12"><img src="images/group-cover/illustrations/eblaze_illustrate12.png"></label>' +
	
    '</div>' +
    '</form>',
	
    buttons: {
        formSubmit: {
            text: 'Upload',
            btnClass: 'btn-blue',
            action: function () {
                var illustration = $("input[name=illustration]:checked");
                if(!illustration.is(":checked")){
                    $.alert('Click an illustration to Select');
                    return false;
                }
				
				$("#loader-image").show();
				
				$.post('groupScript.php?gimage=<?php // echo $token;?>', {illustration:illustration.val()}).done(function(data){
				
				//Embed image
				$("#coverImg").html(data);
					
				$("#loader-image").hide();
				$.alert('Group Cover Updated');
				});
            }

        },
        cancel: function () {
            //close
        },
    }
});
	
});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//EVENT FORM VALIDATION
	
	
		$(function () {
	$.validator.setDefaults({
    submitHandler: function () {
    	
		
		
		let getEventType = $("#eventType");
		
		if(getEventType.is(":checked")){
			$("#eventType").val("online");
		}else{
			$("#eventType").val("");
		}
			
		let eventType = $("#eventType").val();
		let eventTitle = $("#eventTitle").val();
		let eventLocation = $("#eventLocation").val();
		let eventDescription = $("#eventDescription").val();
		let startDate = $("#startDate").val();
		let startTime = $("#startTime").val();
		let endDate = $("#endDate").val();
		let endTime = $("#endTime").val();
		let group_id = <?php echo $group_id;?>;
		
	
		
		$.ajax({
			url:'groupScript.php',
			method:'POST',
			data:{eventTitle:eventTitle,eventLocation:eventLocation,eventDescription:eventDescription,eventType:eventType,startDate:startDate,startTime:startTime,endDate:endDate,endTime:endTime,group_id:group_id},
			beforeSend:function(){$("#loader-image").show()},
			success:function(data){
				$("#result").html(data);
				
				//console.log(data);
				$("#loader-image").hide();
				
			}
		});
	  
    }
  });
  
  $('#eventForm').validate({
    rules: {
      eventTitle: {
        required: true,
        minlength: 3
      },
      startDate: {
        required: true,
      },
	  startTime: {
        required: true,
      },
	  
   eventDescription: {
     required:true,
     minlength: 10
      },
	  
	  
    },
	
    messages: {
      eventTitle: {
        required: "Your event needs a title",
        minlength: "Must be at least 3 characters long"
      },
      startDate: {
        required: "Enter event start date"
      },
      startTime: {
        required: "Enter event start time"
      },
     
      eventDescription: {
        required: "Enter event description",
		minlength: "Description is too short"
      },
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
	
	
	
  
  
  
  
  });
  
</script>























<script>
  $(function () {

    //Date picker
    $('#reservationdate, #reservationdate2').datetimepicker({
        format: 'L'
    });

    //Timepicker
    $('#timepicker, #timepicker2').datetimepicker({
      format: 'LT'
    })


  });
 





</script>




			
</body>
</html>
