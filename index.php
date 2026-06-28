<?php
include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
	$userid = $_SESSION["user_login"];
}else{
		header("location: register-login.php");
	}
	
		//get All users info
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();
		$userimage = (!empty($row["profilepix"]) ? "../images/profilepix/".$row["profilepix"]: "../images/profilepix/no-img.png");
		
		
		//get Admin info
		$stmt=$pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE userid != :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$countUsers=$stmt->fetch();


    
    
    
    // Count Total number of Staffs
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='staff' ");
    $stmt->execute();
    $staff = $stmt->fetch();

    // Count Total number of users
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='student' ");
    $stmt->execute();
    $student = $stmt->fetch();

	?>


 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard | FULAFIA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ion Icons -->
  <link rel="stylesheet" href="../dist/css/ionicons.min.css">
  
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">



  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include("header.php");?>
  <!-- /.navbar -->



  <!-- Main Sidebar Container -->
 <?php include("sidebar.php");?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href='index.php'>Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
     



      <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">


          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo intval($countUsers['count']);?></h3>
                <p style="font-size:17px">Registered Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="users.php" class="small-box-footer">Show all users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- <span class="spinner-border spinner-border-sm" style="display: block;"></span> -->

          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= htmlspecialchars($staff["count"]); ?></h3>
                <p style="font-size:17px">Registered Staffs</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-time"></i>
              </div>
              <a href="staffs.php" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          
          
          <?php
          // Count Total number of Staffs
    $stmtCnt = $pdo->prepare("SELECT COUNT(userid) FROM users WHERE status='admin' ");
    $stmtCnt->execute();
    $admin = $stmtCnt->fetchColumn();
          ?>
          <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $admin; ?></h3>
                <p style="font-size:17px">Active Admin &nbsp;<i class="fas fa-arrow-circle-up"></i></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="users.php" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          



        </div>
        <!-- /.row -->
        <!-- Main row -->
        

      </div><!-- /.container-fluid -->
    </section>


        









              <!-- LATEST USERS -->
              <div class="row">

              <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="card">
              <div class="card-header">
              <h3 class="card-title text-dark"><i class="fas fa-users"></i> &nbsp;Latest Members</h3>

              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
              </button> -->
              </div>
              </div>
              <!-- /.card-header -->

              <div class="card-body p-0">
              <ul class="users-list clearfix">

              <?php
              //get 8 recent users
              $stmt=$pdo->prepare("SELECT * FROM users WHERE userid != :userid ORDER BY userid DESC LIMIT 8");
              $stmt->bindParam("userid", $userid, PDO::PARAM_STR);
              $stmt->execute();
              $getUsers=$stmt->fetchAll();

              if($stmt->rowCount() < 1){
                echo "<li class='text-lg text-gray'>No Registered User </li>";
              }else{

                foreach($getUsers as $getUser){
                $Rimage = (!empty($getUser["profilepix"]) ? "../images/profilepix/".$getUser["profilepix"]: "../images/profilepix/no-img.png");
              ?>

              <li>
              <img src="<?php echo $Rimage;?>" alt="User Image" style="width:75px; height:75px" class="profile-user-img img-fluid img-circle">
              <a href="updateUsers.php?user=<?php echo intval($getUser["userid"]);?>" class="users-list-name">
              <?php echo htmlspecialchars($getUser["name"]);?></a>
              <span class="users-list-date"><?php echo date("jS F, Y", strtotime($getUser['regdate']));?></span>
              </li>

              <?php } }?>

              </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
              <a href="users.php" class="link-dark">View All Users &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.card-footer -->
              </div>
              <!--/.card -->









             
              
          </div>
              <!-- /LATEST USERS -->











    
























      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->



  <!-- Main Footer -->
<?php include("footer.php");?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- <script src="../dist/js/demo.js"></script> -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>




</body>
</html>
