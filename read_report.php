<?php


// include database and object files
include_once 'database.php';
include_once 'include/config.php';
include_once 'objects/report.php';
 
 session_start();
 $userid = $_SESSION["user_login"];


		
		
// instantiate database and report object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$report = new report($db);
 
//GET USER INFORMATION
		$query = "SELECT * FROM users WHERE userid=:userid";
		$query = $pdo-> prepare($query);
		$query-> bindParam(':userid', $userid, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		$posterpix = (!empty($data["profilepix"]) ? "profilepix/" . $data["profilepix"]: "images/user.png");
		
		
		$stmt = "SELECT * FROM report WHERE userid=:userid ORDER BY id DESC";
		$stmt = $pdo-> prepare($stmt);
		$stmt-> bindParam(':userid', $userid, PDO::PARAM_INT);
		$stmt->execute();
		
	
// initialize object
$report = new report($db);
 
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
 // start table
    echo "<div>";
  
 $row = $stmt->fetchAll();
     
	foreach($row as $row){
		
		$postDate = date("jS F, y", strtotime($row["date_received"]));
		$postTime = date("h:ia", strtotime($row["date_received"]));
		
     ?>
				
		
	 
			  <?php
                echo "<font style='text-align:center;'>";
                    //<li><?php echo $row['contact'];? > add the record id here, it is used for editing and deleting products
                    echo "<div class='contact-id display-none'>".$row['id']."</div>";
                    
				?>				
                   <div class="contact-history">
				    <img src="<?php echo $posterpix?>" class="user-img">
					
					<div class="contact-text">
					<ul>
					<li>
					<div class="title"><?php if(empty($row['report'])){echo '<span class="fa fa-image"></span> ';} 
					echo $row['title'] . ' <font color="#4d9161"><i class="fa fa-check"></i></font>';
					if(empty($row['report'])){echo '<div class="edit-btns edit-btn" style="float:right; color:#34474f;"><i class="fa fa-edit"></i> Add Text</div>';}
					else{echo '<div class="edit-btns edit-btn" style="float:right;color:#34474f;"><i class="fa fa-edit"></i> Edit</div>';}?>
					</div></li>
					<li><?php echo "<div style='font-size:13px;color:#8c8c8c; padding:4px; margin-bottom: 10px;'>".$postDate." At " .$postTime."</div>";?></li>
					</ul>
					</div>
					
					</div><br>
					<?php
					
					
                echo "</font>";

        }
     
}
 
// tell the user if no records found
else{
    echo "<div class='alert alert-info'>Send Your First Report </div>";
}


?>

<style>
.widget-area{
	padding:10px;
	float:right;
	border-radius:10px;
}
.blank{
	margin-bottom:50px;
}
.report-con{
	background:#f9f7f4;
	padding:20px;
	max-width:700px;
	margin:auto;
	border:1px solid #e1ddd5;
	border-radius:6px;
}
.post{
	color:#6f6e6e;
	border:1px solid #eaeaea;
	padding:6px;
	margin-bottom:15px;
	border-radius:6px;
}

</style>


	<?php
	
	
		//Get the reported postId using session from report page
		if(isset($_SESSION["report_post"])){
		//Session var for POST Report
		$post_id = $_SESSION["report_post"];

		//Get the Post Information using Post_id
		$stmt=$pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id");
		$stmt->bindParam("post_id",$post_id, PDO::PARAM_INT);
		$stmt->execute();
		$thepost=$stmt->fetch();
		
		//define the poster info and his post to be reported
		$post_text = $thepost["post"];
		$image1 = $thepost["image1"];
		$image2 = $thepost["image2"];
		$image3 = $thepost["image3"];
		$image4 = $thepost["image4"];
		$image5 = $thepost["image5"];
		$image6 = $thepost["image6"];
		$image7 = $thepost["image7"];
		$image8 = $thepost["image8"];
		$image9 = $thepost["image9"];
		$image10 = $thepost["image10"];
		$poster = $thepost["userid"];

		//Get the POST Author
		$stmt=$pdo->prepare("SELECT * FROM users WHERE userid=:poster");
		$stmt->bindParam("poster",$poster, PDO::PARAM_INT);
		$stmt->execute();
		$theposter=$stmt->fetch();
		}

		elseif(isset($_SESSION["report_comment"])){
		//Session var for COMMENT Report
		$com_id = $_SESSION["report_comment"];
		
		//Get the Comment Information using com_id
		$stmt=$pdo->prepare("SELECT * FROM postcomments WHERE com_id=:com_id");
		$stmt->bindParam("com_id",$com_id, PDO::PARAM_INT);
		$stmt->execute();
		$thecomment=$stmt->fetch();
		//define the comment info and his post to be reported
		$com_text = $thecomment["comment"];
		$com_img = $thecomment["attachment"];
		$commenter = $thecomment["userid"];
		
		//Get the COMMENT Author Name
		$query=$pdo->prepare("SELECT * FROM users WHERE userid=:commenter");
		$query->bindParam("commenter",$commenter, PDO::PARAM_INT);
		$query->execute();
		$thecommenter=$query->fetch();
		}
		?>
	
		<div class="report-con">
		<?php  
		//get the post if post session is set
		if(isset($_SESSION["report_post"])){
		if(!empty($post_text)){echo '<div class="post">'.$post_text.'</div>';} 
		
		//get the post images if any
		echo"<div style='display:flex'; overflow:auto>";
		if(!empty($image1)){echo '<center><img src="image-uploads/'.$image1.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image2)){echo '<center><img src="image-uploads/'.$image2.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image3)){echo '<center><img src="image-uploads/'.$image3.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image4)){echo '<center><img src="image-uploads/'.$image4.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image5)){echo '<center><img src="image-uploads/'.$image5.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image6)){echo '<center><img src="image-uploads/'.$image6.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image7)){echo '<center><img src="image-uploads/'.$image7.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image8)){echo '<center><img src="image-uploads/'.$image8.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image9)){echo '<center><img src="image-uploads/'.$image9.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		if(!empty($image10)){echo '<center><img src="image-uploads/'.$image10.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		echo"</div>";
		}
		
		//get the comment if comment session is set
		elseif(isset($_SESSION["report_comment"])){
		if(!empty($com_text)){echo '<div class="post">'.$com_text.'</div>';}
		
		//get the comment image if any
		if(!empty($com_img)){echo '<center><img src="image-uploads/'.$com_img.'" class="comment-img" style="max-width:500px;margin:auto;"></center>';}
		}
		?>
		</div>

	
						<div class="blank">
    						<div class="widget-area no-padding">
								<div class="status-upload">
									<form id='create-report-form' action='#' method='post' style="margin-border-bottom:40px!important;">
									<input type="hidden" name="userid" value="<?php echo $_SESSION['user_login'];?>">
									
									<?php //the reported post id and comment id
									if(isset($theposter["name"])){echo '<input type="hidden" name="post_comment_id" value="'.$post_id.'">';}else
									if(isset($thecommenter["name"])){echo '<input type="hidden" name="post_comment_id" value="'.$com_id.'">';}
									?>
									
									<?php //the person who is reported, he's id
									if(isset($theposter["name"])){echo '<input type="hidden" name="victim_reported" value="'.$poster.'">';}else
									if(isset($thecommenter["name"])){echo '<input type="hidden" name="victim_reported" value="'.$commenter.'">';}
									?>
									
									<input type="hidden" name="reporting_from" 
									value="<?php
									//for post
									if(isset($theposter["name"])){echo "Post_Page";}else
									//for comment
									if(isset($thecommenter["name"])){echo "Comment_Page";}else{echo "Report_Page";}
									?>">
									
									<!--Preview but won't submit due to disabled-->
									<input type="text" class="inputmodify" autofocus="" placeholder="Your Report Title" name="title" required  
									value="<?php 
									//for post
									if(isset($theposter["name"]) && $poster==$userid){echo "Reporting - Your Post";}
									else if(isset($theposter["name"])){echo "Reporting - ".$theposter["name"]."'s Post";}
									//for comment
									if(isset($thecommenter["name"]) && $commenter==$userid){echo "Reporting - Your Comment";}
									else if(isset($thecommenter["name"])){echo "Reporting - ".$thecommenter["name"]."'s Comment";}?>" 
									<?php 
									//for post
									if(isset($theposter["name"])){echo "disabled style='background:#f7f7f7;color:#a2a2a2;'";}else
									if(isset($thecommenter["name"])){echo "disabled style='background:#f7f7f7;color:#a2a2a2;'";}?>>
									
									<!--Submit this instead if session for report is set-->
									<?php if(isset($post_id)){ ?>
									<input type="hidden" name="title" required  
									value="<?php 
									//for post
									if(isset($theposter["name"]) && $poster==$userid){echo "Reported - Your Post";}
									else if(isset($theposter["name"])){echo "Reported - ".$theposter["name"]."'s Post";}
									//for comment
									if(isset($thecommenter["name"]) && $commenter==$userid){echo "Reported - Your Comment";}
									else if(isset($thecommenter["name"])){echo "Reported - ".$thecommenter["name"]."'s Comment";}?>">
									<?php }?>
										
										

										
			
									<br><br>
									<textarea name='report' class='inputmodify' required 
									placeholder="<?php if(isset($_SESSION["report_post"])){echo "What is wrong with this?";}else{echo "Be more descriptive, upload an image if necessary!";}?>"></textarea>
										<ul class="edit-btn" style="padding:8px; margin-top:8px">
											<li>Image</li>
											<li class="upmulti"><a title="Upload Image" data-toggle="tooltip" data-placement="bottom" data-original-title="Image">
											<i class="glyphicon glyphicon-picture"></i></a>
											    <input type="file" name="multiple_files" id="multiple_files" multiple />
												<span id="error_multiple_files"></span>
											</li>
										</ul>
										<button type="submit" class="btn btn-primary green" style="text-transform:none">Post <i style="vertical-align:bottom" class="glyphicon glyphicon-send"></i> 
										</button>
										<a href="welcome.php"> 
										<span class="btn btn-primary green" style="text-transform:none; float:right; margin-right: 9px; margin-top: 9px; padding: 6px 15px;}">Home&nbsp;
										<i style="vertical-align:bottom" class="glyphicon glyphicon-home"></i> 
										</span>
										</a>
										
									</form>
								</div><!-- Status Upload  -->
							</div><!-- Widget Area -->
							</div>
						
						



<script>
//IMGAE UPLOAD SCRIPT ON report PAGE

$(document).ready(function(){
 load_image_data();
 function load_image_data()
 {
  $.ajax({
   //url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#image_table').html(data);
   }
  });
 } 
 $('#multiple_files').change(function(){
  var error_images = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;
  if(files.length > 10)
  {
   error_images += 'You can not select more than 10 files';
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
      error_images += 'Invalid Image';
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000)
    {
    error_images += 'file size is large';
    }
    else
    {
     form_data.append("file[]", document.getElementById('multiple_files').files[i]);
    }
   }
  }
  if(error_images == '')
  {
   $.ajax({
    url:"upload_image_report.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
      $('#error_multiple_files').html('<div id="loader-image"><div id="loader-wrapper"><div id="loader"></div></div></div>');
    },   
    success:function(data)
    {
     $('#error_multiple_files').html('');
     load_image_data();
	  // show loader image
                $('#loader-image').show();
                 
                // reload the comment list
                showReport();
				$('#img_success').show();
	 
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


	