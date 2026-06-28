<?php

include "include/config.php";
session_start();

$userid =  $_SESSION["user_login"];

$com_id = $_POST['com_id'];
$type = $_POST['type'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM comment_like WHERE com_id=".$com_id." and userid=".$userid;
$query=$pdo->prepare($query);
$query->execute();
$fetchdata=$query->fetch();
$count = $fetchdata['cntpost'];


if($count == 0){
    $insertquery = "INSERT INTO comment_like(userid,com_id,type) VALUES (".$userid.",".$com_id.",".$type.")";
    $insertquery=$pdo->prepare($insertquery);
	$insertquery->execute();
	
}else {
    $updatequery = "UPDATE comment_like SET type=" . $type . " WHERE userid=" . $userid . " AND com_id=" . $com_id;
    $updatequery=$pdo->prepare($updatequery);
	$updatequery->execute();
}

// count numbers of like and unlike in comment
$querylike = "SELECT COUNT(*) AS cntLike FROM comment_like WHERE type=1 and com_id=".$com_id;
$querylike=$pdo->prepare($querylike);
$querylike->execute();
$fetchlikes = $querylike->fetch();
$totalLikes = $fetchlikes['cntLike'];

$queryunlike = "SELECT COUNT(*) AS cntUnlike FROM comment_like WHERE type=0 and com_id=".$com_id;
$queryunlike=$pdo->prepare($queryunlike);
$queryunlike->execute();
$fetchunlikes = $queryunlike->fetch();
$totalUnlikes = $fetchunlikes['cntUnlike'];


$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);