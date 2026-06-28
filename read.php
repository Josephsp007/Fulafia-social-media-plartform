<?php

include_once 'include/config.php';
include_once 'include/timeago.php';
 
 session_start();
 $userid = $_SESSION["user_login"];


		// GET LOGIN USER
		$sql=$pdo->prepare( "SELECT * from users where userid = (:userid)");
		$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$sql->execute();
		$users=$sql->fetch();
		$userimage = (!empty($users["profilepix"]) ? "images/profilepix/".$users["profilepix"]: "images/site/user.png");
 

 
 
		if(isset($_POST["limit"], $_POST["start"])){
		$stmt = $pdo->prepare("SELECT users.*, posts.* FROM users, posts WHERE users.userid=posts.userid ORDER BY 
                 post_id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."");
		$stmt->execute();
		$num = $stmt->rowCount();
		$row = $stmt->fetchAll();
 
		if($num >0){
 
		// start table
  
		foreach($row as $row){
		
		$posterpix = (!empty($row["profilepix"]) ? "images/profilepix/" . $row["profilepix"]: "images/site/user.png");

	//SET $ago to created column and call function from timeago.php	
	$ago = $row["created"];
	$postTime = to_time_ago($ago);
  
	?>
			 
			
			<div class="all-post" style="margin-bottom:30px;">
		
			<?php 

		//SETTING THE $_GET POST LINK VALUE TO SEND TO URL AND ALSO TO EMBED IN "COPY LINK" OPTION IN DROPDOWN 
		//get a specific POST ID based on post clicked
		$post_id = $row["post_id"];
		
		$sql=$pdo->prepare( "SELECT users.name,users.userid,posts.post_id, posts.userid FROM 
							users,posts WHERE users.userid=posts.userid AND post_id =:post_id");
		$sql->bindParam(':post_id', $post_id, PDO::PARAM_STR);
		$sql->execute();
		$getValue=$sql->fetch();
		$Poster = str_replace(' ', '-', 'Author='.$getValue["name"]);
			
		?>
		
		<br>
		<!--POST CONTAINER-->
		<div class="post-con scroll_<?php echo intval($row["post_id"]);?>" style="margin-top:-13px;max-width:600px">
		
		<div class="poster-placeholder">
		<?php 
		echo'
		<div>
			<div class="author-avatar">
			<a href="profile.php?profileid='.base64_encode($row['userid']).'">
			<img alt="'.$row['name'].'" src="'.$posterpix.'" class="avatar" width="80" height="100" style="border:3px solid #275863"></a>
			<svg class="half-circle" width="80px" height="80px" style="fill: #275863!important;z-index:-1;">
			<use xlink:href="#half-circle"></use>
			</svg>
			</div></div>';
			
			echo "<span style='text-transform:uppercase;font-size:15px;margin-left:75px;font-weight:700;'>".$row["name"]."</span><br>
			<div style='font-size:12px;color:#b4cdd5;margin-left:75px;'><b>".$postTime."</b></div>
			";
		
		?>
		</div> 
		
		
		<!--post dropdown-->
		
		<div class = "btn-group" style="position:none; display:block; z-index:300">
		<div class="comment-options " data-toggle = "dropdown"><i class="glyphicon glyphicon-option-horizontal" style="position:absolute; right:10px; margin-top:-35px"></i></div> 
		
		<div class="dropdown-menu dropdown-menu-right" style="width:220px;padding:0; margin-top:-8px!important;">
		
		
		<?php if($userid == $row['userid']){?>
		<div class="edit-btn dropdown-item" style="cursor:pointer; padding:10px;" id="<?php echo intval($row["post_id"]);?>">
		<i class="fa fa-edit" ></i>&nbsp; 
		<?php if(!empty($row['image1'])&& empty($row['post'])){echo "Add text to image";}else{echo "Edit post";} ?>
		</div> <div class="dropdown-divider"></div> <?php }?>
		
		<a href="#" class="dropdown-item" style="padding:10px;"><i class="glyphicon glyphicon-share-alt"></i> &nbsp;Share post</a> 
		<div class="dropdown-divider"></div>
		
		<a href="#" class="dropdown-item" style="padding:10px;"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;Save post</a> 
		<div class="dropdown-divider"></div>
		
		<a href="report.php?report_post=<?php echo intval($row['post_id']);?>" class="dropdown-item" 
		style="cursor:pointer; padding:10px;">
		<i class="fas fa-exclamation-circle"></i> &nbsp;Report post</a>
		<div class="dropdown-divider"></div>
		 
		<?php if($userid == $row['userid']){?>
		<div class="delete dropdown-item" id="del_<?php echo intval($row["post_id"]);?>" style="cursor:pointer; border:none;padding:10px;"><i class="fa fa-trash-o"></i> &nbsp;Delete</div>
		<?php }?>
		</div></div>
		
		
		<!--/ post dropdown-->
		
		
		
		
		
		
		
			 
			 
			 
		<div class='posts'> 
		
		<div class='<?php if(!empty($row['post'])){echo "post-text"; } ?>' id='postText_<?php echo intval($row['post_id']); ?>'>
		<?php echo $row['post']; ?> </div>
		
		
		<?php 
		$img1 = $row["image1"];
		$img2 = $row["image2"];
		$img3 = $row["image3"];
		$img4 = $row["image4"];
		$img5 = $row["image5"];
		$img6 = $row["image6"];
		$img7 = $row["image7"];
		$img8 = $row["image8"];
		$img9 = $row["image9"];
		$img10 = $row["image10"];
		 ?>
		 
		 
	

			
		<?php 
		//if image is not empty then continue
		if(!empty($img1) || !empty($img2) || !empty($img3) || !empty($img4) || !empty($img5) || !empty($img6) || !empty($img7) || !empty($img8) || !empty($img9) || !empty($img10)){?>
		
		<section align="center" class="post-imgs image_section_<?php echo intval($row["post_id"])?>" id="">
		
		<?php 
		//set the div grid number depending on number of img uploaded
		
		if(!empty($row["image1"]) && empty($row["image2"]) && empty($row["image3"]) && empty($row["image4"]) && empty($row["image5"]) && empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
			//1 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-1">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && empty($row["image3"]) && empty($row["image4"]) && empty($row["image5"]) && empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//2 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-2">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && empty($row["image4"]) && empty($row["image5"]) && empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//3 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-3">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && empty($row["image5"]) && empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//4 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-4">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//5 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-5">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && !empty($row["image6"]) && empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//6 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-6">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && !empty($row["image6"]) && !empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//	VIEW 6 GRIDS IF IMAGE ISSET 7 UPWARD
			echo  '<div id="gallery" class="imgs-grid imgs-grid-6">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && !empty($row["image6"]) && !empty($row["image7"]) && !empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"])){
				//7 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-6">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && !empty($row["image6"]) && !empty($row["image7"]) && !empty($row["image8"]) && !empty($row["image9"]) && empty($row["image10"])){
				//7 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-6">';
		}
		else if(!empty($row["image1"]) && !empty($row["image2"]) && !empty($row["image3"]) && !empty($row["image4"]) && !empty($row["image5"]) && !empty($row["image6"]) && !empty($row["image7"]) && !empty($row["image8"]) && !empty($row["image9"]) && !empty($row["image10"])){
				//7 GRID
			echo  '<div id="gallery" class="imgs-grid imgs-grid-6">';
		}
		?>
		
		
		<!--show individual images if its not empty-->
		<?php if(!empty($row["image1"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<img src="images/post-images/<?php echo $row["image1"];?>" class="upimage" alt="post image" title="">
		</div></div>
		<?php }?>
		
		
		<?php if(!empty($row["image2"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<a href="images/post-images/<?php echo $row["image2"];?>">
		<img src="images/post-images/<?php echo $row["image2"];?>" class="upimage" alt="post image" title=""></a>
		</div></div>
		<?php }?>
		
		
		<?php if(!empty($row["image3"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<a href="images/post-images/<?php echo $row["image3"];?>">
		<img src="images/post-images/<?php echo $row["image3"];?>" class="upimage" alt="post image" title=""></a>
		</div></div>
		<?php }?>
		
		
		<?php if(!empty($row["image4"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<a href="images/post-images/<?php echo $row["image4"];?>">
		<img src="images/post-images/<?php echo $row["image4"];?>" class="upimage" alt="post image" title=""></a>
		</div></div>
		<?php }?>
		
		
		<?php if(!empty($row["image5"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<a href="images/post-images/<?php echo $row["image5"];?>">
		<img src="images/post-images/<?php echo $row["image5"];?>" class="upimage" alt="post image" title=""></a>
		</div></div>
		<?php }?>
		
		<?php if(!empty($row["image6"])){?>
		<div class="imgs-grid-image">
		<div class="image-wrap">
		<a href="images/post-images/<?php echo $row["image6"];?>">
		<img src="images/post-images/<?php echo $row["image6"];?>" class="upimage" alt="post image" title=""></a>
		
		
		<!--Check if image 7 and upward are isset and output inner overlay image remainant counter number over the 6th image-->
		<?php if(!empty($row["image7"]) && empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"]) ){ 
				echo '<div class="view-all"><span class="view-all-cover"></span><span class="view-all-text">+ 1</span></div>';}
			else if(!empty($row["image7"]) && !empty($row["image8"]) && empty($row["image9"]) && empty($row["image10"]) ){ 
				echo '<div class="view-all"><span class="view-all-cover"></span><span class="view-all-text">+ 2</span></div>';}
			else if(!empty($row["image7"]) && !empty($row["image8"]) && !empty($row["image9"]) && empty($row["image10"]) ){ 
				echo '<div class="view-all"><span class="view-all-cover"></span><span class="view-all-text">+ 3</span></div>';}
			else if(!empty($row["image7"]) && !empty($row["image8"]) && !empty($row["image9"]) && !empty($row["image10"]) ){ 
				echo '<div class="view-all"><span class="view-all-cover"></span><span class="view-all-text">+ 4</span></div>';}
		?>
		</div></div>
		
		
		
		</div><!--posts div-->
		
		<?php } ?> <!--End if image6-->
		
		</section>
		<?php }?>
		
		
	</div><!--/posts-->
	
	
		
		
				<style>
				.reduce{
				height:0px;
				overflow:hidden;
				}
				</style>
				
					
				<!--Edit form-->
				<div class="blank blank_<?php echo intval($row['post_id']);?> reduce">
				<p><br>
				<textarea class='form-control' style="height:120px!important" id="textarea_<?php echo intval($row['post_id']);?>" required><?php echo htmlspecialchars($row['post'], ENT_QUOTES); ?></textarea>
				
				<center>
				<button class="btn btn-primary btn-lg updateBtn" style="width:45%;font-size:15px">Update post</button>
				<button class="btn btn-default btn-lg close_<?php echo intval($row["post_id"]);?>" style="width:45%; font-size:15px" id="">Cancel</button>
				</center><br>
				<div class="dropdown-divider"></div>
				
				</div>
				<!-- /Update -->
			
			
		
		
		
		
		
		
		<!--Vote ICon-->
	<?php 
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
		
		
		?>
		
		
		
				<div id="label_<?php echo intval($post_id);?>" style="margin:5px 20px 5px;font-size:14px;">
				
				<?php 
				if($countLikes == 1 AND $count>0){
					echo htmlspecialchars($row["name"]);
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
				
				?>
				</div>
		
	
		<div class="react-flex">
		

				<?php if($count>0){$Rtype = $getReact["reactType"];} //coloring react background even if page refreshed
				//set colors
				$thumb="#e8e8ff";
				$haha="#fff7d8";
				$love="#ffdddd";
				$wow="#fff7d8";
				$angry="#ffdddd";
				$sad="#fff7d8";
				?>
				
				<div class="react react-con" id="react_<?php echo intval($row["post_id"]);?>" 
				style='background:<?php if($count>0 && $Rtype=="haha"){echo $haha;}elseif($count>0 && $Rtype=="thumb"){echo $thumb;}elseif($count>0 && $Rtype=="love"){echo $love;}elseif($count>0 && $Rtype=="sad"){echo $sad;}elseif($count>0 && $Rtype=="angry"){echo $angry;}elseif($count>0 && $Rtype=="wow"){echo $wow;}?>!important;'>
		
				<center>
				<?php if($count>0){
				echo "<img src='images/react/".$getReact['reactType'].".png' class='reacted'>";
				}else{
					echo '<i class="glyphicon glyphicon-thumbs-up" style="font-size:18px;"></i>';
				}
				?>
				</center>
				</div>
				
				
				<div class="all-reaction react_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/thumb.gif" class="reaction" id="thumb_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/love.gif" class="reaction" id="love_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/haha.gif" class="reaction" id="haha_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/wow.gif" class="reaction" id="wow_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/sad.gif" class="reaction" id="sad_<?php echo intval($row["post_id"]);?>">
				<img src="images/react/angry.gif" class="reaction" id="angry_<?php echo intval($row["post_id"]);?>">
				</div>
				
				
		
				<?php	
				//if user commented count
				$sql =$pdo->prepare("SELECT * FROM postcomments WHERE post_id =:post_id AND userid=:userid");
				$sql->bindParam(':post_id', $post_id, PDO::PARAM_STR);
				$sql->bindParam(':userid', $userid, PDO::PARAM_STR);
				$sql->execute();
				
				//get comment Row count - number of comments
				$query = $pdo->prepare("SELECT COUNT(*) AS count FROM postcomments WHERE post_id =:post_id");
				$query->bindParam(':post_id', $post_id, PDO::PARAM_STR);
				$query->execute();
				$comCount = $query->fetch();
				?>
		
				
					<a class="react-con" href='comment.php?postid=<?php echo intval($getValue['post_id'])."&".$Poster; ?>' style="inherit">
					<div>
					<i class='far fa-comment'></i>
					<span id="comCount_<?php echo intval($post_id);?>"><?php if($comCount['count']>0){echo intval($comCount['count']);}?> </span> 
					</div></a>
				
					<div class="react-con"><i class='glyphicon glyphicon-share-alt'></i></div>
				  
					
				</div><!--flex-->
					
					
					
					<!--comment-->
					
				<div class="input-group" style="margin-top:8px;">
                <span class="input-group-addon" style="padding:0; border-top-left-radius:10px; border-bottom-left-radius:10px;">
				<img src="<?php echo $userimage;?>" style="width:47px;height:48px; border-top-left-radius:10px; border-bottom-left-radius:10px;" class=""></span>
				
                <input type="text" name="comment" id="comment_<?php echo intval($post_id);?>" class="form-control" 
				placeholder="Write a comment..." style="height:48px!important;border-right:none;">
				
				<label id="lab_<?php echo intval($post_id);?>" for="comfile_<?php echo intval($post_id);?>"  class="btn btn-default input-group-addon comfile" style="margin-left:-2px;padding:5px;width:50px; border-left:none;border-radius:0px; background:transparent"><i class="material-icons">content_copy</i>
				<input type='file' name='comfile' class='display-none' id='comfile_<?php echo intval($post_id);?>'
				multiple="multiple" accept="image/*" />
				</label>
			  
			  
				<span id="subComment_<?php echo intval($post_id);?>" class="btn btn-default input-group-addon post-comment" 
				style="margin-left:-6px;border-radius: 0px 10px 10px 0px;height:48px;">
				<i class="fa fa-send" style="vertical-align: bottom;"></i></span>
              
			  </div>
					
					
					</div> <!--/Post Con-->
					
					</div> <!--/Vote ICon-->	
					

				<?php
				   
				}
			}
			
			}

 
			?>





<!-- Post vote script -->
<script src="js/post-like-script.js" type="text/javascript"></script>


<script>
$(document).ready(function(){	

	//Toater alert
	var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });
	

	
	//Delete Post
	$(".delete").click(function(){
		
		//get post container
		let postCon = this;
     
		//get post ID
        let ids = this.id;
		let split = ids.split("_");
		let postId = split[1];
		
		
	$.confirm({
	closeIcon: true,
    closeIconClass: 'fa fa-close',
    icon: 'fa fa-question-circle',
			//type:'red',
			title: 'Confirm',
			content:'This Post Will Be Deleted?',
			autoClose: 'cancel|8000',
    theme: 'supervan', // 'material', 'bootstrap'
	
    buttons: {
        confirm: {
			text: 'Delete',
            action: function() {
		
        // trigger the delete file
        $.post("delete-post.php", { postId: postId }).done(function(data){
               
						$(postCon).closest('.all-post').fadeOut(700,function(){
                            $(this).remove();
                        });
						
		Toast.fire({
        icon: 'success',
        title: 'Post deleted successfully'
		})
			
            });
			
			}
        },
		
		cancel: function () {
        }
		

    }
});
return defer.promise();
});




		
		
		
		
		
		
		
	//if edit post btn was clicked
	$('.edit-btn').off().click(function(){
		var updateId = this.id;
		
		$(".blank_"+updateId).animate({"height":"250px"},800);			//show update form
		
		//focus cursor to textarea
		$("#textarea_"+updateId).focus();							
		$("#textarea_"+updateId).val($("#textarea_"+updateId).val() + ' ');	
		
		$("#"+updateId).fadeOut(); //remove edit btn from drop menu
		
		$(".close_"+updateId).click(function(){	//hide form if close btn was clicked
			$(".blank_"+updateId).animate({"height":"0px"},800);
			
		$("#"+updateId).fadeIn();
		
		});
		
			//srcoll down to textarea
			$("html, body").animate({
				scrollTop: $("#postText_"+updateId).offset().top
			}, 800);
		
		
		//If Update Btn Was Clicked
	$('.updateBtn').click(function(){

		
			
	$('.updateBtn').prop("disabled",true);
	let postText = $("#textarea_"+updateId).val();

	$.post('post-script.php', {updateId:updateId, postText:postText}).done(function(data){
			
		$("#postText_"+updateId).html(data).addClass("post-text");//embed the textarea text on the post
		
		$('.updateBtn').prop("disabled",false);
			 
		$("#"+updateId).fadeIn().html("<i class='fa fa-edit'></i> &nbsp;Edit post");	//change edit text 
		$(".blank_"+updateId).animate({"height":"0px"},800);					//hide update form
		
			//srcoll top to post
			$("html, body").animate({
				scrollTop: $(".scroll_"+updateId).offset().top
			}, 700);
			
		
	});
	});
	
	});	
	
	
	
	
	
	//process submit comment
		
// will run if comment form was submitted

$(".post-comment").off().click(function(e){
	e.preventDefault();
 
 //split submit btn id
	let ids = this.id;
	let spliter = ids.split("_");
	let post_id = spliter[1];
	
	let comment = $("#comment_"+post_id).val().trim();
	let userid = <?php echo $userid?>;
	
	if(comment !==""){
    // show a loader img
    $('#loader-image').show();
    // post the data from the form
    $.post("create_comment.php", {comment:comment, post_id:post_id, userid:userid}).done(function(data) {
	
	//append count to span
    $('#comCount_' + post_id).html(data);
    $('#comCount_' + post_id).closest(".react-con").css({"background":"#e7f3ff", "border-color":"#b9d1e7"});
	
	// hide a loader img
    $('#loader-image').hide();
	
	
	console.log(data);
	
	//clear comment Input
	$("#comment_"+post_id).val('');
	
        });
		
	}else{
		return false;
	}
            
});
	
	
	




//UPLOADING NEW Comment IMAGE from index page

 $('.comfile').off().change(function(){
	 
	 //split submit btn id
	let ids = this.id;
	let spliter = ids.split("_");
	let comId = spliter[1];
	
	
  var form_data = new FormData();
  var files = $('#comfile_'+comId)[0].files;
  if(files.length > 5)
  {

	//Toast error
    Toast.fire({
       icon: 'warning',
       title: 'You can upload only 5 photos at once'
	});
	
	return false;
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById('comfile_'+comId).files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {

	//Toast error
    Toast.fire({
       icon: 'error',
       title: 'Please select a valid image file'
	});
	
	return false;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById('comfile_'+comId).files[i]);
    var f = document.getElementById('comfile_'+comId).files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 9194304) //9mb
    {
      
	//Toast error
    Toast.fire({
       icon: 'warning',
       title: 'Image is too large. Allowed max size is 9MB'
	})
return false;
    }
    else
    {
     form_data.append("comfile[]", document.getElementById('comfile_'+comId).files[i]);
    }
   }
   

	if(files.length > 0){
   $.ajax({
    url:"comment-upload.php?post_id="+comId,
    method:"POST", 
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){$("#loader-image").show();},   
    success:function(data)
    {
		//hide Loader
		$("#loader-image").hide();
		
		//count & change comment container background
		$("#comCount_"+comId).html(data);
		$('#comCount_' + comId).closest(".react-con").css({"background":"#e7f3ff", "border-color":"#b9d1e7"});
		
    }
   });
	}

}//Image Length
  
 });












	
});
		
	


</script>



