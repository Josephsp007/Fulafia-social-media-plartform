<?php

include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
}else{
		header("location: register-login.php");
	}
	

  // redirect to user page if userid not in $_GET
  if(!empty($_GET["user"])){
      $clientId = intval($_GET["user"]);
  }else{
    header("location: index.php");
  }




  //get user info
  $stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
  $stmt->bindParam(":userid", $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $row=$stmt->fetch();
  $userimage = (!empty($row["profilepix"]) ? "../images/profilepix/".$row["profilepix"]: "../images/profilepix/no-img.png");
  

  // Select Unique Id
  $stmt=$pdo->prepare("SELECT ids FROM sampleid WHERE userid = :userid");
  $stmt->bindParam("userid", $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $id=$stmt->fetch();

  //get user info for update
  $stmt=$pdo->prepare("SELECT * FROM userdata WHERE userid = :userid");
  $stmt->bindParam(":userid", $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $update=$stmt->fetch();

	?>











<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FULAFIA | <?php echo htmlspecialchars($row['name']);?> Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../dist/css/ionicons.min.css">
  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  
  <style>
    .tab-pane .ion{
font-size: 20px;
    }

input::-webkit-inner-spin-button,
input::-webkit-outer-spin-button{
-webkit-appearance: none;
}
input[type=number]{
-moz-appearance: textfield;
}
</style>
</head>




<body class="hold-transition sidebar-mini">

<!-- Loader -->
<div class='coversoverlay'>
<center><img src="../img/loader.svg"></center>
</div>



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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo htmlspecialchars($row['name']);?> Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center"  id="ProfilePixResult">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo $userimage;?>" alt="User profile picture">
                </div>




                <h3 class="profile-username text-center"><?php echo htmlspecialchars($row['name']);?></h3>

                <p class="text-muted text-center"><?php echo htmlspecialchars($row['status']);?> Profile 
                <i class="ion ion-checkmark-circled text-primary"></i>
                </p>

                <!-- <ul class="list-group list-group-unbordered mb-3">
                <a href="approvedLoan.php" class="list-group-item text-success">
                <b>Approved Profiles</b> <span class="float-right badge bg-success">2</span>
                </a>
                <a href="loanPayments.php" class="list-group-item text-danger">
                <b>Pending</b> <span class="float-right badge bg-danger">2</span>
                </a>
                </ul>  -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->






          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Timeline</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">


          

                <!-- USER PROFILE -->
                <div class="active tab-pane" id="settings">

                <div id="result"></div>
                <!-- Success Msg on update profile -->
                <section id="suc" class="display-none">
                <div class="alert bg-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="ion ion-android-checkbox-outline"></i> &nbsp; SUCCESS</h4>
                Profile Updated 
                </div>
                <div id="editAgain" style="color:#2e657e;font-size:16px; cursor:pointer; text-align:center;margin:20px;">
                <i class="fas fa-edit"></i> Click here to update again</div>
                </section>
                <!-- Success Msg on update profile -->
				
                  
                  <!-- form start -->
                  <form id="updateForm">
                  
                  <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ion ion-android-person"></i></span>
                    </div>
                    <input type="text" name="username" disabled class="form-control" id="username" value="<?php echo htmlspecialchars($row['name']);?>" placeholder="Enter Full Name">
                    </div> 
                    </div>
                  


                  <div class="col-md-6">
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ion ion-android-contact"></i></span>
                  </div>
                  <input type="text" disabled class="form-control" value="<?php echo htmlspecialchars($row['nick']);?>" placeholder="Enter Username">
                  </div> 
                  </div>
                  </div>




                    <div class="row">
                    <div class="col-md-6">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" required name="email" class="form-control" disabled id="email" 
                    value="<?php echo htmlspecialchars($row['email']);?>">
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ion ion-ipod"></i></span>
                    </div>
                    <input type="text" name="phone" disabled class="form-control" id="phone" 
                    value="<?php if(isset($id['ids'])){echo htmlspecialchars($id['ids']);}else{echo 'Enter Matric No';}?> ">  
                    </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ion ion-android-globe"></i></span>
                    </div>
                    <input type="text" name="country" disabled class="form-control" id="country" 
                    value="<?php if(!empty($update['country'])){ echo htmlspecialchars($update['country']) ;} ?>" placeholder="Enter country">
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ion ion-ios-location"></i></span>
                    </div>
                    <input type="text" name="course" disabled class="form-control" id="course" 
                    value="<?php if(!empty($update['course'])){ echo htmlspecialchars($update['course']) ;}?>" placeholder="Enter Course">
                    </div>
                    </div>
                    </div>
                    </form>
            
                  </div>

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  
  <?php include("footer.php");?>




<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->

<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>



<script>
 
 $(document).ready(function(){
	$('.coversoverlay').hide();

 });
</script>


</body>
</html>
