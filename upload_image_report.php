
<?php

 session_start();
 $userid = $_SESSION["user_login"];
 
//upload for feedback page

include('include/config.php');
if(count($_FILES["file"]["name"]) > 0)
{
 //$output = '';
 sleep(3);
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
  $location = 'report-images/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
   $title = "Image Attachment";
   $query = "INSERT INTO report (attachment, userid, title) VALUES (:file_name, :userid, :title)";
   $statement = $pdo->prepare($query);
   $statement->bindParam(":file_name", $file_name, PDO::PARAM_STR);
   $statement->bindParam(":userid", $userid, PDO::PARAM_STR);
   $statement->bindParam(":title", $title, PDO::PARAM_STR);
   $statement->execute();
  }
 }
}

function file_already_uploaded($file_name, $pdo)
{
 
 $query = "SELECT * FROM report WHERE userid = '".$userid."'";
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
