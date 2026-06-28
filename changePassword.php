<?php

include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
}else{
		header("location: register-login.php");
	}
	

		//get user info
		
		$stmt="SELECT * FROM users WHERE userid = :userid";
		$stmt=$pdo->prepare($stmt);
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = (!empty($row["profilepix"]) ? "images/site/profilepix/".$row["profilepix"]: "images/site/user.png");
		
	
  
	
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-sacle=1.0, user-scalable=no">
  <title>All Groups</title>

	<script src="js/jquery.min.js"></script>
	
	<!-- JQUERY ALERT BOX -->
	<link rel="stylesheet" href="js/jqueryAlertBox/jquery-confirm.min.css">
	<script src="js/jqueryAlertBox/jquery-confirm.min.js"></script>

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="theme/plugins/toastr/toastr.min.css">
  

	<!-- Loader CSS -->
	<link rel="stylesheet" href="css/loader-style.css">
	<link rel="stylesheet" href="css/styles.css">
	
	<!--Form Select-->
	<link rel="stylesheet" href="theme/plugins/select2/css/select2.min.css">
	
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
	
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <link rel="stylesheet" href="theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  
	
	</head>







		<body class="hold-transition dar-mode sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
		<div class="wrapper">




<!-- Navbar -->
 <?php include("include/header.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("include/sidebar.php");?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">



          <div class="col-md-6 m-auto">
          <div class="card card-dark mt-5">
          <div class="card-header">
          <h3 class="card-title" id="wlcm">Change Password</h3>
          </div>
          <!-- /.card-header -->
          
          
          <!-- form start -->
          <form>
          <div class="card-body">


          <!-- Success Msg -->
          <section id="suc" class="display-none">
          <div class="alert bg-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="ion ion-android-checkbox-outline"></i> &nbsp; SUCCESS</h4>
          Password Changed
          </div>
          <div id="editAgain" style="color:#2e657e;font-size:16px; cursor:pointer; text-align:center;margin:20px;">
          <i class="fas fa-edit"></i> Click here to update again</div>
          </section>
          <!-- Success Msg -->

          <div class="alert alert-danger alert-default-danger display-none" id="result"></div>

          <section id="passwordForm">
          <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text"><i class="ion ion-locked text-lg"></i></span>
          </div>
          <input type="text" name="oldPassword" class="form-control p-4" id="oldPassword"  placeholder="Your Current Password">
          </div>


          <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text"><i class="ion ion-key text-lg"></i></span>
          </div>
          <input type="password" name="password" class="form-control p-4" id="password"  placeholder="Enter New Password">
          </div>


          <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text"><i class="ion ion-android-checkmark-circle text-lg"></i></span>
          </div>
          <input type="password" name="ConfirmPassword" class="form-control p-4" id="ConfirmPassword"  placeholder="Confirm password">
          </div>
          
          <div class="card-footer">
          <button type="submit" id="updatePass" class="btn btn-dark">Change Password
					<span class="spinner-border spinner-border-sm ml-3 display-none" id="load"></span>
          </button>
          </div>

          </section>

          

          </form>
          </div>
          </div>
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  

 <?php //include("include/footer.php");?>
  

</div>
<!-- ./wrapper -->

















<!-- Bootstrap -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.js"></script>

<!-- PAGE theme/plugins -->
<!-- jQuery Mapael -->
<script src="theme/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="theme/plugins/raphael/raphael.min.js"></script>
<!-- overlayScrollbars -->
<script src="theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Select2 -->
<script src="theme/plugins/select2/js/select2.full.min.js"></script>
<script src="theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="theme/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- SweetAlert2 -->
<script src="theme/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toaster -->
<script src="theme/plugins/toastr/toastr.min.js"></script>

<!-- InputMask -->
<script src="theme/plugins/moment/moment.min.js"></script>
<script src="theme/plugins/inputmask/jquery.inputmask.min.js"></script>
















   
   
   
<script>
   
   $(document).ready(function(){
	
 //send message
 
 $("#updatePass").click(function(e){
	 e.preventDefault();
	 
		let updatePass = "updatePass";
			
		let oldPassword = $("#oldPassword").val();
		let password = $("#password").val();
		let ConfirmPassword = $("#ConfirmPassword").val();
		

		$.ajax({
			url:'update-password-script.php',
			method:'POST',
			data:{updatePass:updatePass, password:password, ConfirmPassword:ConfirmPassword, oldPassword:oldPassword},
			beforeSend: function(){
        $("#load").removeClass("display-none"); 
        $("#updatePass").attr('disabled', true)
      },
			success:function(data){
				$("#result").html(data);

			$("#load").addClass("display-none"); 
      $("#updatePass").attr('disabled', false);
				
			}
		});
		
		});
	
 
 
 


    //Edit password Again
  $("#editAgain").click(function(){
		
    $("#passwordForm").slideDown(function(){
      $("#suc").addClass("display-none");

      // Empty inputs
      $("#oldPassword").val("");
      $("#password").val("");
      $("#ConfirmPassword").val("");

			$("#wlcm").html("Re-Update");	
      
    });	
  
  });
	 



   });
   
   
   
   
   </script>






</body>
</html>
