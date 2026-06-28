<?php

include('include/config.php');
session_start();
$userid = intval($_SESSION["user_login"]);


//Upload comment script

if(isset($_GET["post_id"])){

$post_id = intval($_GET["post_id"]);

if(count($_FILES["comfile"]["name"]) > 0){

//$output = '';
sleep(1);
for($count=0; $count<count($_FILES["comfile"]["name"]); $count++)
{
$file_name = $_FILES["comfile"]["name"][$count];
$tmp_name = $_FILES["comfile"]['tmp_name'][$count];
$file_array = explode(".", $file_name);
$file_extension = end($file_array);

$file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;

$location = 'images/comment-images/' . $file_name;
if(move_uploaded_file($tmp_name, $location))
{
$posted = time();
$stmt =$pdo->prepare("INSERT INTO postcomments (attachment, userid, post_id, posted) VALUES (:attachment, :userid, :post_id, :posted)");
$stmt->bindParam(":attachment", $file_name, PDO::PARAM_STR);
$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
$stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
$stmt->bindParam(":posted", $posted, PDO::PARAM_STR);
$stmt->execute();
}
}
}
	if($stmt){
		
	$sql =$pdo->prepare("SELECT * FROM postcomments WHERE post_id =:post_id");
	$sql->bindParam(':post_id', $post_id, PDO::PARAM_STR);
	$sql->execute();
	if($sql->rowCount()>0){
		echo "
		<script>
		$.confirm({
		icon: 'fa fa-check',
		title: 'Successful!',
		content: 'Image Uploaded',
		type: 'green'
		});
		</script>";
	}
	}

}

?>
