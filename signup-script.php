<?php

include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
		header("location: index.php");
	}

	$name = $_POST["name"];
	$nick = $_POST["nick"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$matric = $_POST["matric"];


		function validate($str){
			return trim(htmlspecialchars(strip_tags(($str))));
		}
		

			$nick = validate($_POST["nick"]);
			if(!preg_match('/^[a-zA-Z0-9-_\s]+$/', $nick)){
				$errorMsg[] = "Only letters with numbers, hyphen or underscore allowed";
			}else{
				$stmt = "SELECT userid FROM users WHERE nick=:nick";
				$stmt=$pdo->prepare($stmt);
				$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount()>0){
					$errorMsg[] = "Username already taken. <br> Try: '" . $nick . "20', '" . $nick . "10', '" . $nick . "5'";
				}
			}
		
	
			$name = validate($_POST["name"]);
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errorMsg[] = "Invalid name! Must be letters";
			}
		
		
			$email = validate($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errorMsg[]  = "Invalid email supplied, must contain @.com";
			}else{
				$stmt=$pdo->prepare("SELECT userid FROM users WHERE email=:email");
				$con = array(":email"=>$email);
				$stmt->execute($con);
				if($stmt->rowCount() >0){
					$errorMsg[] = "A user with this email already exist";
				}
			}
		

		
		$matric = validate($_POST["matric"]);
		
		// If not in Samples
		$query = $pdo->prepare("SELECT * FROM sampleid WHERE ids=:ids");
		$query->bindParam(":ids", $matric, PDO::PARAM_STR);
		$query->execute();
		$getId = $query->fetch();
		$sample = $query->rowCount();

		if(!empty($getId["userid"])){
			$errorMsg[] = "Staff ID/Matric Number already taken";
		}
		elseif($sample < 1){
			$errorMsg[] = "Invalid Staff ID/Matric Number";
		}


		
		


				$password = validate($_POST["password"]);
				if(strlen($_POST["password"])<6){
					$errorMsg[] = "Password must be upto 6 characters";
				}
		
			
		if(empty($errorMsg)){
			
			try{
				$type = "user";
				
				$stmt=$pdo->prepare("INSERT INTO users (name, nick, email, password) VALUES(:name, :nick, :email, :password)");
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $password, PDO::PARAM_STR);
				$stmt->execute();


				$success = "Registered Successfully &nbsp;&nbsp;<i class='fa fa-check-circle'></i>";
				
				if(isset($success)){
					$stmt=$pdo->prepare("SELECT * FROM users WHERE nick=:nick OR email=:email");
					$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
					$stmt->bindParam(":email", $email, PDO::PARAM_STR);
					$stmt->execute();
					$row=$stmt->fetch();
					}
					
				$_SESSION["user_login"] = $row["userid"];
				$userid = $_SESSION["user_login"];
				
				$stmt=$pdo->prepare("INSERT INTO userdata (userid, type)VALUES(:userid, :type)");
				$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
				$stmt->bindParam(":type", $type, PDO::PARAM_STR);
				$stmt->execute();


				// Update Matric/Staff id as taken
				$stmt=$pdo->prepare("UPDATE sampleid SET userid=:userid WHERE ids=:ids");
				$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
				$stmt->bindParam(":ids",$matric, PDO::PARAM_STR);
				$stmt->execute();
				
				
			}catch(PDOException $e){
				echo "Error in connection " . $e->getMessage();
			}
			
			
		}
	
	
	// END REGISTER CODE
	


?>

<script>
var close = document.getElementsByClassName("closebtn");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

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