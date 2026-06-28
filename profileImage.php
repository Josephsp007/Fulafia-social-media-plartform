<?php

include('include/config.php');
session_start();

if(!isset($_SESSION['user_login'])){	
header('location:register-login.php');
}

			//get page name
			$page = pathinfo(__FILE__, PATHINFO_FILENAME);

		//DESTROY POSTING SESSION IF URL IS NOT COMMENT.PHP
		if(isset($_SESSION['postid']) && $page != "comment"){
		unset($_SESSION['postid']);
		}

		$userid = $_SESSION['user_login'];
		$sql = "SELECT * from users where userid = (:userid);";
		$query = $pdo -> prepare($sql);
		$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$query->execute();
		$row=$query->fetch();
		$userimage = (!empty($row["profilepix"]) ? "profilepix/".$row["profilepix"]: "images/user.png");
		
?>




<style>
/*
@media(max-width:991px){
.col-md-9{
 padding-right: 0px!important;
 padding-left: 0px!important;
}
}
*/

.bg-black{
    background-image: radial-gradient(ellipse closest-side, rgba(19, 19, 19, 0), #134753f0), url('images/<?php echo $userimage;?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
}

</style>



<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Profile Image</title>
	
<script src="js/jquery.min.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>


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
      <h1>
       Update Photo
      </h1>
<ol class="breadcrumb">
  <li><a href="profile.php?profileid=<?php echo intval($userid);?>">
  <i class="fa fa-user"></i> Profile</a></li>
  <li>&nbsp; | Update photo</li>
  
</ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
	
        <!-- MAIN BODY -->
		
        <div class="col-md-9" style="margin: auto;">
          <div class="card card-primary" style="min-height:500px;">
		<?php include("particles.php");?>
		  
		  
            <div class="card-header with-border">
              <h3 class="card-title">Update Photo</h3>
              <span id="image_table"></span>

            </div>
            <!-- /.card-header -->
            <div class="card-body no-padding">
              
			 
			  
			  <div class="card card-widget widget-user" style="max-width:700px; margin:20px auto 40px auto;">
            <!-- Add the bg color to the header using any of the bg-* classes -->
			
			<div class='alert success display-none' id="success" style='margin-bottom:6px'><span class='closebtn'>&times;</span>
			Photo Updated <i class='fa fa-check-circle'></i></div>
			
			<div id="error_profilepix"></div>
			
			<div id="loader-image"><div id="loader-wrapper"><div id="loader"></div></div></div>
			
            <div class="widget-user-header bg-black cover-bg" style="height: 300px!important;">
              <h3 class="widget-user-username" style="color:#fff!important;"><?php echo $row["name"]; ?></h3>
              <h5 class="widget-user-desc" id="desc">Update Photo</h5>
            </div>
            <div class="widget-user-image">
			<?php echo "<img src='" .$userimage."' alt='User Image' class='img-circle' style='width:140px; height:140px;' id='frame'>"; ?>
            </div>
			
		
<form>
<input type="file" name="profilepix" id="profilepix" style="display:none;" onchange="previewImg()">
<label for="profilepix" class="btn btn-primary btn-lg" style="text-align:center!important;color:#fff!important;border-radius:0px; padding:15px;border:none; width:100%">Select Image</label>

</form>
		
	</div>
	
	
			  
	  
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


<!-- JQUERY ALERT card -->
<link rel="stylesheet" href="js/jqueryAlertcard/jquery-confirm.min.css">
<script src="js/jqueryAlertcard/jquery-confirm.min.js"></script>


<!-- FastClick -->
<script src="theme/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="theme/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->










<script>
//IMGAE UPLOAD SCRIPT
	function previewImg(){
		
	var pixname = document.getElementById("profilepix").files[0].name;
    var ext = pixname.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
		return false;
    }else{
		frame.src=URL.createObjectURL(event.target.files[0]);
	}
	}
	
	
$(document).ready(function(){
	$("#loader-image").hide();

 $('#profilepix').change(function(){
  var error_images = '';
  
  var form_data = new FormData();
  var files = $('#profilepix')[0].files;
  
  if(files.length > 1)
  {
   error_images += 'You can not select more than 10 files';
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("profilepix").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
      error_images += '<div class="error-alert errors">Invalid Image <span class="closebtn">&times;</span></div>';
    }else{
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("profilepix").files[i]);
	
     form_data.append("file[]", document.getElementById('profilepix').files[i]);
    }
   }
  }
  if(error_images == '')
  {
	$("#loader-image").show();
	  
   $.ajax({
    url:"uploadProfileImage.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
      $('#loaderimg').html('');
    },   
    success:function(data)
    {
     $('#error_profilepix').html('');
	 
	 //show sucess msg
     $('#success').removeClass("display-none");
	 
	  // hide loader image
                $("#loader-image").hide();
				
				$('#error_profilepix').html(data);
				// $('#desc').html("<a href='profile.php?profileid=<?php // echo base64_encode($userid); ?>'><button class='btn btn-sm btn-success'>Got to Profile &nbsp;<span class='fa fa-chevron-circle-right'></span></button></a>");
				
				
				
    }
   });
  }
  else
  {
   $('#profilepix').val('');
   $('#error_profilepix').html(error_images).fadeIn("slow");
   return false;
  }
 });  
 
});
</script>






<script>
//close alert success or error
$('#error_profilepix').click(function(){
$('#error_profilepix').fadeOut("slow");
});

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








</body>
</html>
