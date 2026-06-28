<?php
session_start();
include('include/config.php');
error_reporting(0);

$userid = intval($_SESSION["user_login"]);

if(count($_FILES["file"]["name"]) > 0)
{
	
	
//Check and remove previous image on folder
 $query=$pdo->prepare("SELECT profilepix FROM users WHERE userid =:userid");
 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
 $query->execute();
 $prev = $query->fetch();
 $number_of_rows = $query->rowCount();
 if($number_of_rows > 0)
 {
	@unlink('images/profilepix/'.$prev["profilepix"]);
 }
 
	
 for($count=0; $count<count($_FILES["file"]["name"]); $count++){
  $profilepix = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $profilepix);
  $file_extension = end($file_array);
  if(file_already_uploaded($profilepix, $pdo))
  {
   $profilepix = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  $location = 'images/profilepix/' . $profilepix;
  if(move_uploaded_file($tmp_name, $location)){
  
	$userid = $_SESSION["user_login"];
	$category = "profilepix";
	
   $stmt=$pdo->prepare("UPDATE users SET profilepix=(:profilepix) WHERE userid=:userid");
   $stmt->bindParam(":profilepix", $profilepix, PDO::PARAM_STR);
   $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
   $stmt->execute();
   if($stmt){
	   
	 //send the user image to profileImage.php as soon as the page loads
		$sql=$pdo->prepare("SELECT * FROM users WHERE userid=:userid");
		$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$sql->execute();
		$row=$sql->fetch();
		$userimage = "images/profilepix/".$row["profilepix"];
 
echo'
<style>
.bg-black{
    background-image: radial-gradient(ellipse closest-side, rgba(19, 19, 19, 0), #134753f0), url('.$userimage.');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
}
</style>';
  }
	
   
  }
 }
}

function file_already_uploaded($profilepix, $pdo)
{
 $userid = $_SESSION["user_login"];
 
 $query = "SELECT * FROM users WHERE userid = '".$userid."'";
 $statement = $pdo->prepare($query);
 $statement->execute();
 $number_of_rows = $statement->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}


?>




