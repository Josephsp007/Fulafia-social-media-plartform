<?php

include("include/config.php");
session_start();

if(!isset($_SESSION["user_login"])){
		header("location: register-login.php");
	}else{
	
	$userid = $_SESSION["user_login"];
	
	
	
	$stmt=$pdo->prepare("SELECT * FROM users WHERE userid=:userid");
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch();
	$DBtoken = (htmlspecialchars($row["status"]));
	
	
	//check if user is already verified
	if($DBtoken == "verified"){
	$result = "<font color='#1fb100'>You're Already Verified</font>";
	$checkMark = '<center style="color: #03441e;"><div class="success-checkmark"> <div class="check-icon"> <span class="icon-line 			
				  line-tip"></span><span class="icon-line line-long"></span><div class="icon-circle"></div> <div class="icon-fix"></div> </div> </div></center>';
	$plswait = '<span id="roll"><span id="pleaseWait" style="color:#bbb; font-size:17px!important;">
				Please Wait... </span> <i class="fa fa-spinner fa-pulse"></i></span>';
		
		//redirect
		echo "
				<script>
				window.setTimeout(function(){
				window.location.href='UpdateImage.php';
				}, 4000);
				</script>
				";
	}else{
		
		
	//check if user is from reg. page & if mail has been sent
	if(isset($_GET["mail"]) && $_GET["mail"]=="sent"){
	$activationSent = "<font color='#1fb100' class='active'>Activation Code Sent</font><font color='#1fb100' class='sent display-none'>Sent</font>
					   <img src='images/check_icon.gif' width='40px' style='vertical-align: bottom;'><br> 
					   <div style='font-size:15px!important;font-weight:300!important' >A link has been sent to 
					   <font style='color:#738290; font-size:17px'><b>". htmlspecialchars($row["email"])."</b> <br> Please Click to verify your Account<br><p></font>
					   
			  <fieldset style='border:1px solid #ededed; border-top-color:#ededed; border-radius:4px; margin-top:10px; padding-bottom:10px;'>
			   <legend style='width: 20%; margin-bottom:0px; font-size: 17px; color:darkgrey;'>
			   Or Resend
			   </legend>
			   <button class='btn btn-navy send' style='text-transform:capitalize'>Resend Link</button><br>
			   </fieldset>
					   ";	
	}else{
		
	
	
	if(isset($_GET["token"])){
		$token = $_GET["token"];
	
	//Check if token match token in DB
	if($token === $DBtoken){
		
	//Update userto verified
	$verified = "verified";
	$stmt=$pdo->prepare("UPDATE users SET status=:verified WHERE userid=:userid");
	$stmt->bindParam(":verified", $verified, PDO::PARAM_STR);
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	$result = "<font color='#1fb100'>Verified Successfully!</font>";
	
	$plswait = '<span id="roll"><span id="pleaseWait" style="color:#bbb; font-size:17px!important;">
				Please Wait... </span> <i class="fa fa-spinner fa-pulse"></i></span>';
				
	$checkMark = '<center style="color: #03441e;"><div class="success-checkmark"> <div class="check-icon"> <span class="icon-line 			
				  line-tip"></span><span class="icon-line line-long"></span><div class="icon-circle"></div> <div class="icon-fix"></div> </div> </div></center>';
				  
	//redirect
		echo "
				<script>
				window.setTimeout(function(){
				//window.location.href='UpdateImage.php';
				}, 10000);
				</script>
				";
			  
	}else{
	$result = "<font color='red' class='active'>Invalid Activation Code!</font>
				<font color='#1fb100' class='sent display-none'>Sent <img src='images/check_icon.gif' width='40px' style='vertical-align: bottom;'></font><br> 
	           <div style='font-size:15px!important;font-weight:300!important' >Check your email for the activation code<br>
			   
			   <fieldset style='border:1px solid #ededed; border-top-color:#ededed; border-radius:4px; margin-top:10px; padding-bottom:10px;'>
			   <legend style='width: 20%; margin-bottom:0px; font-size: 17px; color:darkgrey;'>
			  Or Resend
			   </legend>
			   <button class='btn btn-navy send' style='text-transform:capitalize'>Resend Link</button><br>
			   </fieldset>
			   ";
	$checkMark = '<img src="images/delete-sign.png" class="bad">';
	}

	//if token is not set
	}else{
	$result = "<font color='red' class='active'>Invalid Activation Code!</font>
				<font color='#1fb100' class='sent display-none'>Sent <img src='images/check_icon.gif' width='40px' style='vertical-align: bottom;'></font><br> 
	           <div style='font-size:15px!important;font-weight:300!important' >Check your email for the activation code<br>
			   
			   <fieldset style='border:1px solid #ededed; border-top-color:#ededed; border-radius:4px; margin-top:10px; padding-bottom:10px;'>
			   <legend style='width: 20%; margin-bottom:0px; font-size: 17px; color:darkgrey;'>
			  Or Resend
			   </legend>
			   <button class='btn btn-navy send' style='text-transform:capitalize'>Resend Link</button><br>
			   </fieldset>
			   ";
	$checkMark = '<img src="images/delete-sign.png" class="bad">';
	}
	
	
	
	}//check if user is from reg. page
	
	}//if user verified
	
	
	}
	
?>



<html>
<head>


	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>User Verification | TwigBaze</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<link rel="stylesheet" href="css/styles.css">
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/welcome-style.css">

	
    <style type="text/css">
   

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
			font-size:17px!important;
			color:#868585;
			background:#f9f9f9;
			font-family: "Lato", Helvetica, Arial, sans-serif;
        }

        /* MOBILE STYLES */
        @media screen and (min-width:600px) {
            h3 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }    

		@media screen and (max-width:600px) {
		h3 {
                font-size: 22px!important;
            }
            }
     

		.mailbdy{
			font-size:16px!important;
			margin:auto;
			max-width:700px;
			margin-top:10px;
			
		}
		a{
			text-decoration:none;
			color:#174d78!important;
		}
    </style>
</head>

<body>


		
	
	
              <div class="mailbdy">
			  
              <div style="text-align:center!important; border-radius:10px; border:1px solid #ccc5c5; padding-bottom:20px; margin-bottom:20px;  background:#fff;">
		
           
				<div style="border-bottom:1px solid #ededed; padding:30px;">
				<?php if(isset($checkMark)){echo $checkMark;} ?>
				
				<br><h3 style="font-weight: 400; margin:2px; margin-top:20px; margin-bottom:20px;">
				<?php if(isset($result)){echo $result;} ?>
				<?php if(isset($activationSent)){echo $activationSent;} ?>
				
				</h3>
				 <?php if(isset($plswait)){echo $plswait;} ?>
				</div>
		
				<img src="images/twigBase.png" style="width:140; margin-top:10px; height:;"><br><p>
			
			
				  
            <div align="center" style="padding: 30px; background:#f4f4f4; border-bottom: 1px solid #c0baa3; border-top: 1px solid #c0baa3;">
              
            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">For Support?</h2>
			<br>				
            <a href="http://localhost/CHAT-SYSTEM2/contact-feedback.php" target="_blank">We’re here to help you out</a>
		   
            </div>
					
					
            <br>
			<span id="footBig">&#169;Copyright TwigBaze&#8482; 2021 			
			</div>



</body></html>

<script>
$(document).ready(function(){
	$(".send").click(function(){
		//var token = "generate";
		
		$.post("mails/user-Reg-Resend.php",
			function(data){
			console.log(data);
			$(".bad").fadeOut();
			$(".active").fadeOut(function(){
				$(".sent").fadeIn();
			});
			}
			);
	});
});
</script>