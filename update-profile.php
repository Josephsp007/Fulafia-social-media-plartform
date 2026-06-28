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
	
	$error = "";
	
	function validate($str){
			return trim(htmlspecialchars($str));
		}

	//validate name field
		if(empty($_POST["name"])){
			echo "	
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Encountered an error!',
    content: 'Name is required',
    type: 'red',
    //typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
		}else{
			$name = validate($_POST["name"]);
		if(!preg_match('/^[a-zA-Z0-9-_\s]+$/', $name)){
			echo "
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Invalid name',
    content: 'Only letters with numbers, hyphen or underscore allowed',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
			}
			}
			
		
		//validate username (nick)
		if(empty($_POST["nick"])){
				echo "	
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Encountered an error!',
    content: 'Username is required',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;	
			}
			else{
			$nick = validate($_POST["nick"]);
			if(!preg_match('/^[a-zA-Z0-9-_\s]+$/', $nick)){
				echo "
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Invalid Username',
    content: 'Only letters with numbers, hyphen or underscore allowed',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
			}else{
				
				if($_POST["nick"]!=$prodata["nick"]){
					
				$stmt = "SELECT userid FROM users WHERE nick=:nick";
				$stmt=$pdo->prepare($stmt);
				$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount()>0){
					echo "
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Username is Unavailable',
    content: 'This Username is already taken',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
				}
			}
			}
			}
					
			
		//validate email
		if(empty($_POST["email"])){
			echo "	
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Encountered an error!',
    content: 'Email is required',
    type: 'red',
    //typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
		}else{
			$email = validate($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo "	
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Invalid email!',
    content: 'Format: example@email.com',
    type: 'red',
    //typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
			}else{
				
				if($_POST["email"]!=$prodata["email"]){
					
				$stmt = "SELECT userid FROM users WHERE email=:email";
				$stmt=$pdo->prepare($stmt);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount()>0){
				echo "
	<script>
   $.confirm({
	icon: 'fa fa-warning',
    title: 'Email is Unavailable',
    content: 'This Email is already taken',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Try again',
            btnClass: 'btn-red',
            action: function(){
            }}, } });
			</script>";	
			$error = 1;
				}
				}
			}
		}
		
		
		
		
		//optional inputs
		
		$gender = validate(strip_tags($_POST["gender"]));
		$phone = validate(strip_tags($_POST["phone"]));
		$country = validate(strip_tags($_POST["country"]));
		$interests = validate(strip_tags($_POST["interests"]));
		$location = validate(strip_tags($_POST["location"]));
		$institution= validate(strip_tags($_POST["institution"]));
		$course = validate(strip_tags($_POST["course"]));
		$moreschool	= validate(strip_tags($_POST["moreschool"]));
		$occupation = validate(strip_tags($_POST["occupation"]));	
		$moreWorkExp = validate(strip_tags($_POST["moreWorkExp"]));
	
		
		
		if(empty($error)){
		
		$stmt=$pdo->prepare("UPDATE users SET name=(:name),email=(:email), nick=(:nick) WHERE userid=:userid");	
		$stmt->bindParam(":name", $name, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);
		$stmt->bindParam(":userid", $profileid, PDO::PARAM_STR);
		$stmt->execute();
		
		$stmt=$pdo->prepare("UPDATE userdata SET
		gender=(:gender),institution=(:institution),country=(:country),phone=(:phone), location=(:location), moreschool=(:moreschool), course=(:course), occupation=(:occupation), moreWorkExp=(:moreWorkExp), interests=(:interests) WHERE userid=:userid");	
		$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
		$stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
		$stmt->bindParam(":country", $country, PDO::PARAM_STR);
		$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
		$stmt->bindParam(":location", $location, PDO::PARAM_STR);
		$stmt->bindParam(":moreschool", $moreschool, PDO::PARAM_STR);
		$stmt->bindParam(":course", $course, PDO::PARAM_STR);
		$stmt->bindParam(":occupation", $occupation, PDO::PARAM_STR);
		$stmt->bindParam(":moreWorkExp", $moreWorkExp, PDO::PARAM_STR);
		$stmt->bindParam(":interests", $interests, PDO::PARAM_STR);
		$stmt->bindParam(":userid", $profileid, PDO::PARAM_STR);
		$stmt->execute();
		
		?>
		
		<script>
		//show jquery success
		$.confirm({
    title: '<div style="color: #2f7932;"> Updated Successfully!</div>',
    content: 
		'<center style="color: #03441e;"><div class="success-checkmark"> <div class="check-icon"> <span class="icon-line line-tip"></span><span class="icon-line line-long"></span><div class="icon-circle"></div> <div class="icon-fix"></div> </div> </div></center>',
	
    type: 'green',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Continue',
            btnClass: 'btn-green',
            action: function(){
            }
        },
        //close: function () {
        //}
		}
	});
		</script>
		
		<?php
		}
		?>
		
		