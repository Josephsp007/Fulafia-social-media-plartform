<?php
include("include/config.php");
session_start();
// if(isset($_SESSION["admin_login"])){
// 		header("location: index.php");
// 	}	


// Count All users
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users");
$stmt->execute();
$allUsers = $stmt->fetch();

// Select All users
$stmt = $pdo->prepare("SELECT * FROM users LIMIT 8");
$stmt->execute();
$showUsers = $stmt->fetchAll();

//Count Total number of Admins
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='admin' ");
$stmt->execute();
$admin = $stmt->fetch();


// Count Total number of Staffs
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='staff' ");
$stmt->execute();
$staff = $stmt->fetch();

// Count Total number of users
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE status='user' ");
$stmt->execute();
$user = $stmt->fetch();

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
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      
      <?php include 'include/header.php' ;?>

      <?php include 'include/sidebar.php' ;?>

      <main class="app-main">

      <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3><?= htmlspecialchars($admin["count"]);?></h3>
                    <p>Admins</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                  </svg>
                  <a  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"><i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3><?= htmlspecialchars($staff["count"]);?></h3>
                    <p>Staffs</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                  </svg>
                  <a href="staffs.php" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3><?= htmlspecialchars($user["count"]);?></h3>
                    <p>Users</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
                  </svg>
                  <a href="users.php" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
              </div>
            </div>


        <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Latest Users</h3>
                        <div class="card-tools">
                          <span class="badge text-bg-danger"> <?= htmlspecialchars($allUsers["count"]);?> Users </span>
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
                            <div class="fs-8"><?= htmlspecialchars($showUser["status"]);?></div>
                          </div>
                          <?php }; ?>
                        </div>
                      </div>

                      <div class="card-footer text-center">
                        <a href="users.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View All Users</a>
                      </div>
                    </div>
                  </div>



                  <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Actions</h3>
                    <div class="card-tools">
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
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>IDS</th>
                            <th>Users</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach($showUsers as $showUser){?>
                          <tr>
                            <td>
                              <a href="pages/examples/invoice.html" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR9842</a>
                            </td>
                            <td><?= htmlspecialchars($showUser["name"]);?></td>
                            <td><span class="
                                        <?php if(htmlspecialchars($showUser['status']) == 'admin')
                                            { echo 'badge text-bg-success'; } 
                                            elseif (htmlspecialchars($showUser['status'])== 'staff')
                                            {echo 'badge text-bg-warning';} 
                                            else {echo 'badge text-bg-danger'; };?> "> 
                                <?= htmlspecialchars($showUser["status"]);?> 
                                </span>
                            </td>
                            <td><a href="actionForm.php" class="btn btn-sm btn-primary float-start"> Place New Actions</a></div></td>
                            <td><div id="table-sparkline-1"></div></td>
                          </tr>
                          <?php }; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="card-footer clearfix"> 
                  </div>
                </div>
      </main>

      <?php include 'include/footer.php'; ?>
      
    </div>
    
    <?php include 'include/script.php'; ?>
    

  </body>
</html>




