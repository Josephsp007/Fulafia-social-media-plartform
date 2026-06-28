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
  <title>Students | FULAFIA</title>


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
            <h1>Regitered Students</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Students</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <?php      
      // Ftech all users
      $stmt=$pdo->prepare("SELECT * FROM sampleid WHERE userid IS NULL");
      $stmt->execute();
      $count = 1;
      $allstudents=$stmt->fetchAll();
      ?>

      <div class="card">
      <div class="card-header">
      <h3 class="card-title text-gray text-sm text-uppercase">Students</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <table id="userTable" class="table table-bordered table-striped">
      <thead>
      <tr>
      <th>S/N</th>
      <th>Unique ID</th>
      <th>Action</th>

      </tr>
      </thead>
      <tbody>
      <?php foreach($allstudents as $allstudent){?>

      <tr id="userRow_<?php echo $allstudent['id'];?>">
      <td><?php echo $count++;?></td>
      <td><?php echo htmlspecialchars($allstudent["ids"]);?></td>
      <!-- /Hidden -->
      <td>

        <button class="btn btn-danger m-1 btn-sm" data-toggle="modal" data-target="#delModal<?php echo $allstudent['id'];?>">
        <i class="ion ion-android-delete"></i> Delete</button>
      </td>
      </tr>
      <?php }; ?>


        <!-- Delete Modal -->
         <?php foreach($allstudents as $allstudent){?>
        <div class="modal fade" id="delModal<?php echo $allstudent['id'];?>">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Delete User</h4>
        <button type="button" class="close" id="close<?php echo $allstudent['id'];?>" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <p>Are you sure you want to permanently delete Matric Number: <b><?php echo htmlspecialchars($allstudent['ids']);?> ? </b></p>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger delete" id="del_<?php echo $allstudent['id'];?>">
        Delete ID <span class="spinner-border spinner-border-sm ml-3 display-none" id="load<?php echo $allstudent['id'];?>"></span>
        </button>
        </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <?php }; ?>
     
      </tbody>

      
      </table>
      </div>
      <!-- /.card-body -->
      </div>
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
  $(function () {
  $('.coversoverlay').hide();

  
    $("#userTable").DataTable({
      // dom: 'Bfrtip',
      responsive: true, 
      lengthChange: false, 
      autoWidth: false,

      // Columns to hide
      columnDefs: [{
        //targets:[7,8,9,10,12,13,14,15,16,17],
        visible:false,
        searchable: false,
      }],

      // ["copy", "csv", "excel", "pdf", "print", "colvis"],
      buttons: [
        
        {
          extend:'copy',
          className: 'btn btn-info',
          exportOptions:{
            columns: [0,1,2,3,4]
          }
        },
          
        {
          extend:'excel',
          className: 'btn btn-info',
          exportOptions:{
            columns: [0,1,2,3,4]
          }
        },
          
        {
          extend:'pdf',
          className: 'btn btn-info',
          orientation:'landscape',
          exportOptions:{
            columns: [0,1,2,3,4,]
          }
        },
          
        {
          extend:'csv',
          className: 'btn btn-info',
          exportOptions:{
            columns: [0,1,2,3,4]
          }
        },
          
        {
          extend:'print',
          className: 'btn btn-info',
          orientation:'landscape',
          exportOptions:{
            columns: [0,1,2,3,4]
          }
        },
          
        {
          extend:'colvis',
          className: 'btn btn-dark',
          exportOptions:{
            columns: [0,1,2,3,4]
          }
        },
          
          

        ]
      
    }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
   
 









    // DELETE USER
    $(".delete").click(function(){

      let ID = this.id;
      let getId = ID.split("_");
      let delIds = getId[1];


      $.ajax({
        type: 'POST',
        url: 'function.php',
        data: {delIds:delIds},
        beforeSend: function(){$("#load"+delIds).removeClass("display-none"); $("#del_"+delIds).prop('disabled', true)},
        success: function(data){
          
          $("#load"+delIds).addClass("display-none"); 
          $("#del_"+delIds).prop('disabled', false);
          $("#close"+delIds).trigger('click');

          // FadeOut Row
          console.log(data);
          if(data.trim() == 1){
          $("#userRow_"+delIds).fadeOut();
          }

        }
      });

    });



 
 });
</script>




</body>
</html>
