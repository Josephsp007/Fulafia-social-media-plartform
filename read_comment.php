<!-- COMMENT vote script -->
<script src="js/comment-like-script.js" type="text/javascript"></script>

<?php
// include database and object files
include_once 'database.php';
include_once 'include/config.php';
include_once 'objects/comment.php';
include_once 'include/timeago.php';

session_start();
$userid = $_SESSION["user_login"];

//get session from Comment.php
$postid = $_SESSION['postid'];

// instantiate database and comment object
$database = new Database();
$db = $database->getConnection();

// initialize object
$comment = new comment($db);


$sql = "SELECT * from users where userid = (:userid);";
$query = $db -> prepare($sql);
$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
$query->execute();
$users=$query->fetch();
$user = $users["name"];



//SHOW POST ON COMMENT PAGE ABOVE! BEFORE THE COMMENTS
$stmt = "SELECT users.profilepix, users.name, users.userid, posts.post_id, posts.post, posts.background, posts.created, posts.modified, posts.attachment 
FROM users, posts WHERE users.userid=posts.userid AND post_id = '$postid'";
$stmt = $db -> prepare($stmt);
$stmt->execute();
$POST = $stmt->fetch();
$posterpix = (!empty($POST["profilepix"]) ? "images/profilepix/" . $POST["profilepix"]: "images/site/user.png");


//get comment Row count
$sql = "SELECT * FROM postcomments WHERE post_id =:post_id";
$query = $db -> prepare($sql);
$query-> bindParam(':post_id', $POST["post_id"], PDO::PARAM_STR);
$query->execute();
?>


<h4 style="max-width:700px; margin:15px auto 20px auto; font-family:tahoma"><?php echo $query->rowCount();?> Comment(s) </h4>

<?php

$stmt = "SELECT users.name,users.profilepix,postcomments.post_id,postcomments.com_id,postcomments.userid,postcomments.comment,postcomments.posted,postcomments.attachment
FROM users, postcomments WHERE postcomments.userid=users.userid AND post_id = '$postid' ORDER BY com_id DESC";
$stmt = $db -> prepare($stmt);
//$stmt-> bindParam(':post_id', $post_id, PDO::PARAM_STR);
$stmt->execute();



$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

// start table
echo "<div>";

$row = $stmt->fetchAll();

foreach($row as $row){
//set type for vote
$type = -1;

$posterpix = (!empty($row["profilepix"]) ? "images/profilepix/" . $row["profilepix"]: "images/site/user.png");

//SET $ago to created column and call function from timeago.php	
$ago = $row["posted"];
$postTime = to_time_ago($ago);


?>		


<div class="comment-con">
<div class="avatar-comment"><a href="user-profile.php?id=<?php echo $row['userid'];?>"><img src="<?php echo $posterpix?>" class="comment-avatar"></a></div>
<div class="comment-text">
<div class="time"><?php echo $postTime ?></div>


<?php if(!empty($row['attachment'])){echo $row['comment'].'<p style="margin-top:6px;">';}else{echo $row['comment'];}?>
<?php if(!empty($row['attachment'])){echo '<img class="comment-img" src="images/comment-images/'.$row["attachment"].'">';}?>




<!--Vote ICon-->
<?php

//comment ID
$com_id = $row['com_id'];

// Checking user status TYPE

$query = "SELECT count(*) as cntStatus,type FROM comment_like WHERE userid=".$userid." and com_id=".$com_id;
$query=$pdo->prepare($query);
$query->execute();
$status_row = $query->fetch();
$count_status = $status_row['cntStatus'];
if($count_status > 0){
$type = $status_row['type'];
}

// Count post total likes and unlikes
$like_query = "SELECT COUNT(*) AS cntLikes FROM comment_like WHERE type=1 and com_id=".$com_id;
$like_query=$pdo->prepare($like_query);
$like_query->execute();
$like_row = $like_query->fetch();
$total_likes = $like_row['cntLikes'];

$unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM comment_like WHERE type=0 and com_id=".$com_id;
$unlike_query=$pdo->prepare($unlike_query);
$unlike_query->execute();
$unlike_row = $unlike_query->fetch();
$total_unlikes = $unlike_row['cntUnlikes'];

//
?>


<div class="vote-icon" style="margin-top:5px!important; margin-bottom:-5px!important">
<small>Vote Comment</small><br>


<i title="Up Vote" id="like_<?php echo $com_id; ?>" class="like glyphicon glyphicon-triangle-top" style="<?php if($type == 1){ echo "color: #2fac02;"; } ?>"></i>		
<!--COUNT VOTE UP--><span id="likes_<?php echo $com_id; ?>"><?php if($total_likes !=0){echo $total_likes;} ?></span>&nbsp;&nbsp;

<i title="Down Vote" id="unlike_<?php echo $com_id; ?>" class="unlike glyphicon glyphicon-triangle-bottom" style="<?php if($type == 0){ echo "color: #ee4e4e;"; } ?>"></i>
<!--COUNT VOTE UP--><span id="unlikes_<?php echo $com_id; ?>"><?php if($total_unlikes !=0){echo $total_unlikes;} ?></span>

<!--/Vote ICon-->	

</div>
</div>



<div class = "btn-group">
<div class="comment-options " data-toggle = "dropdown"><i class="glyphicon glyphicon-option-horizontal"></i></div> 

<div class="dropdown-menu pull-right" aria-labelledby="navbarDropdown" style="top:50px;width:230px;"> 
<a  href="report.php?report_comment=<?php echo htmlspecialchars(strip_tags($row['com_id']));?>" class="dropdown-item"><i class="fa fa-remove"></i> Report Comment</a>
<!-- <div class="dropdown-divider"></div>		
<a href="#" class="dropdown-item"><i class="fa fa-share-square-o"></i> Share This</a>  -->
<!-- <div class="dropdown-divider"></div> 
<a href="#" class="dropdown-item"><i class="fa fa-link"></i> Copy Link</a>  -->

<?php    
echo "<font>";
echo "<div class='comment-id display-none'>".$row['com_id']."</div>";

//HIDE EDIT AND DELET OPTION IF NOT THE POSTER
if($users['userid'] === $row['userid']){
?>

<div class="dropdown-divider"></div>    
<div class="edit-btn dropdown-item" data-dismiss="modal" aria-label="Close"style="cursor:pointer;"><i class="fa fa-edit" ></i> 
<?php if(!empty($row['attachment'])&& empty($row['comment'])){echo "Add text to image";}else{echo "Edit Comment";} ?></div>

<div class="dropdown-divider"></div> 
<div class="delete-btn dropdown-item" data-dismiss="modal" aria-label="Close" style="cursor:pointer;"><i class="fa fa-trash-o"></i> Delete</div>

<?php
}?>

</div>
</div>


</div>
</font>


<?php
}
//end table
echo "</div>";

}

// tell the user if no records found
else{
echo "<div class='alert alert-info mb-3' style='max-width:700px; margin:auto;'>Be the first to comment</div>";
}

?>



<div class="blank">
<div class="widget-area no-padding">
<div class="status-upload">

<form id='create-comment-form' action='#' method='post' style="margin-border-bottom:40px!important; max-width:700px;margin:auto">
<input type="hidden" name="userid" value="<?php echo $_SESSION['user_login'];?>">
<input type="hidden" name="post_id" value="<?php echo $_SESSION['postid'];?> ">
<textarea name='comment' class='form-control' required></textarea>


<label for="multiple_files" class="btn btn-secondary mt-2">
    































<i class="glyphicon glyphicon-picture"></i></label>
<input type="file" class="display-none" name="multiple_files" id="multiple_files" multiple />
<span id="text-sm text-red error_multiple_files"></span>

<button type="submit" class="btn btn-primary green" style="text-transform:none; margin-top:12px!important;">
<i class="glyphicon glyphicon-send"></i> &nbsp;Post</button>
<a href="index.php"> 
<div class="btn btn-primary has-icon" style="float:right; margin-right: 9px!important; margin-top:12px!important;">
<i class="glyphicon glyphicon-home"></i> &nbsp;Home
</div>
</a>
</form>
</div><!-- Status Upload  -->
</div><!-- Widget Area -->
</div>





<script>
//IMGAE UPLOAD SCRIPT ON COMMENT SECTION

$(document).ready(function(){

$('#multiple_files').change(function(){
var error_images = '';
var form_data = new FormData();
var files = $('#multiple_files')[0].files;
if(files.length > 10){
error_images += 'You can not select more than 10 files';
}
else{
for(var i=0; i<files.length; i++){
var name = document.getElementById("multiple_files").files[i].name;
var ext = name.split('.').pop().toLowerCase();
if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
error_images += 'Invalid Image';
}
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
var f = document.getElementById("multiple_files").files[i];
var fsize = f.size||f.fileSize;
if(fsize > 2000000){
error_images += 'file size is large';
}
else{
form_data.append("file[]", document.getElementById('multiple_files').files[i]);
form_data.append("post_id", <?php echo $postid;?>);
}
}
}
if(error_images == ''){
$.ajax({
url:"comment-upload.php",
method:"POST",
data: form_data,
contentType: false,
cache: false,
processData: false,
beforeSend:function(){
$('#error_multiple_files').html('<div id="loader-image"><div id="loader-wrapper"><div id="loader"></div></div></div>');
},   
success:function(data){
$('#error_multiple_files').html('');

// show loader image
$('#loader-image').show();

// reload the comment list
showProducts();
$("body").append(data);

}
});
}
else
{
$('#multiple_files').val('');
$('#error_multiple_files').html("<span style='padding:4px;'>"+error_images+"</span>");
return false;
}
});  

});
</script>

