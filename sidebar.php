<?php
	 //redirect incase it was user
	//  if($row["status"] !="admin"){
	// 	echo "<script>location.href='../index.php'</script>";
	//   }

?>



<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="index.php" class="brand-link">
  <img src="../dist/img/AdminLTELogo.png" alt="GOLCS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">ADMIN</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	<div class="image">
	  <img src="<?php echo $userimage;?>" class="img-circle elevation-2" alt="User Image">
	</div>
	<div class="info">
	  <a href="profile.php" class="d-block"><?php echo htmlspecialchars($row["name"]);?>
	  &nbsp;<i class="ion ion-checkmark-circled text-success"></i>
	</a>
	</div>
  </div>

  <!-- SidebarSearch Form -->
  <div class="form-inline">
	<div class="input-group" data-widget="sidebar-search">
	  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
	  <div class="input-group-append">
		<button class="btn btn-sidebar">
		  <i class="fas fa-search fa-fw"></i>
		</button>
	  </div>
	</div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column nav-flat--- " data-widget="treeview" role="menu" data-accordion="false">
	  <!-- Add icons to the links using the .nav-icon class
		   with font-awesome or any other icon font library -->
	  <li class="nav-item menu-open">
		<a href="#" class="nav-link active">
		  <i class="nav-icon fas fa-tachometer-alt"></i>
		  <p>
			Dashboard
			<i class="right fas fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		  <li class="nav-item">
			<a href="profile.php" id="profile" class="nav-link">
			  <i class="far fa-user nav-icon"></i>
			  <p>Profile Settings</p>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="addAdmin.php" id="addRecord" class="nav-link">
			  <i class="ion ion-android-list nav-icon"></i>
			  <p>Add New Admin</p>
			</a>
		  </li>
		</ul>
	  </li>
	  


	  <!-- Users Nav -->
	  <li class="nav-item" id="mDeposit">
		<a href="users.php" class="nav-link">
		<i class="nav-icon ion ion-archive"></i>
		  <p>
			Manage Students
			<i class="fas fa-angle-left right"></i>
		  </p>
		</a>
	  <ul class="nav nav-treeview">
		  <li class="nav-item">
			<a href="addStudent.php" id="addRecord" class="nav-link">
			  <i class="ion ion-android-list nav-icon"></i>
			  <p>Add New Student</p>
			</a>
		  </li>
	  </ul>
	</li>
	
	
	<!-- Staffs Nav -->
	<li class="nav-item" id="mDeposit">
	  <a href="staffs.php" class="nav-link">
	  <i class="nav-icon ion ion-archive"></i>
		<p>
		  Manage Staffs
		  <i class="fas fa-angle-left right"></i>
		</p>
	  </a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
		  <a href="addStaff.php" id="addRecord" class="nav-link">
			<i class="ion ion-android-list nav-icon"></i>
			<p>Add New staff</p>
		  </a>
		</li>
	</ul>
  </li>

  <!-- All users -->
  <li class="nav-item" id="mDeposit">
	  <a class="nav-link">
	  <i class="nav-icon ion ion-archive"></i>
		<p>
		  All users
		  <i class="fas fa-angle-left right"></i>
		</p>
	  </a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
		  <a href="users.php" id="addRecord" class="nav-link">
			<i class="ion ion-android-list nav-icon"></i>
			<p>View all users</p>
		  </a>
		</li>
	</ul>
  </li>

    <!-- Add new Matric/Staff ID -->
	<li class="nav-item" id="mDeposit">
	  <a class="nav-link">
	  <i class="nav-icon ion ion-archive"></i>
		<p>
		  IDS
		  <i class="fas fa-angle-left right"></i>
		</p>
	  </a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
		  <a href="addId.php" id="addRecord" class="nav-link">
			<i class="ion ion-android-list nav-icon"></i>
			<p>Add Matric/Staff ID</p>
		  </a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
		  <a href="idLists.php" id="addRecord" class="nav-link">
			<i class="ion ion-android-list nav-icon"></i>
			<p>View all IDs</p>
		  </a>
		</li>
	</ul>
  </li>



	  



	  <!-- Feedback Nav
	  <li class="nav-item" id="mWithdrawal">
		<a href="#" class="nav-link">
		  <i class="nav-icon ion ion-android-options"></i>
		  <p>
			Users Feedback
			<i class="fas fa-angle-left right"></i>
		  </p>
		</a>

	  <ul class="nav nav-treeview">
		  

	  <li class="nav-item">
			<a href="pendingWithdrawal.php" id="pendingWithdrawal" class="nav-link">
			  <i class="nav-icon ion ion-android-stopwatch"></i>
			  <p>
				Pending Resonse <span class="badge badge-warning right">2</span>
			  </p>
			</a>
		  </li>

	  <li class="nav-item">
		<a href="approvedWithdrawal.php" id="approvedWithdrawal" class="nav-link" style="font-size:15px">
		  <i class="nav-icon ion ion-android-checkmark-circle"></i>
		  <p>
			Approved Resonse <span class="badge badge-success right">2</span>
		  </p>
		</a>
	  </li>

	  <li class="nav-item">
		<a href="declinedWithdrawal.php" id="declinedWithdrawal" class="nav-link" >
		  <i class="nav-icon ion ion-arrow-graph-down-left"></i>
		  <p>
			Declined Resonse <span class="badge badge-danger right">2</span>
		  </p>
		</a>
	  </li>

	  </ul>
	</li> -->
	  <!-- /Feedback Nav -->

	</ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->

<div class="sidebar-custom text-white mx-2">
      <a href="logout.php" class="btn btn-danger mt-2"><i class="fa fa-power-off"></i></a>
      <a href='index.php' class="btn btn-secondary hide-on-collapse pos-right mt-2"><i class="fas fa-home"></i> Home</a>
    </div>


</aside>




<?php

  // Check link and place active class to sidebar
  $url= basename($_SERVER["REQUEST_URI"]);
  if($url == "profile.php"){
	  echo '
	  <script>
	  document.querySelector("#profile").classList.add("active");
	  </script>
	  ';
  }

  else if($url == "changePassword.php"){
	echo '
	<script>
	document.querySelector("#changePassword").classList.add("active");
	</script>
	';
  }

  else if($url == "addRecord.php"){
	echo '
	<script>
	document.querySelector("#addRecord").classList.add("active");
	</script>
	';
  }


//   Loan Management 
  else if($url == "pendingLoan.php"){
	echo '
	<script>
	document.querySelector("#pendingLoan").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "declinedLoan.php"){
	echo '
	<script>
	document.querySelector("#declinedLoan").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "approvedLoan.php"){
	echo '
	<script>
	document.querySelector("#approvedLoan").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "overdues.php"){
	echo '
	<script>
	document.querySelector("#overdues").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "activeLoan.php"){
	echo '
	<script>
	document.querySelector("#activeLoan").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "loanPayments.php"){
	echo '
	<script>
	document.querySelector("#loanPayments").classList.add("active");

	document.querySelector("#mLoan a").classList.add("active");
	let get = document.querySelector("#mLoan");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }

// End Loan


// Deposit
  else if($url == "pendingDeposit.php"){
	echo '
	<script>
	document.querySelector("#pendingDeposit").classList.add("active");

	document.querySelector("#mDeposit a").classList.add("active");
	let get = document.querySelector("#mDeposit");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "approvedDeposit.php"){
	echo '
	<script>
	document.querySelector("#approvedDeposit").classList.add("active");

	document.querySelector("#mDeposit a").classList.add("active");
	let get = document.querySelector("#mDeposit");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "declinedDeposit.php"){
	echo '
	<script>
	document.querySelector("#declinedDeposit").classList.add("active");

	document.querySelector("#mDeposit a").classList.add("active");
	let get = document.querySelector("#mDeposit");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }

//   End Deposit

  

// Withdrawal
  else if($url == "pendingWithdrawal.php"){
	echo '
	<script>
	document.querySelector("#pendingWithdrawal").classList.add("active");

	document.querySelector("#mWithdrawal a").classList.add("active");
	let get = document.querySelector("#mWithdrawal");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "approvedWithdrawal.php"){
	echo '
	<script>
	document.querySelector("#approvedWithdrawal").classList.add("active");

	document.querySelector("#mWithdrawal a").classList.add("active");
	let get = document.querySelector("#mWithdrawal");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "declinedWithdrawal.php"){
	echo '
	<script>
	document.querySelector("#declinedWithdrawal").classList.add("active");

	document.querySelector("#mWithdrawal a").classList.add("active");
	let get = document.querySelector("#mWithdrawal");
	get.classList.add("menu-is-opening");
	get.classList.add("menu-open");
	</script>
	';
  }
  else if($url == "dividend.php"){
	echo '
	<script>
	document.querySelector("#dividend").classList.add("active");
	</script>
	';
  }
  else if($url == "dividendHistory.php"){
	echo '
	<script>
	document.querySelector("#dividendHistory").classList.add("active");
	</script>
	';
  }

//   End Withdrawal
?>
