<?php


	include('include/config.php');
	session_start();

	$userid = intval($_SESSION['user_login']);
 
	
		//Admin info 
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid = :userid");
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$userVal=$stmt->fetch();
		
		








	///UPDATE PASSWORD - For Admin
	
	if(isset($_POST["updatePass"])){	
		
		$oldPassword = htmlspecialchars($_POST["oldPassword"]);
		$password = htmlspecialchars($_POST["password"]);
		$ConfirmPassword = htmlspecialchars($_POST["ConfirmPassword"]);
			
		$checkPassword = password_verify($oldPassword, $userVal["password"]);
			
		if(empty($oldPassword)){
			$pError[] = "Enter your current password<br><script>$('#result').removeClass('display-none').fadeIn(); $('#oldPassword').focus()</script>";
		}
		elseif(empty($password)){
			$pError[] = "Enter your new password<br><script>$('#result').removeClass('display-none').fadeIn(); $('#password').focus()</script>";
		}
		elseif(empty($ConfirmPassword)){
			$pError[] = "Confirm password<br><script>$('#result').removeClass('display-none').fadeIn(); $('#ConfirmPassword').focus()</script>";
		}
		
		elseif(strlen($password)<6){
				$pError[] = "Password must be upto 6 characters<br><script>$('#result').removeClass('display-none').fadeIn(); $('#password').focus()</script>";
			}
			
		elseif($ConfirmPassword != $password){
				$pError[] = "New passwords did match<br><script>$('#result').removeClass('display-none').fadeIn(); $('#ConfirmPassword').focus()</script>";
			}
				
		elseif($checkPassword != $oldPassword){
				$pError[] = "Incorrect password supplied<br><script>$('#result').removeClass('display-none').fadeIn(); $('#oldPassword').focus()</script>";
			}
		
			
			
			
			if(isset($pError)){
			foreach($pError as $errors){
				echo $errors;
			}
			}else{
	
				try{
				
					$newPassword = password_hash($password, PASSWORD_DEFAULT);
					
					$stmt=$pdo->prepare("UPDATE users SET password=(:password) WHERE userid=:userid");
					$stmt->bindParam(":password",$newPassword,PDO::PARAM_STR);
					$stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
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
			
			


	