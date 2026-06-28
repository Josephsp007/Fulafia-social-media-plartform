<?php

include('include/config.php');	
session_start();

 $profileid = $_SESSION["user_login"];
	
	$stmt=$pdo->prepare("SELECT * FROM users WHERE userid=:userid");
	$stmt->bindParam(":userid", $profileid, PDO::PARAM_STR);
	$stmt->execute();
	$prodata=$stmt->fetch();
	
	$query=$pdo->prepare("SELECT * FROM userdata WHERE userid=:userid");
	$query->bindParam(":userid", $profileid, PDO::PARAM_STR);
	$query->execute();
	$profdata=$query->fetch();
		

		
		?>
		
		<!--required inputs - user Profile -->
		<div id="name"><?php echo htmlspecialchars($prodata["name"]);?></div>
		<div id="nick"><?php echo htmlspecialchars($prodata["nick"]);?></div>
		<div id="email"><?php echo htmlspecialchars($prodata["email"]);?></div>
		
		<!--optional inputs - User Profile -->
		
		<div id="gender"><?php echo htmlspecialchars($profdata["gender"]);?></div>
		<div id="institution"><?php echo htmlspecialchars($profdata["institution"]);?></div>
		<div id="course"><?php echo htmlspecialchars($profdata["course"]);?></div>
		<div id="moreschool"><?php echo htmlspecialchars($profdata["moreschool"]);?></div>
		<div id="country"><?php echo htmlspecialchars($profdata["country"]);?></div>
		<div id="location"><?php echo htmlspecialchars($profdata["location"]);?></div>
		<div id="phone"><?php echo htmlspecialchars($profdata["phone"]);?></div>
		<div id="occupation"><?php echo htmlspecialchars($profdata["occupation"]);?></div>
		<div id="moreWorkExp"><?php echo htmlspecialchars($profdata["moreWorkExp"]);?></div>
		<div id="interests"><?php echo htmlspecialchars($profdata["interests"]);?></div>
		
		
		
	
	
	
	
	
		<?php
		//COUNT POST UPLOADED PIX
		$sql=$pdo->prepare("SELECT COUNT(*) AS counts from temp_attach where userid=:userid");
		$sql-> bindParam(':userid', $profileid, PDO::PARAM_STR);
		$sql->execute();
		$counts=$sql->fetch();
		?>
		<span id="countPostPix"><?php echo intval($counts["counts"]);?></span>
	

	
	
	
	
	
	
		
		
		<?php
		// "Advert Manager" button Link
		$query=$pdo->prepare("SELECT token from advert_manager where userid=:userid");
		$query-> bindParam(':userid', $profileid, PDO::PARAM_STR);
		$query->execute();
		$ads=$query->fetch();
		
		?>
		
			<!--Advert Manager Button In "adverts-manager/profile.php" -->
			<div id="mangerButton">
			<a href="manage.php?account_token=<?php echo htmlspecialchars($ads["token"]);?>">
			<div align="center" style="margin:8px;padding:4px; color:#666;">Start posting adverts in your manager page</div>
			<button type="button" class="btn btn-block btn-dark">
			<span class="material-icons">store</span> &nbsp; Advert Manager
			</button>
			</a>
			</div>
			
			
			
			
			
			
		<?php
		//Count uploaded image for advert page
		$stmt=$pdo->prepare("SELECT COUNT(*) AS counter from ads_listing_temp_img where userid=:userid");
		$stmt-> bindParam(':userid', $profileid, PDO::PARAM_STR);
		$stmt->execute();
		$counter=$stmt->fetch();
		echo "<span id='countPixs'>". intval($counter["counter"])."/6</span>";
		
		
		
		//Count uploaded image for advert-Draft Editor page
		$stmt=$pdo->prepare("SELECT COUNT(*) AS counter from edit_draft_temp_img where userid=:userid");
		$stmt-> bindParam(':userid', $profileid, PDO::PARAM_STR);
		$stmt->execute();
		$counter=$stmt->fetch();
		echo "<span id='countDraftPixs'>". intval($counter["counter"])."/6</span>";
		?>