<?php

include "include/config.php";
session_start();
error_reporting(0);

	  $userid =  $_SESSION["user_login"];
	  $post_id = $_POST['postId'];
	  $reactType = $_POST['reactType'];
	  $type = $_POST['type'];

	//Check if liked by same user and dont re-insert
	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE userid=:userid AND post_id=:post_id");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
	$stmt->execute();
	$getReact = $stmt->fetch();
	$count = $stmt->rowCount();	
	
	if(isset($reactType) && $reactType!= $getReact["reactType"]){
	$stmt = $pdo->prepare("UPDATE post_like SET reactType=:reactType WHERE post_id=:post_id AND userid=:userid");
    $stmt->bindParam(":reactType", $reactType, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	}
	
	if($count<1){
	//if Like was clicked
	if($type=="like"){
	$stmt = $pdo->prepare("INSERT INTO post_like(userid, post_id, reactType) VALUE (:userid, :post_id, :reactType)");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
    $stmt->bindParam(":reactType", $reactType, PDO::PARAM_STR);
	$stmt->execute();
	}
	}
	
	
	// if Unlike was clicked
	if($type=="unlike"){
	$stmt = $pdo->prepare("DELETE FROM post_like WHERE userid=:userid AND post_id=:post_id");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
	$stmt->execute();
	}
	
	
	
	

	//Check if post was liked by user 
	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE userid=:userid AND post_id=:post_id");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
	$stmt->execute();
	$getReact = $stmt->fetch();
	$count = $stmt->rowCount();
	
	//return number of likes
	$stmt = $pdo->prepare("SELECT userid FROM post_like WHERE post_id=:post_id");
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
	$stmt->execute();
	$countLikes = $stmt->rowCount();


				if($countLikes == 1 AND $count>0){
					echo "You Reacted to Post";
				}elseif($countLikes == 1 AND $count<1){
					echo $countLikes." Reaction";	
				}elseif($countLikes >1 AND $count<1){
					echo $countLikes." Reactions";	
				}elseif($countLikes == 2 AND $count>0){
					echo "You and ".($countLikes-1)." Other";	
				}elseif($countLikes >1 AND $count>0){
					echo "You and ".($countLikes-1)." Others";	
				}else{
					echo "React to Post";
				}
				
			
			