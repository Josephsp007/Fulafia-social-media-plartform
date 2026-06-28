<?php
include("include/config.php");
session_start();
// if(isset($_SESSION["admin_login"])){
// 		header("location: index.php");
// 	}


// Select All users
$stmt = $pdo->prepare("SELECT * FROM users  WHERE status='staff' ");
$stmt->execute();
$showUsers = $stmt->fetchAll();

// Count Total number of users
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='staff' ");
$stmt->execute();
$staff = $stmt->fetch();


  // Select Unique Id
foreach($showUsers as $showUser){
$stmt=$pdo->prepare("SELECT ids FROM sampleid WHERE userid = :userid");
$stmt->bindParam("userid", $showUser["userid"], PDO::PARAM_STR);
$stmt->execute();
$id=$stmt->fetch();
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FULAFIA | ADMIN Dashboard</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <?php include 'include/header.php' ;?>
      <?php include 'include/sidebar.php' ;?>

      <main class="app-main">
        <div class="col-md-12">
                    <!-- USERS LIST -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">All Staffs</h3>
                        <div class="card-tools">
                          <span class="badge text-bg-danger"> <?= htmlspecialchars($staff["count"]);?> Staffs </span>
                          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                            <i class="bi bi-x-lg"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body p-0">
                      <div class="row text-center m-1">
                      <?php foreach($showUsers as $showUser){
                        $userImg = !empty($showUser["profilepix"]) ? "../images/profilepix/".$showUser["profilepix"] :"../images/profilepix/no-img.png";
                                    ?>
                          <div class="col-3 p-2">
                            <img class="img-fluid rounded-circle" src="<?= $userImg; ?>" alt="<?= htmlspecialchars($showUser["name"]);?> Image">
                            <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" >
                              <?= htmlspecialchars($showUser["name"]);?>
                            </a>
                            <div class="fs-8"><?= htmlspecialchars($showUser["status"]);?> - <?php echo htmlspecialchars($id["ids"]);?></div>
                              <td>
                                <a href="updateUsers.php?user=<?php echo intval($showUser['userid']);?>" class="btn btn-primary m-1 btn-sm">
                                <i class="ion ion-android-person"></i> Profile</a>

                                <button class="btn btn-danger m-1 btn-sm" data-toggle="modal" data-target="#delModal<?php echo $showUser['userid'];?>">
                                <i class="ion ion-android-delete"></i> Delete</button>
                              </td>
                          </div>
                          <?php }; ?>
                        </div>
                      </div>
                      
                      <!-- Delete Modal -->
                      <?php foreach($showUsers as $showUser){?>
                      <div class="modal fade" id="delModal<?php echo $showUser['userid'];?>">
                      <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title">Delete User</h4>
                      <button type="button" class="close" id="close<?php echo $showUser['userid'];?>" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                      </button>
                      </div>
                      <div class="modal-body">
                      <p>Are you sure you want to permanently delete <b><?php echo htmlspecialchars($showUser['name']);?> ? </b></p>
                      </div>
                      <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger delete" id="del_<?php echo $showUser['userid'];?>">
                      Delete User <span class="spinner-border spinner-border-sm ml-3 display-none" id="load<?php echo $showUser['userid'];?>"></span>
                      </button>
                      </div>
                      </div>
                      <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                      </div>
                      <?php }; ?>
                                  
                    </div>
                  </div>
      </main>

      <?php include 'include/footer.php'; ?>

    </div>

    <?php include 'include/script.php'; ?>
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


 // DELETE USER
    $(".delete").click(function(){

      let ID = this.id;
      let userid = ID.split("_");
      let delid = userid[1];


      $.ajax({
        type: 'POST',
        url: 'function.php',
        data: {delid:delid},
        beforeSend: function(){$("#load"+delid).removeClass("display-none"); $("#del_"+delid).prop('disabled', true)},
        success: function(data){
          
          $("#load"+delid).addClass("display-none"); 
          $("#del_"+delid).prop('disabled', false);
          $("#close"+delid).trigger('click');

          // FadeOut Row
          if(data == 1){
          $("#userRow_"+delid).fadeOut(function(){
            $("#userRow_"+delid).remove();
          });
          }

        }
      });

    })
    });
  </script>
  </body>