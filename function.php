<?php

include('include/config.php');
session_start();

$userid = intval($_SESSION['user_login']);

//Admin info
$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$userVal=$stmt->fetch();
				
		
		
	

//UPDATE PROFILE IMAGE - for admin
if(isset($_FILES["profilepix"]["name"])){
//Check and remove previous image on folder
 $query=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
 $query->execute();
 $prev = $query->fetch();
 if(!empty($prev["profilepix"]))
 {
	@unlink('../images/profilepix/'.$prev["profilepix"]);
 }
 
	
 //$output = '';
 sleep(1);
 for($count=0; $count<count($_FILES["profilepix"]["name"]); $count++)
 {
  $profilepix = $_FILES["profilepix"]["name"][$count];
  $tmp_name = $_FILES["profilepix"]['tmp_name'][$count];
  $file_array = explode(".", $profilepix);
  $file_extension = end($file_array);
  if(file_already_uploaded($profilepix, $pdo))
  {
   $profilepix = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  $location = '../images/profilepix/' . $profilepix;
  if(move_uploaded_file($tmp_name, $location))
  {
   
   $stmt=$pdo->prepare("UPDATE users SET profilepix=(:profilepix) WHERE userid=:userid");
   $stmt->bindParam(":profilepix", $profilepix, PDO::PARAM_STR);
   $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
   $stmt->execute();
   if($stmt){
	   
		//Load Image
		$sql=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
		$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$sql->execute();
		$row=$sql->fetch();
		$profilepix = (!empty($row["profilepix"]) ? "../img/users/".$row["profilepix"]: "../img/avatar.png");
	
		echo 
		'<img src="'.$profilepix.'" alt="User Avatar" class="img-size-50 mr-3 img-circle" style="height:120px;width:120px; border-radius:50%;border:2px solid #d3d6d7">';
	
  }
   
  }
 }
}
function file_already_uploaded($profilepix, $pdo)
{
 $userid = $_SESSION["user_login"];
 
 $statement = $pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
 $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
 $statement->execute();
 $getStmt = $statement->fetch();
 if(!empty($getStmt["profilepix"]))
 {
  return true;
 }
 else
 {
  return false;
 }
}
//UPDATE ADMIN PROFILE
if(isset($_POST["updateAdmin"])){
			
	$phone = htmlspecialchars(($_POST["phone"]));
	$country = htmlspecialchars(($_POST["country"]));
	$course = htmlspecialchars(($_POST["course"]));

		$stmt = $pdo->prepare("UPDATE userdata SET phone=:phone,country=:country,course=:course WHERE userid=:userid");		

		$stmt->bindParam(":phone",$phone,PDO::PARAM_STR);
		$stmt->bindParam(":country",$country,PDO::PARAM_STR);
		$stmt->bindParam(":course",$course,PDO::PARAM_STR);
		$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
		$stmt->execute();	

		}









		





	
	
///UPDATE PASSWORD - For Admin
if(isset($_POST["updatePass"])){	
		
		$oldPassword = htmlspecialchars($_POST["oldPassword"]);
		$password = htmlspecialchars($_POST["password"]);
		$ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
			
		$checkPassword = password_verify($oldPassword, $userVal["password"]);
			
		if(empty($oldPassword)){
			$error[] = "Enter your current password<br><script>$('#result').fadeIn(); $('#oldPassword').focus()</script>";
		}
		elseif(empty($password)){
			$error[] = "Enter your new password<br><script>$('#result').fadeIn(); $('#password').focus()</script>";
		}
		elseif(empty($ConfirmPassword)){
			$error[] = "Confirm password<br><script>$('#result').fadeIn(); $('#ConfirmPassword').focus()</script>";
		}
		
		elseif(strlen($password)<6){
				$error[] = "Password must be upto 6 characters<br><script>$('#result').fadeIn(); $('#password').focus()</script>";
			}
			
		elseif($ConfirmPassword != $password){
				$error[] = "New passwords did match<br><script>$('#result').fadeIn(); $('#ConfirmPassword').focus()</script>";
			}
				
		elseif($checkPassword != $oldPassword){
				$error[] = "Incorrect password supplied<br><script>$('#result').fadeIn(); $('#oldPassword').focus()</script>";
			}
		
			
			
			
			if(isset($error)){
			foreach($error as $errors){
				echo $errors;
			}
			}else{
	
				try{
				
					$newPassword = password_hash($password, PASSWORD_DEFAULT);
					
					$stmt=$pdo->prepare("UPDATE users SET password=(:password) WHERE userid=:userid");
					
					$stmt->bindParam(":password",$newPassword,PDO::PARAM_STR);
					$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
					$stmt->execute();
					
					if($stmt){
				
				echo '
				<script>
				//Fade Out Form
					$("#result").fadeOut("fast");
					$("#passwordForm").slideUp(function(){
						$("#suc").removeClass("display-none").fadeIn("slow");
						$("#wlcm").html("SUCCESSFUL");	
					});	
				</script>';
				
			
				//Send Confirmation Email to user
				// require_once("../mails/change_password.php");
				
				
			}
				
				}catch(PDOException $e){
					echo "Error occured " . $e->getMessage();
				}
					
			}
			
			
	}
			
			
		
		
		













			





 


	
//UPDATE USER PROFILE IMAGE
if(isset($_FILES["clientPix"]["name"])){

	$clientId = intval($_POST["clientId"]);

	//Check and remove previous image on folder
	 $query=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
	 $query->bindParam(":userid", $clientId, PDO::PARAM_STR);
	 $query->execute();
	 $prev = $query->fetch();
	 if(!empty($prev["profilepix"]))
	 {
		@unlink('../img/users/'.$prev["profilepix"]);
	 }
	 
		
	 //$output = '';
	 sleep(1);
	 for($count=0; $count<count($_FILES["clientPix"]["name"]); $count++)
	 {
	  $profilepix = $_FILES["clientPix"]["name"][$count];
	  $tmp_name = $_FILES["clientPix"]['tmp_name'][$count];
	  $file_array = explode(".", $profilepix);
	  $file_extension = end($file_array);
	  if(file_already_uploadedU($profilepix, $pdo))
	  {
	   $profilepix = $file_array[0] . '-'. rand() . '.' . $file_extension;
	  }
	  $location = '../img/users/' . $profilepix;
	  if(move_uploaded_file($tmp_name, $location))
	  {
	   
	   $stmt=$pdo->prepare("UPDATE users SET profilepix=(:profilepix) WHERE userid=:userid");
	   $stmt->bindParam(":profilepix", $profilepix, PDO::PARAM_STR);
	   $stmt->bindParam(":userid", $clientId, PDO::PARAM_STR);
	   $stmt->execute();
	   if($stmt){
		   
			//Load Image
			$sql=$pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
			$sql-> bindParam(':userid', $clientId, PDO::PARAM_STR);
			$sql->execute();
			$row=$sql->fetch();
			$profilepix = (!empty($row["profilepix"]) ? "../img/users/".$row["profilepix"]: "../img/avatar.png");
		
			echo 
			'<img class="profile-user-img img-fluid img-circle" src="'.$profilepix.'" alt="User profile picture">';
	  }
	   
	  }
	 }
	
	}
	
	function file_already_uploadedU($clientId, $pdo){
	 
	 $statement = $pdo->prepare("SELECT profilepix FROM users WHERE userid=:userid");
	 $statement->bindParam(":userid", $clientId, PDO::PARAM_STR);
	 $statement->execute();
	 $getStmt = $statement->fetch();
	 if(!empty($getStmt["profilepix"]))
	 {
	  return true;
	 }
	 else
	 {
	  return false;
	 }
	}


	
	
	
	

			
			
			
		
		
//Delete User
if(isset($_POST["delid"])){

$delid = $_POST["delid"];

$stmt = $pdo->prepare("DELETE FROM users WHERE userid =:delid ");
$stmt->bindParam(":delid",$delid,PDO::PARAM_STR);
$stmt->execute();

if($stmt){ echo 1; }
}
		




	
	
//Delete ID
if(isset($_POST["delIds"])){

	$id = $_POST["delIds"];
	
	$stmt = $pdo->prepare("DELETE FROM sampleid WHERE id =:id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	echo "1";

	}
		
		
		
		
		
		
			
		
	
///UPDATE PASSWORD FOR USER
if(isset($_POST["updateUserPass"])){	
		
	$password = htmlspecialchars($_POST["password"]);
	$ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
	$clientID = intval($_POST["clientID"]);
	
	
	if(empty($password)){
		$error[] = "Enter your new password<br><script>$('#result').fadeIn(); $('#password').focus()</script>";
	}
	elseif(empty($ConfirmPassword)){
		$error[] = "Confirm password<br><script>$('#result').fadeIn(); $('#ConfirmPassword').focus()</script>";
	}
	
	elseif(strlen($password)<6){
			$error[] = "Password must be upto 6 characters<br><script>$('#result').fadeIn(); $('#password').focus()</script>";
		}
		
	elseif($ConfirmPassword != $password){
			$error[] = "New passwords did match<br><script>$('#result').fadeIn(); $('#ConfirmPassword').focus()</script>";
		}
			
		
		
		
		if(isset($error)){
		foreach($error as $errors){
			echo $errors;
		}
		}else{

			try{
			
				$newPassword = password_hash($password, PASSWORD_DEFAULT);
				
				$stmt=$pdo->prepare("UPDATE users SET password=(:password) WHERE userid=:userid");
				
				$stmt->bindParam(":password",$newPassword,PDO::PARAM_STR);
				$stmt->bindParam(":userid",$clientID,PDO::PARAM_STR);
				$stmt->execute();
				
				if($stmt){
			
			echo '
			<script>
			//Fade Out Form
				$("#result").fadeOut("fast");
				$("#passwordForm").slideUp(function(){
					$("#suc").removeClass("display-none").fadeIn("slow");
					$("#wlcm").html("SUCCESSFUL");	
				});	
			</script>';
			
		
			//Send Confirmation Email to user
			// require_once("../mails/change_password.php");
			
			
		}
			
			}catch(PDOException $e){
				echo "Error occured " . $e->getMessage();
			}
				
			}
		}









		









//ADD NEW STUDENT
if(isset($_POST["type"]) && $_POST["type"] == "addStudent"){
	
			$name = htmlspecialchars($_POST["name"]);
			$email = htmlspecialchars($_POST["email"]);
			$nick = htmlspecialchars($_POST["nick"]);
			$password = htmlspecialchars($_POST["password"]);
			$ids = htmlspecialchars($_POST["ids"]);


			// For email
			$stmt=$pdo->prepare("SELECT COUNT(email) FROM users WHERE email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			$countEmail = $stmt->fetchColumn();

			
			//Check matric exists
			$query = $pdo->prepare("SELECT COUNT(ids) FROM sampleid WHERE ids=:ids");
			$query->bindParam(":ids", $ids, PDO::PARAM_STR);
			$query->execute();
			$countId = $query->fetchColumn();
			
			
			if(empty($name)){
				echo '<div class="alert bg-danger alert-dismissible">Enter student name<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			if(empty($nick)){
				echo '<div class="alert bg-danger alert-dismissible">Enter Username<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($email)){
				echo '<div class="alert bg-danger alert-dismissible">Enter student email<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($ids)){
				echo '<div class="alert bg-danger alert-dismissible">Enter matric number<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($password)){
				echo '<div class="alert bg-danger alert-dismissible">Enter password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			
			elseif(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				echo '<div class="alert bg-danger alert-dismissible">Enter a valid name<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(!preg_match('/^[a-zA-Z0-9]+$/', $nick)){
				echo '<div class="alert bg-danger alert-dismissible">Enter a valid Username<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo '<div class="alert bg-danger alert-dismissible">Invalid email address<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(strlen($_POST["password"])<6){
				echo '<div class="alert bg-danger alert-dismissible">Enter 6 characters password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif($countEmail > 0){
				echo '<div class="alert bg-danger alert-dismissible">Email already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif($countId > 0){
				echo '<div class="alert bg-danger alert-dismissible">Matric number already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
	
	
		
		else{

	
			try{
				$typeStud = "student";
				
				$stmt=$pdo->prepare("INSERT INTO users (name, email, password, status, nick) VALUES(:name, :email, :password, :status, :nick)");
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $password, PDO::PARAM_STR);
				$stmt->bindParam(":status", $typeStud, PDO::PARAM_STR);
				$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
				$stmt->execute();
				$setSession = $pdo->lastInsertId();


				$success = '
				<div class="alert bg-success alert-dismissible">Student successfully Registered &nbsp;&nbsp;<i class="fa fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
				
				$stmt=$pdo->prepare("INSERT INTO userdata (userid, type) VALUES(:userid, 'user')");
				$stmt->bindParam(":userid", $setSession, PDO::PARAM_STR);
				$stmt->execute();


				// Update Matric/Staff id as taken
				$stmt=$pdo->prepare("INSERT INTO sampleid (ids, userid)VALUES(:ids, :userid)");
				$stmt->bindParam(":ids", $ids, PDO::PARAM_STR);
				$stmt->bindParam(":userid", $setSession, PDO::PARAM_INT);
				$stmt->execute();

				echo $success;
				
				
			}catch(PDOException $e){
				echo "Error in connection " . $e->getMessage();
			}
			
			
		}

	}









	


//ADD NEW Admin
if(isset($_POST["type"]) && $_POST["type"] == "addAdmin"){
	
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);


	// For email
	$stmt=$pdo->prepare("SELECT COUNT(email) FROM users WHERE email=:email");
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->execute();
	$countEmail = $stmt->fetchColumn();

	
	
	if(empty($name)){
		echo '<div class="alert bg-danger alert-dismissible">Enter admin name<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif(empty($email)){
		echo '<div class="alert bg-danger alert-dismissible">Enter admin email<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif(empty($password)){
		echo '<div class="alert bg-danger alert-dismissible">Enter password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	
	elseif(!preg_match('/^[a-zA-Z0-9]+$/', $name)){
		echo '<div class="alert bg-danger alert-dismissible">Enter a valid Username<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo '<div class="alert bg-danger alert-dismissible">Invalid email address<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif(strlen($_POST["password"])<6){
		echo '<div class="alert bg-danger alert-dismissible">Enter 6 characters password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif($countEmail > 0){
		echo '<div class="alert bg-danger alert-dismissible">Email already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}



else{


	try{
		$typeStud = "admin";
		
		$stmt=$pdo->prepare("INSERT INTO users (nick, email, password, status) VALUES(:nick, :email, :password, :status)");
		$password = password_hash($password, PASSWORD_DEFAULT);
		$stmt->bindParam(":nick", $name, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->bindParam(":status", $typeStud, PDO::PARAM_STR);
		$stmt->execute();
		$setSession = $pdo->lastInsertId();


		$success = '
		<div class="alert bg-success alert-dismissible">Admin successfully Added &nbsp;&nbsp;<i class="fa fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
		
		echo $success;
		
		
	}catch(PDOException $e){
		echo "Error in connection " . $e->getMessage();
	}
	
	
}

}















	//ADD NEW STAFF
if(isset($_POST["type"]) && $_POST["type"] == "addStaff"){
	
			$name = htmlspecialchars($_POST["name"]);
			$email = htmlspecialchars($_POST["email"]);
			$password = htmlspecialchars($_POST["password"]);
			$ids = htmlspecialchars($_POST["ids"]);


			// For email
			$stmt=$pdo->prepare("SELECT COUNT(email) FROM users WHERE email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			$countEmail = $stmt->fetchColumn();

			
			//Check matric exists
			$query = $pdo->prepare("SELECT COUNT(ids) FROM sampleid WHERE ids=:ids");
			$query->bindParam(":ids", $ids, PDO::PARAM_STR);
			$query->execute();
			$countId = $query->fetchColumn();
			
			
			if(empty($name)){
				echo '<div class="alert bg-danger alert-dismissible">Enter Staff name<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($email)){
				echo '<div class="alert bg-danger alert-dismissible">Enter Staff email<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($ids)){
				echo '<div class="alert bg-danger alert-dismissible">Enter Staff ID<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(empty($password)){
				echo '<div class="alert bg-danger alert-dismissible">Enter password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			
			elseif(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				echo '<div class="alert bg-danger alert-dismissible">Enter a valid name<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo '<div class="alert bg-danger alert-dismissible">Invalid email address<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif(strlen($_POST["password"])<6){
				echo '<div class="alert bg-danger alert-dismissible">Enter 6 characters password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif($countEmail > 0){
				echo '<div class="alert bg-danger alert-dismissible">Email already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
			elseif($countId > 0){
				echo '<div class="alert bg-danger alert-dismissible">Staff ID already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
			}
	
	
		
		else{

	
			try{
				$typeStud = "staff";
				
				$stmt=$pdo->prepare("INSERT INTO users (name, email, password, status) VALUES(:name, :email, :password, :status)");
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $password, PDO::PARAM_STR);
				$stmt->bindParam(":status", $typeStud, PDO::PARAM_STR);
				$stmt->execute();
				$setSession = $pdo->lastInsertId();


				$success = '
				<div class="alert bg-success alert-dismissible">Staff successfully Created &nbsp;&nbsp;<i class="fa fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
				
				$stmt=$pdo->prepare("INSERT INTO userdata (userid, type) VALUES(:userid, 'staff')");
				$stmt->bindParam(":userid", $setSession, PDO::PARAM_STR);
				$stmt->execute();


				// Update Matric/Staff id as taken
				$stmt=$pdo->prepare("INSERT INTO sampleid (ids, userid)VALUES(:ids, :userid)");
				$stmt->bindParam(":ids", $ids, PDO::PARAM_STR);
				$stmt->bindParam(":userid", $setSession, PDO::PARAM_INT);
				$stmt->execute();

				echo $success;
				
				
			}catch(PDOException $e){
				echo "Error in connection " . $e->getMessage();
			}
			
			
		}

	}





















//ADD NEW Admin
if(isset($_POST["type"]) && $_POST["type"] == "addId"){
	
	$newId = htmlspecialchars($_POST["newId"]);


	// For email
	$stmt=$pdo->prepare("SELECT COUNT(ids) FROM sampleid WHERE ids=:ids");
	$stmt->bindParam(":ids", $newId, PDO::PARAM_STR);
	$stmt->execute();
	$countId = $stmt->fetchColumn();

	
	
	if(empty($newId)){
		echo '<div class="alert bg-danger alert-dismissible">Enter new Id<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif(!preg_match('/^[a-zA-Z0-9\/]+$/', $newId)){
		echo '<div class="alert bg-danger alert-dismissible">Enter a valid ID<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}
	elseif($countId > 0){
		echo '<div class="alert bg-danger alert-dismissible">ID already taken<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
	}



else{


	try{
		
		$stmt=$pdo->prepare("INSERT INTO sampleid (ids) VALUES(:ids)");
		$stmt->bindParam(":ids", $newId, PDO::PARAM_STR);
		$stmt->execute();


		$success = '
		<div class="alert bg-success alert-dismissible">ID successfully Added &nbsp;&nbsp;<i class="fa fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
		
		echo $success;
		
		
	}catch(PDOException $e){
		echo "Error in connection " . $e->getMessage();
	}
	
	
}

}