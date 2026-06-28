<?php

include("include/config.php");

session_start();

			function validate($str){
			return trim(htmlspecialchars(strip_tags(($str))));
		}


	$email = htmlspecialchars(strip_tags($_POST["email"]));
	$password = validate($_POST["password"]);

			if(!preg_match('/^[a-zA-Z0-9@\.s]+$/',$email)){
			$errorMsg[] = "Invalid email or Username";
		
		}else{
		
		try{
			
			$query="SELECT * FROM users WHERE ";
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
						$query .="email=:email";
					}else{
						$query .="nick=:email";
					}
			
			$stmt=$pdo->prepare($query);
			$stmt->bindValue(":email",$email,PDO::PARAM_STR);
			$stmt->execute();
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()>0){
				
			if($email = $result["nick"] OR $email = $result["email"]){
				
				if(password_verify($password, $result["password"])){
					
				$_SESSION["user_login"] = $result["userid"];
				
				$success = 'Access Granted!';
				// Twick the Login button to loader img...
				
				}else{
					$errorMsg[] = "Access Denied! Wrong Password";
				}
				
			}else{
				$errorMsg[] = "Username or Email Not Registered";
			}
				
			}else{
				$errorMsg[] = "Username or Email Not Registered";
			}
			
		}catch(PDOException $e){
			echo "Error in connection " . $e->getMessage();
		}
	}

?>




<?php 
	
	if(isset($_SESSION["user_login"])){
		$userid = $_SESSION["user_login"];

		$stmt="SELECT * FROM users WHERE userid = :userid";
		$stmt=$pdo->prepare($stmt);
		$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch();


		$page = $row["status"] == "admin" ? "admin" : "index.php";

		echo "
		<script>
		window.setTimeout(function(){
			window.location.href='".$page."';
		}, 6000);
		</script>
		";
		
		echo "
		<script>
		function(){
		$('span#log').hide();
		$('h2#roll').show();
		}
		</script>";

?>
	
	<style>
	.img-update-pg{
	width:130px;
	height:130px;
	margin-bottom:5px;
	border-radius:50%;
	border:3px solid #bbb;
	}
	</style>
	
	
	 <center>
	<img class='img-update-pg' src='profilepix/<?php echo $row["profilepix"];?>'>
	<h3 style='color:#767e80!important;font-size:22px'><?php echo $row["name"];?> <h3>
	</center>
	


	
	
<?php
	}

?>



<?php
if(isset($success)){
	
  echo "<center>
		<h4 class='logs' style='color:#288e47'>Aceess Granted Logging you in...</h4>
		</center> 
  <div class='coversoverlay'></div>";

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