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

	//get id from url and decode
	if(!empty($_GET["profileid"] OR $_GET["profileid"]!= null)){
		$profileid = intval($_GET["profileid"]);
	
	//Check if id is in DB else redirect to index.php
	$stmt=$pdo->prepare("SELECT userid FROM users WHERE userid=".$profileid);
	$stmt->execute();
	if($stmt->rowCount()<1){
	header("Location: index.php");
	}
	}else{
	header("Location: index.php");
	}
	
	
	$userid = $_SESSION["user_login"];
	
	$stmt=$pdo->prepare(
    "SELECT users.*, userdata.* 
    FROM users 
    JOIN userdata
    ON users.userid = userdata.userid
    WHERE users.userid=:userid");
  $stmt->bindParam(":userid", $profileid, PDO::PARAM_INT);
	$stmt->execute();
	$prodata=$stmt->fetch();
	$userImage = (!empty($prodata["profilepix"]) ? "images/profilepix/".$prodata["profilepix"]: "images/site/user.png");
	
	//hide edit buttons/icons if id from url does'nt match logged in user
	if($profileid!= $userid){
		echo "<style>i.fa-edit,i.fa-close,i.fa-trash,i.fa-plus,#cam{display:none}</style>";
	}
	
	//hide "Add More Schools" input if Unavailable
	if($profileid!= $userid && empty($prodata["moreschool"])){
		echo "<style>.moreschool{display:none}</style>";
	}

	if($profileid!= $userid && empty($prodata["location"])){
		echo "<style>.location{display:none}</style>";
	}
	
	if($profileid!= $userid && empty($prodata["country"])){
		echo "<style>.country{display:none}</style>";
	}

	if($profileid!= $userid && empty($prodata["gender"])){
		echo "<style>.gender{display:none}</style>";
	}
	
?>


<style>
@media(max-width:991px){
.col-md-9{
 padding-right: 0px!important;
 padding-left: 0px!important;
}
}

.profile-user-img {
    width: 150px!important;
    height: 150px!important;
    /* padding: 3px; */
    margin-top: -100px!important;
}
#loader-wrapper2 {
    position: absolute!important;
    right: 0!important;
    margin: auto!important;
	width:100%!important;
    height: inherit!important;
    background: rgba(255, 255, 255, 0.58);
}
</style>


<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Profile</title>

	
<script src="js/jquery.min.js"></script>
<!-- <script src="js/jquery-3.2.1.min.js"></script> -->


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


  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="theme/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="theme/plugins/iCheck/flat/blue.css">
  
  
</head>


<body class="hold-transition skin-darkblue sidebar-mini">
<div class="wrapper">


 <!-- include header -->
<?php include('include/header.php');?>
  
 <!-- include sideBar -->
<?php include('include/sidebar.php');

?>
  
  

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

      <?php
      $stmt=$pdo->prepare("SELECT * FROM sampleid WHERE userid=".$profileid);
			$stmt->execute();
			$stmt->execute();
			$getId = $stmt->fetch();

      if(str_contains($getId["ids"], "FUL")){echo "Staff Profile <img src='images/site/badge.jpg' style='width:30px; border-radius:50%'>";}
      else{echo "Student Profile";}
      ?>
      </h1>
      <ol class="breadcrumb">
        <li>
        <a href="index.php">
        <i class="fa fa-home"></i> Home</a></li>
        <li class="active"> &nbsp;| Profile</li>
      </ol>
    </section>





    <!-- Main content -->
    <section class="content">

  <div class="row">
  <div class="col-md-3">



		
	<!--Userid gotten from $_GET sent to fetch-user-coverpix.php to get the user cover pix onloaad-->
	<form id="getProfileId">
	<input class="hidden" name="profileid" value="<?php echo htmlspecialchars($profileid); ?>">
	</form>		

		
<div class="cover-bg">

<!--loader image-->
<span id="loader-wrapper2" class="display-none"><div id="loader"></div></span>

<?php if($profileid == $userid){?>
<i class="fa fa-camera" id="showCam"></i>
<i class="fa fa-times-circle display-none hideCam" style="font-size:35px;"></i>
<?php }?>

<div class="drop-camera" id="drop-camera">

<!--Place the cover pix fetched from fetch-user-coverpix.php on this div-->
<div class="updateSucessful"></div>

<div style="width:90%; margin:10px auto 6px auto;">
<label for='userCover' class="cam-item pro-label text-sm"> Update cover photo</label>
<input type="file" name="multiple_files" class="display-none" id="userCover" accept="image/*">

<a href="profileImage.php"><label class="cam-item pro-label text-sm"> Update Profile Pix</label></a>
<a href="index.php"><label class="cam-item pro-label"><span class="fa fa-caret-left"></span> Back Home</label></a><br>
</div>
<center>
<div class="fa fa-chevron-circle-up hideCam"></div>
</center>
</div>

</div>
	



<script>

$(document).ready(function(){
	$("#showCam").click(function(){
	$("#drop-camera").css({"height":"100%","opacity":"100"});
	$("#showCam").fadeOut("slow", function(){
		$(".hideCam").removeClass("display-none").fadeIn("slow");
	});
	});
	
	$(".hideCam").click(function(){
	$("#drop-camera").css({"height":"0","opacity":"0"});
	$(".hideCam").fadeOut("slow", function(){
		$("#showCam").fadeIn("slow");
	});
	});
	
	
	
	
	});
	
	


</script>		
		
		
		
		

          <!-- Profile Image -->
          <div class="card card-widget">
            <div class="card-body card-profile">
			
			<?php if($profileid == $userid){?><a href="profileImage.php"><?php }?>
			<img src="<?php echo $userImage;?>" alt="User profile picture" class="profile-user-img img-responsive img-circle">
			<?php if($profileid == $userid){?></a><?php }?>
			
      <h3 class="profile-username text-center"><?php echo htmlspecialchars($prodata["name"]);?></h3>
      <br>
      <!-- <p class="text-muted text-center">Software Engineer</p> -->



      <?php if(!empty($prodata["course"])){?>
      <strong><i class="fa fa-book margin-r-5"></i> Department</strong>
      <p class="text-muted">
      <?php echo htmlspecialchars($prodata["course"]);?>
      </p>
      <hr>
      <?php }?>

      <strong>
      <i class="fa fa-school margin-r-5 text-red"></i> Institution(s)</strong>
      <p>
      </p><div class="text-muted" style="display:flex">
      <div class="locationLabel"></div>&nbsp; 
      <div class="countryLabel">
      <?php if(empty($prodata["institution"])){echo "Not Updated";}else{echo htmlspecialchars($prodata["institution"]);}?>

      <?php if(!empty($prodata["moreschool"])){echo "<br>". htmlspecialchars($prodata["moreschool"]);}?>
      
      </div>
      </div>

    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

    </div>
    <!-- /.col -->



        <div class="col-md-9">

        
	
<div class="profile-content card">
<form id="updateForm">
<div class="profile-con-1">
<section>
<div class="heading">Personal Info</div><br>
<div class="right-profile-item">
<br>

<label class="pro-label items">
<b>Full Name</b>
<i class="fa fa-close" id="closeEdit2"></i>  
<i class="fa fa-edit" onclick="showInput(); document.updateForm.name.focus();" id="showEdit2"></i> <br>
<span id="<?php if($profileid == $userid){echo "nameLabel";}?>"><?php echo htmlspecialchars($prodata["name"]);?></span>
</label><br><div class="profile-input" id="profile-input">
<input type="text" name="name" class="inputmodify" placeholder="Enter full name" 
value="<?php if(!empty($prodata["name"])){echo htmlspecialchars($prodata["name"]);} ?>">
<button style="width:100%; padding:6px" onclick="updatename();" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items">
<b>Username</b> 
<i class="fa fa-close" id="closeEdit3"></i> 
<i class="fa fa-edit" onclick="showInput1(); document.updateForm.nick.focus();" id="showEdit3"></i> <br>
<span id="<?php if($profileid == $userid){echo "nickLabel";}?>"><?php echo htmlspecialchars($prodata["nick"]);?></span>
</label><div class="profile-input" id="profile-input1" align="center">
<input type="text" name="nick" class="inputmodify" placeholder="Enter Username" 
value="<?php if(!empty($prodata["nick"])){echo htmlspecialchars($prodata["nick"]);}?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items gender">
<b>Gender</b> 
<i class="fa fa-close" id="closeEdit4"></i> <i class="fa fa-edit" onclick="showInput2()" id="showEdit4"></i> <br>
<span id="<?php if($profileid == $userid){echo "genderLabel";}?>"><?php if($profileid==$userid && empty($prodata["gender"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["gender"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["gender"]);} ?>
</span>
</label><div class="profile-input" id="profile-input2" align="center">
<select name="gender" class="select-css" id="gender">
<option value="<?php echo htmlspecialchars($prodata["gender"]);?>">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Preferred not to say" class="gender">Preferred not to say</option>
</select>
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

</section>



<section>
<div class="heading">Education</div><br>
<div class="right-profile-item">
<br>
<label class="pro-label items">
<b>Uni | Institution</b> 
<i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit6"></i> 
<i class="fa fa-edit" onclick="showInput5(); document.updateForm.institution.focus();" id="showEdit6"></i> <br>
<span id="<?php if($profileid == $userid){echo "institutionLabel";}?>"><?php if($profileid==$userid && empty($prodata["institution"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["institution"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["institution"]);} ?></span></label>
<div class="profile-input" id="profile-input5" align="center">
<input type="text" name="institution" class="inputmodify" placeholder="Institution Attended" value="<?php if(!empty($prodata["institution"])){echo htmlspecialchars($prodata["institution"]);}?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>


<label class="pro-label items">
<b>Course of Study</b>
<i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit7"></i> 
<i class="fa fa-edit" onclick="showInput7(); document.updateForm.course.focus();" id="showEdit7"></i> <br>
<span id="<?php if($profileid == $userid){echo "courseLabel";}?>"><?php if($profileid==$userid && empty($prodata["course"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["course"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["course"]);}?></span></label>
<div class="profile-input" id="profile-input7" align="center">
<input type="text" name="course" class="inputmodify" placeholder="Course Studied" value="<?php if(!empty($prodata["course"])){echo htmlspecialchars($prodata["course"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>



<label class="pro-label items moreschool">
<?php if(empty($prodata["moreschool"])){echo '<b>Add More Schools</b> <i class="fa fa-plus" onclick="showInput16()"></i>';}else{echo '<b>More Institution</b> <i class="fa fa-trash"></i> <i class="fa fa-close" id="closeEdit8"></i> <i class="fa fa-edit" onclick="showInput16(); document.updateForm.moreschool.focus();" id="showEdit8"></i>';}?><br>
<span id="<?php if($profileid == $userid){echo "moreschoolLabel";}?>"><?php if($profileid==$userid && empty($prodata["moreschool"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["moreschool"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["moreschool"]);} ?></span></label>
<div class="profile-input" id="profile-input16" align="center">
<input type="text" name="moreschool" class="inputmodify" placeholder="Add Institution"
value="<?php if(!empty($prodata["moreschool"])){echo htmlspecialchars($prodata["moreschool"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

</div>
</section>
</div>




<div class="profile-con-1">
<section>
<div class="heading">Contact Info</div><br>
<div class="right-profile-item">

<br>
<label class="pro-label items country">
<b>Country</b> 
<i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit9"></i> 
<i class="fa fa-edit" onclick="showInput9(); document.updateForm.country.focus();" id="showEdit9"></i> <br>
<span class="<?php if($profileid == $userid){echo "countryLabel";}?>"><?php if($profileid==$userid && empty($prodata["country"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["country"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["country"]);} ?></span></label>
<div class="profile-input" id="profile-input9" align="center">
<input type="text" name="country" class="inputmodify" placeholder="Where are you from" value="<?php if(!empty($prodata["country"])){echo htmlspecialchars($prodata["country"]);} ?>">
<button style="width:100%; padding:6px;" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items location">
<b>State | Location</b> <i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit10"></i> 
<i class="fa fa-edit" onclick="showInput10(); document.updateForm.location.focus();" id="showEdit10"></i><br>
<span class="<?php if($profileid == $userid){echo "locationLabel";}?>"><?php if($profileid==$userid && empty($prodata["location"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["location"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["location"]);} ?></span></label>
<div class="profile-input" id="profile-input10" align="center">
<input type="text" name="location" class="inputmodify" placeholder="Enter your address" value="<?php if(!empty($prodata["location"])){echo htmlspecialchars($prodata["location"]);} ?>" >
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items">
<b>Phone</b> 
<i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit11"></i> 
<i class="fa fa-edit" onclick="showInput11(); document.updateForm.phone.focus();" id="showEdit11"></i> <br>
<span id="<?php if($profileid == $userid){echo "phoneLabel";}?>"><?php if($profileid==$userid && empty($prodata["phone"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["phone"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["phone"]);} ?></span></label>
<div class="profile-input" id="profile-input11" align="center">
<input type="text" name="phone" class="inputmodify" placeholder="Mobile number" value="<?php if(!empty($prodata["phone"])){echo htmlspecialchars($prodata["phone"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items">
<b>Email</b> 
<i class="fa fa-close" id="closeEdit12"></i> 
<i class="fa fa-edit" onclick="showInput12(); document.updateForm.email.focus();" id="showEdit12"></i> <br>
<span id="<?php if($profileid == $userid){echo "emailLabel";}?>"><?php echo htmlspecialchars($prodata["email"]);?></span>
</label><div class="profile-input" id="profile-input12" align="center">
<input type="text" name="email" class="inputmodify" placeholder="Enter email" 
value="<?php if(!empty($prodata["email"])){echo htmlspecialchars($prodata["email"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

</div>
</section>

<section>
<div class="heading">Work and Interests</div><br>
<div class="right-profile-item">
<br>
<label class="pro-label items">
<b>Work Experience</b> <i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit13"></i> 
<i class="fa fa-edit" onclick="showInput13(); document.updateForm.occupation.focus();" id="showEdit13"></i> <br>
<span id="<?php if($profileid == $userid){echo "occupationLabel";}?>"><?php if($profileid==$userid && empty($prodata["occupation"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["occupation"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["occupation"]);} ?></span></label>
<div class="profile-input" id="profile-input13" align="center">
<input type="text" name="occupation" class="inputmodify" placeholder="Work Experience" value="<?php if(!empty($prodata["occupation"])){echo htmlspecialchars($prodata["occupation"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items moreWorkExp"> 
<?php if(empty($prodata["moreWorkExp"])){echo '<b>Add More Experience</b> <i class="fa fa-plus" onclick="showInput14()"></i>';}else{echo '<b>More Experience</b> <i class="fa fa-trash"></i> <i class="fa fa-close" id="closeEdit14"></i> <i class="fa fa-edit" onclick="showInput14(); document.updateForm.moreWorkExp.focus();" id="showEdit14"></i>';}?>
<br>
<span id="<?php if($profileid == $userid){echo "moreWorkExpLabel";}?>"><?php if($profileid==$userid && empty($prodata["moreWorkExp"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["moreWorkExp"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["moreWorkExp"]);} ?></span></label>
<div class="profile-input" id="profile-input14" align="center">
<input type="text" name="moreWorkExp" class="inputmodify" placeholder="Add more experience" value="<?php if(!empty($prodata["moreWorkExp"])){echo htmlspecialchars($prodata["moreWorkExp"]);} ?>">
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

<label class="pro-label items">
<b>Interested In</b> <i class="fa fa-trash"></i><i class="fa fa-close" id="closeEdit15"></i> 
<i class="fa fa-edit" onclick="showInput15(); document.updateForm.interests.focus();" id="showEdit15"></i> <br>
<span id="<?php if($profileid == $userid){echo "interestsLabel";}?>"><?php if($profileid==$userid && empty($prodata["interests"])){echo "<font color='#bbb'>Update field</font>";}elseif(empty($prodata["interests"])){echo "<font color='#bbb'>Unavailable</font>";}else{echo htmlspecialchars($prodata["interests"]);} ?></span></label>
<div class="profile-input" id="profile-input15" align="center">
<select name="interests" class="select-css">
<option value="<?php if(!empty($prodata["interests"])){echo htmlspecialchars($prodata["interests"]);} ?>">Your Interest</option>
<option value="Web Developer">Web Development</option>
<option value="Men">Men</option>
<option value="Women">Women</option>
<option value="Men and Women">Men and Women</option>

<option value="Others">Others</option>
</select>
<button style="width:100%; padding:6px" class="btn btn-primary submit"><span class="updatetxt">Update</span><span class="fa fa-spinner fa-pulse pulse"></span></button>
</div>

</div>
</section>
</div>



</div>


 </form>

<div id="profile-content"></div>

<!--/FLEX-->
			   
</div>
 

		  
  

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



  
  
  
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkcard" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkcard" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkcard" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkcard" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkcard" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<script src="js/bootstrap.min.js"></script>

<!-- Slimscroll -->
<script src="theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="theme/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="theme/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
 














<script>

$(document).ready(function(){

		//hide spinner on btn update text
		$('.pulse').hide();
	$("button.submit").click(function(e){
		e.preventDefault();
		
		$.ajax({
			type:"POST",
			url:"update-profile.php",
			data: $('#updateForm').serialize(),
			beforeSend:function(){
			//hide "update" btn text and show spinner and disable btn
			$('.updatetxt').hide();
			$('.pulse').show();
			$("button.submit").prop("disabled",true);
			
			},
			success: function(data){
			//show "update" btn text and hide spinner and enable btn
			$('.updatetxt').show();
			$('.pulse').hide();
			$("button.submit").prop("disabled",false);
			
			//load response data from update-profile.php
			$('#profile-content').html(data);
				
				//load data from load-profile-data.php to replace user initial data
				$("#nameLabel").load("load-profile-data.php #name");
				$("#nickLabel").load("load-profile-data.php #nick");
				$("#emailLabel").load("load-profile-data.php #email");
				$("#genderLabel").load("load-profile-data.php #gender");				
				$("#institutionLabel").load("load-profile-data.php #institution");
				$("#courseLabel").load("load-profile-data.php #course");
				$("#moreschoolLabel").load("load-profile-data.php #moreschool");
				$(".countryLabel").load("load-profile-data.php #country");
				$(".locationLabel").load("load-profile-data.php #location");
				$("#phoneLabel").load("load-profile-data.php #phone");
				$("#occupationLabel").load("load-profile-data.php #occupation");
				$("#moreWorkExpLabel").load("load-profile-data.php #moreWorkExp");
				$("#interestsLabel").load("load-profile-data.php #interests");

				
				
			}
		});
});
});

</script>



<!-- TOOGLE DISPLAY PROFILE EDIT INPU SCRIPT-->
<script src="js/display-input.js" type="text/javascript"></script>


<!-- JQUERY ALERT card -->
<link rel="stylesheet" href="js/jqueryAlertBox/jquery-confirm.min.css">
<script src="js/jqueryAlertBox/jquery-confirm.min.js"></script>




<script>
	
	
//UPdate cover photo

$(document).ready(function(){
 load_image_data();

 function load_image_data(){
  $.ajax({
   url:"update-cover-photo.php",
   method:"POST",
  data: $('#getProfileId').serialize(),
   success:function(data)
   {
    $('div.updateSucessful').html(data);
   }
  });
 }
 



 $('#userCover').change(function(){

	 $(".hideCam").addClass("display-none");
	$("#drop-camera").css({"height":"0","opacity":"0"});
	$("#showCam").fadeIn("slow");
	 
  var form_data = new FormData();
  var files = $('#userCover')[0].files;
  
  
   for(var i=0; i<files.length; i++){
    var name = document.getElementById("userCover").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
	//jquery error alert	
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Encountered an error!',
    content: 'Invalid image format. Please select a valid image',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }
        },
    }
});
return false;
    }else{
	
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("userCover").files[i]);
    var f = document.getElementById("userCover").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 1024*3000)
    {
     	//jquery error alert	
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Encountered an error!',
    content: 'Image size is too large',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }
        },
    }
});
return false;
    }
    else
    {
     form_data.append("file[]", document.getElementById('userCover').files[i]);
    }
   }
  }

  
   $.ajax({
    url:"update-cover-photo.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#loader-wrapper2').removeClass("display-none");
    },   
    success:function(data){
	
	$('#getValue').html(data);
     
	 //hide loader
	 $('#loader-wrapper2').addClass("display-none")
     load_image_data();
	  
    }
   });

 });  
 
});


	</script>
















</body>
</html>
