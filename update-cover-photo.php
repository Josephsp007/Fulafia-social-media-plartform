<?php
	
	
	include("include/config.php");
	session_start();
	
	
	$userid = intval($_SESSION["user_login"]);
	

//Update profile coverpix

if(isset($_FILES["file"]["name"]) && count($_FILES["file"]["name"]) > 0){
 
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $pdo))
  {
   $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  
  $file_name = str_replace(" ","-", $file_name);
  
  $location = 'images/users-cover/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {

   $query = "UPDATE userdata SET coverpix=:file_name WHERE userid=:userid";
   $statement = $pdo->prepare($query);
   $statement->bindParam(":file_name", $file_name, PDO::PARAM_STR);
   $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
   $statement->execute();
   echo "success";
  }
 }
}

function file_already_uploaded($file_name, $pdo){
 $userid = intval($_SESSION["user_login"]);
 $query=$pdo->prepare("SELECT coverpix FROM userdata WHERE userid=:userid");
 $query->bindParam(":userid", $userid, PDO::PARAM_STR);
 $query->execute();
 $number_of_rows = $query->rowCount();
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}


	

$stmt=$pdo->prepare ("SELECT coverpix FROM userdata WHERE userid=:userid");
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch();
$cover =  "images/users-cover/".$result["coverpix"];

?>
	
	

<style>
.cover-bg {
background-image:
    radial-gradient(ellipse closest-side, rgba(19, 19, 19, 0), #134753f0), 
	url(<?php echo htmlspecialchars($cover); ?>);
    background-repeat: no-repeat;
	background-size:100%;
	height:300px;
	background-position:center;
	padding:0px; margin-top:0px;
	  }
.cover-bg:hover{
	background-image:
    radial-gradient(ellipse closest-side, rgba(19, 19, 19, 0), #134753b3), 
	url(<?php echo htmlspecialchars($cover); ?>);
}


</style>
	
	
	
	
	
	
