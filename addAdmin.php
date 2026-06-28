<?php

include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
}else{
		header("location: register-login.php");
	}
	

		//get admin info
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = (!empty($row["profilepix"]) ? "../images/profilepix/".$row["profilepix"]: "../images/profilepix/no-img.png");

	
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Admin | FULAFIA</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ion Icons -->
  <link rel="stylesheet" href="../dist/css/ionicons.min.css">


</head>


<body class="hold-transition <!--dark-mode--> sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">


<!-- Loader -->
<!-- <div class='coversoverlay'>
<center><img src="../img/loader.svg"></center>
</div> -->



<div class="wrapper">
  
<!-- Navbar -->
  <?php include("header.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("sidebar.php");?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 my-4 mx-auto">
          <div class="col-sm-6 m-auto">
            <h1>Add Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">New Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
     

      <!-- /.card-header -->

      <div class="card card-warning card-outline mb-4 col-md-6 m-auto">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Add New Student</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form>
                    <div class="result"></div>
                    <?php 
                      if(isset($success)){
                      echo "<div class='alert success'><span class='closebtn'>&times;</span>  
                      <strong>" . $success . "</strong></div>";

                      echo "<center>
                      <h4 class='logs'>Preparing Your Account</h4>
                      </center> 
                      <div class='coversoverlay'></div>

                      <script>

                      //redirect after 4sec
                      setTimeout(function(){location.href='index.php'},4000);
                      </script>
                      ";
                      }
                      ?>
                      <!-- ERROR IF WRONG CREDENTIALS-->
                      <?php
                      if(isset($errorMsg)){
                      foreach($errorMsg as $error){

                      echo "<div class='error-alert errors'><span class='closebtn'>&times;</span>  
                      <strong>" . $error . "</strong></div>";
                      }
                      }
                      ?>
                        <div class="field-wrap">
                        <div id="errs"></div>
                    <!--begin::Body-->
                    <div class="card-body row-12">
                      
                      <div class="row mb-3">
                        <label for="name" class="ml-2">Username</label>
                        <div class="col-sm-11">
                          <input type="text" autofocus name="nick" id="nick" class="form-control" value="<?php if(isset($_POST["nick"])){echo $_POST["nick"];}?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="email" class="ml-2">Email</label>
                        <div class="col-sm-11">
                          <input type="email" name="email" id="email" class="form-control" value="<?php if(isset($_POST["name"])){echo $_POST["email"];}?>">
                        </div>
                      </div>
                      
                      
                      <div class="row mb-3">
                        <label for="password" class="ml-2">Password</label>
                        <div class="col-sm-11">
                          <input type="password" name="password" id="pass" class="form-control">
                        </div>
                      </div>
                      <div class="row mb-3">
                        </div>
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" id="addAdmin" class="btn btn-primary">
                        <span>Add</span>
                    </button>
                      <button type="submit" class="btn float-end">Cancel</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
      <!-- /.card-body -->
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  








  <?php include("footer.php");?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>



<script>
   
$(document).ready(function(){
	$('span#roll').hide();

 
  
    $("#addAdmin").click(function(e){
      e.preventDefault();

      	let name = $('input#nick').val();
      	let email = $('input#email').val();
        let password = $('input#pass').val();
        let type = "addAdmin";

    
      $.ajax({
        type: 'POST',
        url: 'function.php',
        data: {name:name, email:email, password:password, type:type},
        beforeSend: function(){
          $('.btn').html("Adding");
          $('.btn').css({"cursor":"progress"});
        }, 
        success: function(data){
          console.log(data);
          $(".result").html(data);

          $('.btn').html("Add");
          $('.btn').css({"cursor":"pointer"});
        
          // $('input#email').val("");
          // $('input#pass').val("");
          // $("#name").val("");
          // $("#ids").val("");
        
        }
	});
});

	});

 
</script>




</body>
</html>
