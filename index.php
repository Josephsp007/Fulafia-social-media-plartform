<?php

include('include/config.php');
session_start();

if(!isset($_SESSION['user_login']))
	{	
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
		$userimage = (!empty($row["profilepix"]) ? "images/profilepix/".$row["profilepix"]: "images/site/user.png");
		
		
		//Controls Options
		$box = "GroupSearch";
		$sql = $pdo->prepare("SELECT * from controls where userid = :userid AND conName=:box");
		$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$sql-> bindParam(':box', $box, PDO::PARAM_STR);
		$sql->execute();
		$controls = $sql->fetch();
?>




<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Fulafia Connect | Home</title>
	
<script src="js/jquery.min.js"></script>


<!-- JQUERY ALERT BOX -->
<link rel="stylesheet" href="js/jqueryAlertBox/jquery-confirm.min.css">
<script src="js/jqueryAlertBox/jquery-confirm.min.js"></script>


<!--modal slider and GRID ARRANGE POST IMAGES -->
<link rel="stylesheet" href="css/images-grid.css">


	<!-- Loader CSS -->
	<link rel="stylesheet" href="css/loader-style.css">
	
	
	
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="theme/plugins/toastr/toastr.min.css">
  
	
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/welcome-style.css">
	
	<!--Form Select-->
	<link rel="stylesheet" href="theme/plugins/select2/css/select2.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
	
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

</head>


<style>
@media(min-width:767px){
	.top-slide{
		border-top:1px solid #1f2932;
	}
}

@media(max-width:767px){
.group-sidbar{
	display:none;
	}
}
</style>




	<body class="hold-transition dar-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
	<div class="wrapper">

	
	<!-- Preloader 
	<div class="preloader flex-column justify-content-center align-items-center" style="background:#28333c;">
    <img class="" src="images/site/blazeDark.png" alt="eBlaze Logo" height="100" width="100" 
	style="border:2px solid rgb(78 83 98); border-radius: 50%;margin-top:-200px;">
	</div>
	-->
 
 
	<!--/LOADER IMAGE-->
	<div id='loader-image'>
	<div id="loader-wrapper">
	<div id="loader"></div>
	</div>
	</div>
		
		
		
  
   <!-- include header -->
<?php include('include/header.php');?>
  
 <!-- include sidebar -->
<?php include('include/sidebar.php');?>
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

			<!--SLIDER-->
           <div id="carouselExampleIndicators" class="carousel slide top-slide" data-ride="carousel">
			<div class="carousel-inner">
				  
			<?php
			
			$stmt = $pdo->prepare(
			"SELECT g.*, c.category_name FROM groups g
            JOIN group_categories c ON g.category_id = c.category_id");
			$categories = $stmt->fetchAll();

			//assign an active class to the first carousel
			$gactive = 0;
			foreach($categories as $category){
			$gactive++;
			?>	
				
			<style>	
			.cat_<?= $category["category_id"];?>{
			background-image: radial-gradient(ellipse closest-side, rgb(36 37 56 / 75%),#28333c), 
			url(groups/images/categories/<?php echo $category["image"];?>);
				}
			</style>	
                  
			<!--Item-->
         <div class="carousel-item <?php if($gactive ==1){echo "active";}?>"> 
         <div class="skillSlick cat_<?php echo htmlspecialchars($category["category_id"]);?>" style="height:300px;">
		
		<center>
		<span style="color:#ffa354;font-weight:700"> 
		<?php echo htmlspecialchars($category["category_name"]);?> </span><p>
		<div style="max-width:300px;font-size:18px!important;font-weight:400;color:#d6e8ed;white-space:normal;">
		<?php echo $category["description"];?>
		<p>
		</div>
		
		<a href="skills/categories.php?course_id=<?php echo htmlspecialchars($category["category_id"]); ?>">
		<div class="btn btn-learn ">Start Today</div>
		</a></center>
		
		</div>
        </div>
		<!--/Item-->
		
		<?php }?> 
				  
				  
				  
				  
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
          
				</div>
                </div>
              
		<!-- / slider -->
	
	

		<!-- Main content -->
		<section class="content">
	
		<div class="row" style="max-width:1300px;margin:auto;">
        <div class="col-md-4" id="ads-con" style="padding:4px; max-width:600px; margin:0px auto">
       
	   
			  <div class="card" id="adsBoard">
		  
			  <div class="card-header with-border">
              <h3 class="card-title">Sponsored Adverts
			  <div style="margin-top:6px;" class="cloudblue">
			  <i style="color:#6792bd" class="material-icons">important_devices</i>&nbsp; Post Premium Adverts &nbsp;</div>
			  </h3>
			  <br><p><br><br>
			  <div style="color:#7e7e7e" class="spn">Your Adverts will be displayed in all our top pages. Sponsored in our Media Accounts.<br>
			  Start by Creating an <span style=""><a href="advert-manager/profile.php">Advert Account</a></span></div>
			  </div>
			  
				<center>
				<div class="position-relatie">
				<video style="width:100%; border-bottom:1px solid #ebeaea;" muted autoplay loop class="vidad">
				<div style=""></div>
				<source src="images/site/hero.mp4" type="video/mp4" class="vidad">
				</video>
                
				<div class="ribbon-wrapper ribbon-lg">
                <div class="ribbon bg-secondary text-lg">
                 Ads <i class="fas fa-shopping-cart" style="font-size: 14px;"></i>
                 </div>
                 </div>
                 </div>
				 
				 
				 
				<!--Free Ads Carousel-->
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-right:10px;">
                <div class="carousel-inner">
				
				<?php
				$sql = $pdo->prepare(
					"SELECT 
					ads_listing.*, 
					advert_manager.adspix, 
					advert_manager.phone, 
					advert_manager.email 
					FROM ads_listing, advert_manager
					WHERE ads_listing.managerId = advert_manager.managerId
					AND
					ads_listing.visibility != 'invisible'
					");
				$sql->execute();
				$adverts = $sql->fetchAll();
				$num = 1;

				foreach($adverts as $advert){
				$adspix = (!empty($advert["adspix"]) ? "advert-manager/images/Adsprofile/".$advert["adspix"]: "images/site/no-img.png");
				$rand = rand();
				?>
				
				
		<!--item-->
		<div class="carousel-item <?php if($num == 1){echo 'active';}?>">
		
		<div class="hero-article-ad" style="margin-top:20px!important; margin-bottom:20px;">
		<div class="single-ad ad-5">
		<div class="module">
		<div class="slider">

		<input type="radio" name="sel<?php echo $advert["id"];?>" id="id<?php echo $advert["id"];?>" class="img-thumbs" checked="checked">
		<label for="id<?php echo $advert["id"];?>" style="z-index:1!important;">
		<img src="advert-manager/images/ads/<?php echo $advert["img1"];?>">
		</label>
		<img src="advert-manager/images/ads/<?php echo $advert["img1"];?>" class="modes">


		<!-- check if img2 is uploaded -->
		<?php if(!empty($advert["img2"])){?>
		<input type="radio" name="sel<?php echo $advert["id"];?>"  class="img-thumbs" id="id<?php echo $rand . $num+1;?>">
		<label for="id<?php echo $rand . $num+1;?>" style="z-index:1!important;">
		<img src="advert-manager/images/ads/<?php echo $advert["img2"];?>">
		</label>
		<img src="advert-manager/images/ads/<?php echo $advert["img2"];?>" class="modes">
		<?php }?>


		<!-- check if img3 is uploaded -->
		<?php if(!empty($advert["img3"])){?>
		<input type="radio" name="sel<?php echo $advert["id"];?>"  class="img-thumbs" id="id<?php echo $rand . $num+2;?>">
		<label for="id<?php echo $rand . $num+2;?>" style="z-index:1!important;">
		<img src="advert-manager/images/ads/<?php echo $advert["img3"];?>">
		</label>
		<img src="advert-manager/images/ads/<?php echo $advert["img3"];?>" class="modes">
		<?php }?>


		<!-- check if img4 is uploaded -->
		<?php if(!empty($advert["img4"])){?>
		<input type="radio" name="sel<?php echo $advert["id"];?>"  class="img-thumbs" id="id<?php echo $rand . $num+3;?>">
		<label for="id<?php echo $rand . $num+3;?>" style="z-index:1!important; margin-right:8px; ">
		<img src="advert-manager/images/ads/<?php echo $advert["img4"];?>">
		</label>	
		<img src="advert-manager/images/ads/<?php echo $advert["img4"];?>" class="modes">	
		<?php }?>


		<!-- check if img5 is uploaded -->
		<?php if(!empty($advert["img5"])){?>
		<input type="radio" name="sel<?php echo $advert["id"];?>"  class="img-thumbs" id="id<?php echo $rand . $num+4;?>">
		<label for="id<?php echo $rand . $num+4;?>" style="z-index:1!important; margin-right:8px; ">
		<img src="advert-manager/images/ads/<?php echo $advert["img5"];?>">
		</label>	
		<img src="advert-manager/images/ads/<?php echo $advert["img5"];?>" class="modes">	
		<?php }?>


		<!-- check if img6 is uploaded -->
		<?php if(!empty($advert["img6"])){?>
		<input type="radio" name="sel<?php echo $advert["id"];?>"  class="img-thumbs" id="id<?php echo $rand . $num+5;?>">
		<label for="id<?php echo $rand . $num+5;?>" style="z-index:1!important; margin-right:8px; ">
		<img src="advert-manager/images/ads/<?php echo $advert["img6"];?>">
		</label>	
		<img src="advert-manager/images/ads/<?php echo $advert["img6"];?>" class="modes">	
		<?php }?>

		</div>	 
		</div><!--/module-->
		
		<div class="interlude">
		<img src="<?php echo $adspix;?>" class="avatar" alt="Company Logo" width="90" height="20">
		<h5><?php echo htmlspecialchars($advert["title"])?></h5>
		<h6><?php echo "N" . htmlspecialchars($advert["price"])?></h6>
		<div><?php echo htmlspecialchars($advert["description"])?></div>
		
		
		<div class="d-flex justify-content-around mt-3">				
		<a href="tel:<?php echo $advert["phone"];?>" class="btn btn-primary w-50">
		<div>
		<i class="fa fa-phone"></i>
		</div>
		</a>
		&nbsp; 
		<a class="btn btn-dark w-50" href="mailto:<?php echo $advert["email"];?>">
		<div>
		<i class="far fa-envelope"></i>
		</div>
		</a>
		</div>


		</div>
		</div>
		</div>
		
		</div>
		<!--/item-->



		<?php $num++; }?>
				
				
				
				</div><!--/Inner Carousel-->
                </div> <!--/Free Ads Carousel-->



				
				<div style="color:#7e7e7e;margin-top:-7px;margin-bottom:5px;font-size:15px">Create & Manage your adverts in one place</div>
				<a href="advert-manager/profile.php"><div class="btn btn-learn" style="width:95%;"> Create free Ads Account &nbsp; 
				<i class="fas fa-arrow-right"></i></div></a>
			  

				</center><p>
				</div> <!-- /.card --> 


<!-- 
		
			<div class="card pst-card">
		  
            <div class="card-header with-border">
            <h3 class="card-title">
			<div style="margin-top:6px;" class="cloudblue">
			<i style="color:#6792bd" class="material-icons">business</i>&nbsp; Connect your Business for free &nbsp;</div>
			</h3>
            </div>
			<p>
			<center><img src="images/site/mrBlaze.jpg" style="border-radius:5px;width:94%;" align="center"></center>
			
			<div class="post-text" style="margin:10px;color:#666;font-size:15.5px;line-height:25px">
			Project your work, platform, business to the world for free in few simple steps. People are interested in what you do.<br> Start by creating a page and setting up your <b>Business or Tutorial Platform</b> - with high customisable User Interface. Share your links on medias, business cards and invite friends to learn about you, what you do and offer. Access our unrestricted Learning Platforms. <p>
				
			<div class="btn btn-learn" style="width:100%;"> Start Now &nbsp; <i class="fas fa-arrow-right"></i></div>
			 </div>
		 	<br>
			</div> 
			
			/.card -->
		 
		 
		 <div class="card collapsed-card sticky-top" style="margin:auto; max-width:600px">
		 <div class="card-header" style="border-bottom:1px solid rgba(0,0,0,.125);">
         <h3 class="card-title">
		 <div style="margin-top:6px;" class="cloudblue">
		 <i style="color:#6792bd" class="material-icons">school</i>&nbsp; Join your Department Group &nbsp; </div>
		 </h3>
		 
		  <div class="card-tools">
          <a href="#" style="color:#6792bd" class="material-icons pull-right" data-card-widget="collapse">
          settings
          </a>
          </div><br>
		 
		 <!--SearchBox-->
			 <div class="groupSearch <?php if($controls["conditions"]=="hide"){echo "display-none";} ?>">
			   <div class="input-group input-group-sm" style="width:100%;margin-top:40px;">
                <input type="search" name="g-search" class="g-search form-control" placeholder="Search Course">
                 <div class="input-group-append">
                    <div class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </div>
                  </div></div>
				<div class="s-results"></div>
				</div>
				<!--/SearchBox-->
		  </div>
			
			
         <div class="card-body p-0" style="display: none;">
              <ul class="nav nav-pills flex-column">
				
		<!-- Switch -->	
				
		<div class="switch round blue-white-switch mt-2" style="text-align:center;">
		<label style="font-weight:500!important;color:#404040;">
		<span id="gtext">
	<?php if(empty($controls["conditions"]) OR $controls["conditions"]=="show"){echo "Turn <font color='#dc3545'>OFF</font> Search Box Visibility";}
				else{echo "Turn <font color='green'>ON</font> Search Box Visibility";} ?>
		</span>
        <input type="checkbox" name="checker" id="hideSearch"
		<?php if(empty($controls["conditions"]) OR $controls["conditions"]=="show"){echo 'checked="checked"';} ?> />
        
		<span class="lever" id="Slever"></span>
		</label>
		</div>
		<div class="dropdown-divider"></div>
				
<!-- 				
			   <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                    Important
                  </a>
                </li> -->
				
              </ul>
          </div><!-- /.card-body -->
			
		
		  <ul class="nav nav-pills flex-column">
			<?php
			
			$stmt = $pdo->prepare("SELECT * FROM groups ORDER BY RAND() LIMIT 5");
			$stmt->execute();
			$gnames = $stmt->fetchAll();
			foreach($gnames as $gname){
			?>
        
        <li class="nav-item">
        <a class="nav-link" href="groupchat/?groupid=<?php echo intval($gname["group_id"]);?>">
			 <?php echo htmlspecialchars($gname["group_name"]);?>
			 </a>
			 <div style="color:#869099;margin:-8px 15px 8px;font-size:14px;white-space:normal"> Public · 
			 <i class="glyphicon glyphicon-globe"></i> Group</div>
			 
			 </li>
			<?php } ?>
          
		  </ul>
        
            <!-- /.card-body -->
          </div>
		  
		</div><!-- /.col -->
	
		
		
        <div class="col-md-5 ttop" id="create-con" style="padding:4px">
          <div class="card optionCon" style="margin:0px auto 0px auto!important; max-width:600px;">
            <div class="card-header with-border">
          
		  
			<div class="author-avatar" style="display:flex;">
			<div>
			<img alt="<?php echo $row['name'];?>" src="<?php echo $userimage;?>" class="avatar" width="80" height="100" style="border:none;">
			<svg class="half-circle" width="80px" height="80px">
			<use xlink:href="#half-circle"></use>
			</svg>
			</div>
			<div style="background:#f0f2f5;color:#424242; font-size:17px; padding:15px; cursor:pointer; border-radius:40px;width:100%; margin-left:10px;margin-top:19px; height: 55px;" class="create-post crs">
			&nbsp; Create post | Ads . . 
			</div>
			</div>
			  
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display:flex; margin:auto;width:100%;text-align:center;justify-content:center;">
			
              <div style="min-width:33%; cursor:pointer" class="create-post cloudblue">
			  <i style="color:#6792bd" class="material-icons">border_color</i> Post</div>

			  <a href="advert-manager/profile.php" style="color:#222; min-width:33%; cursor:pointer" class="cloudblue">
			  <i style="color:#6792bd" class="material-icons">local_hospital</i> Adverts</a>
			  
              <label for="indexUpload" style="min-width:33%; cursor:pointer" class="cloudblue">
			  <i style="color:#6792bd" class="material-icons"> content_copy </i> Photo</label>
        
			 <input type='file' name='indexUpload' class='adsimage display-none' id='indexUpload' multiple="multiple" accept="image/*" />
			  
			
			</div>
            <!-- /.card-body -->
			</div><br><p>
			<!-- /.card -->
		  
		  
		  
			<!--POST VALUE-->
			<div id='page-content'></div> 



		<!--LOAD MORE FETCH DATA-->	
		<div id="load_data"></div>
		<!--LOAD MORE PROGRESSION-->
		<div id="load_data_message"></div>
		<script src="js/load-post/loadmore.js"></script>
	
	
 
		  
        </div>
        <!-- ./col -->
		
		
		
		
		
		
		
		
		
      <div class="col-md-3 group-sidbar" style="padding:4px!important">

    <div class="card sticky-top">
        <div class="card-header">
            <h3 class="card-title"><b>Suggested for you</b></h3><br>
            <div style="color:#869099">Groups you might be interested in.</div>
        </div>
        <div class="card-body">
            <div id="Indicators" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                <?php
                // Initialize $joinedGroupIds to an empty array in case $userid is not set or query fails
                $joinedGroupIds = [];

                // If a user is logged in, fetch their joined groups
                // Assuming $userid is available from your session or initial setup
                if (isset($userid) && $userid) {
                    try {
                        $stmtJoined = $pdo->prepare("SELECT group_id FROM group_members WHERE user_id = :user_id"); // Added status check
                        $stmtJoined->execute([':user_id' => $userid]);
                        $joinedGroupIds = $stmtJoined->fetchAll(PDO::FETCH_COLUMN); // Fetches only the group_id column into a simple array
                    } catch (PDOException $e) {
                        // Log the error for debugging purposes
                        error_log("Error fetching joined groups for user ID: " . $userid . " - " . $e->getMessage());
                        // In a real application, you might show a user-friendly message or handle it differently
                    }
                }

                // Fetch all groups from the database
                $stmt = $pdo->prepare("SELECT * FROM groups");
                $stmt->execute();
                $getGroups = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array

                // Assign an active class to the first carousel item
                $gcount = 0;
                if (!empty($getGroups)) { // Check if there are any groups to display
                    foreach($getGroups as $getGroup){
                        $gcount++;

                        // Determine the group image path
                        $il = "eblaze_illustrate";
                        $ils = substr($il,0,17);
                        $cover = substr($getGroup["cover"],0,17);

                        if($cover == $ils){
                            $groupImg = (!empty($getGroup["cover"]) ? "groups/images/group-cover/illustrations/".$getGroup["cover"]: "groups/images/img/visit.png");
                        }else{
                            $groupImg = (!empty($getGroup["cover"]) ? "groups/images/group-cover/".$getGroup["cover"]:"groups/images/img/visit.png");
                        }

                    // Check if the current group is in the list of joined group IDs
                        // This check MUST be inside the loop for each $getGroup
                        $isJoined = in_array($getGroup["group_id"], $joinedGroupIds); // Corrected: Use $getGroup["group_id"]
                ?>

                <div class="carousel-item <?php if($gcount == 1){echo "active";}?>" style="border:1px solid #ced4da;border-radius:8px">
                  <a href="groupchat/?groupid=<?php echo intval($getGroup["group_id"]);?>">
                    <img class="d-block w-100" src="<?= htmlspecialchars($groupImg);?>"
                    style="height:200px;width:200px;border-radius:8px 8px 0px 0px; border-bottom:1px solid #bbb">
                  </a>

                    <div style="display:block;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;;padding:8px">
                      <a href="groupchat/?groupid=<?php echo intval($getGroup["group_id"]);?>">
                        <h4 style="font-size: 20px;">
                        <?php echo htmlspecialchars($getGroup["group_name"]);?>
                      </h4>
                      </a>
                        <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo htmlspecialchars($getGroup["description"]);?></p>

                        <?php if ($isJoined): ?>
                            <button class="btn btn-success btn-block" style="margin-top:20px;font-weight:600; opacity: 0.7; cursor: default;" disabled>Already Joined</button>
                        <?php else: ?>
                            <?php if (isset($userid) && $userid): // Only show join button if user is logged in ?>
                            <button class="btn btn-default btn-block join-group-btn"
                                data-group-id="<?php echo htmlspecialchars($getGroup["group_id"]); ?>"
                                style="margin-top:20px;font-weight:600">Join Group</button>
                            <?php else: // User not logged in, maybe show a login prompt or just hide the button ?>
                                <button class="btn btn-secondary btn-block" style="margin-top:20px;font-weight:600;" disabled>Log in to Join</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

				
                <?php
                    } // End foreach
                } else {
                    // Message if no groups are available
                    echo '<div class="carousel-item active"><p class="text-center p-3 text-muted">No suggested groups available.</p></div>';
                }
                ?>

                </div>
                <a class="carousel-control-prev" href="#Indicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#Indicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>
        </div>
</div>
		
		
		
		
		
		
		
		</div>
   
   
		</section>
		<!-- /.content -->
	  
	  
	  
	  
		</div>
		<!-- /.content-wrapper -->


		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
 





</div>
<!-- ./wrapper -->





<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.js"></script>

<!-- PAGE theme/plugins -->
<!-- jQuery Mapael -->
<script src="theme/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="theme/plugins/raphael/raphael.min.js"></script>
<!-- ChartJS -->
<script src="theme/plugins/chart.js/Chart.min.js"></script>

<!-- Select2 -->
<script src="theme/plugins/select2/js/select2.full.min.js"></script>
<script src="theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="theme/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- SweetAlert2 -->
<script src="theme/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toaster -->
<script src="theme/plugins/toastr/toastr.min.js"></script>



<svg width="0" height="0" class="visually-hidden">
<symbol id="half-circle" viewBox="0 0 106 57"><path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4" ></path></symbol>
<defs>
<linearGradient id="orange-to-pink" x1="1" x2="0" y1="1" y2="0">
<stop offset="0%" stop-color="#DA1B60" ></stop>
<stop offset="100%" stop-color="#ff8a00" ></stop>
</linearGradient>
<filter id="duotone_orange_pink">
<feColorMatrix type="matrix" result="grayscale" values="1 0 0 0 0
                  1 0 0 0 0
                  1 0 0 0 0
                  0 0 0 1 0">
</feColorMatrix>
<feComponentTransfer color-interpolation-filters="sRGB" result="duotone">
<feFuncR type="table" tableValues="0.7411764706 0.9882352941"></feFuncR>
<feFuncG type="table" tableValues="0.0431372549 0.7333333333"></feFuncG>
<feFuncB type="table" tableValues="0.568627451 0.05098039216"></feFuncB>
<feFuncA type="table" tableValues="0 1"></feFuncA>
</feComponentTransfer>
</filter>
</defs>
</svg>




<script>

 
  //Toaster
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });


/* TOAST TYPES
    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
 
*/


 });



	




	

	var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });


//control col-md display on screen sizes
	if($(window).width() < 900){
		$(".group-sidbar").hide();
		
		$("#create-con").removeClass("col-md-5");
		$("#create-con").addClass("col-md-7");
		
		$("#ads-con").removeClass("col-md-4");
		$("#ads-con").addClass("col-md-5");
		
	}
	
	
	
	
	
	
	
	
//Fetch Group Search Values
$(document).ready(function(){
	
	   // hide loader image
		 $('#loader-image').hide();
	
     // change page title
	function changePageTitle(page_title){   
    // change page title
    $('#page-title').text(page_title);
     
    // change title tag
    document.title=page_title;
	}
	
	

	
	//IF CREATE POST IS CLICKED
	$('.create-post').click(function(){
		changePageTitle('Create Post');

		   // show a loader image
		 $('#loader-image').show();
	
	
		/*scroll to position
		$("html,body").animate({
			scrollTop: $(".ttop").offset().top
		},1200);
		*/
	
		//HIDE & fadeout THE LOAD PROGRESS
    $('#load_data_message').hide();
	 $('#load_data').fadeOut('slow');
	 
	 //hide the ads column 
	 $('#adsBoard').fadeOut();
         
        // fade out effect first
        $('#page-content').fadeOut('slow', function(){
            $('#page-content').load('create_form.php', function(){ 
             
			  //hide the post button container
				$('.optionCon').fadeOut("fast");
				
                // hide loader image
                $('#loader-image').hide(); 
                 
                // fade in effect
                $('#page-content').fadeIn('slow');
            });
        });
    });




	
	
	
	
	
	
	
	
	
	$(".g-search").keyup(function(){
		
	let query = $(".g-search").val();

	$.ajax({
		url:'groups/group-search.php',
		type:'POST',
		data:{query:query},
		success:function(data){
			//console.log(data);
			$(".s-results").html(data);
		}
	});
		
	});
	
	
	
	//Group search visibility
	
	$("#hideSearch").off().click(function(){
		let box = $('#hideSearch');
	
	
	
		if(box.is(':checked')){
		//if box was checked
		let show = "show";
		$.ajax({
		url:'groups/group-search.php',
		type:'POST',
		data:{show:show},
		success:function(data){
			
			//Show Group SearchBox
			$('.groupSearch').fadeIn("slow");
			$('.groupSearch').removeClass("display-none");
			$('#gtext').html("Turn <font color='#dc3545'>OFF</font> Search Box Visibility");
			//console.log(data);
		}
	
	});
	
	}else{
		
		
		//if box was checked
		let hide = "hide";
		$.ajax({
		url:'groups/group-search.php',
		type:'POST',
		data:{hide:hide},
		success:function(data){
		
			//hide Group SearchBox
			$('.groupSearch').fadeOut("slow");
			$('#gtext').html("Turn <font color='green'>ON</font> Search Box Visibility");
			//console.log(data);
		}
	});	
		
	}
	
});

















//UPLOADING NEW POST IMAGE from index page

 $('#indexUpload').change(function(){
  var form_data = new FormData();
  var files = $('#indexUpload')[0].files;
  if(files.length > 10)
  {

	//Toast error
    Toast.fire({
       icon: 'warning',
       title: 'You can\'t select more than 10 images'
	});
	
	return false;
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("indexUpload").files[i].name;
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
    oFReader.readAsDataURL(document.getElementById("indexUpload").files[i]);
    var f = document.getElementById("indexUpload").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 9194304) //9mb
    {
      
	//Toast error
    Toast.fire({
       icon: 'warning',
       title: 'Image is too large. Allowed max size is 9MB'
	})
return false;
    }
    else
    {
     form_data.append("postploads[]", document.getElementById('indexUpload').files[i]);
    }
   }
  

	if(files.length > 0){
   $.ajax({
    url:"post-script.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){$("#loader-image").show();},   
    success:function(data)
    {
		//hide Loader
		$("#loader-image").hide();
		
		//HIDE & fadeout THE LOAD PROGRESS
		$('#load_data_message').hide();
		$('#load_data').fadeOut('slow');
         
		//hide the ads column 
		$('#adsBoard').fadeOut();
		 
        // fade out effect first
        $('#page-content').fadeOut('slow', function(){
        $('#page-content').load('create_form.php?img=new', function(){ 
             
		 //hide the post button container
		 $('.optionCon').fadeOut("fast");
				
          // hide loader image
          $('#loader-image').hide(); 
                 
           // fade in effect
           $('#page-content').fadeIn('slow');
		   
		   
		   //srcoll top
			$("html, body").animate({
				scrollTop: $('#page-content').offset().top
			}, 800);
		
			
			});
			});
		
    }
   });
	}

}//Image Length
  
 });




















 
    // --- Join Group Functionality ---
    $(document).on('click', '.join-group-btn', function() {
        var button = $(this);
        var groupId = button.data('group-id');

        button.prop('disabled', true).text('Joining...');

        $.ajax({
            url: 'groups/join_group.php',
            type: 'POST',
            data: { group_id: groupId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    button.text('Joined').removeClass('btn-default').addClass('btn-success').prop('disabled', true);

                    var currentMembers = parseInt($('#memberCount_' + groupId).text());
                    $('#memberCount_' + groupId).text(currentMembers + 1);

                    // Show success toast
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });

                } else {
                    button.prop('disabled', false).text('Join Group');
                    // Show error toast
                    Toast.fire({
                        icon: 'error',
                        title: 'Error: ' + response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                button.prop('disabled', false).text('Join Group');
                console.error("AJAX Error: " + status + " - " + error);
                // Show generic error toast
                Toast.fire({
                    icon: 'error',
                    title: 'An error occurred. Please try again.'
                });
            }
        });
    });









	$(".vidad").playbackRate=2;
});

</script>






</body>
</html>
