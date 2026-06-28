<?php


// include database and object files
include_once 'database.php';
include_once 'include/config.php';
include_once 'objects/contact.php';
include_once 'include/timeago.php';
 
 session_start();
 $userid = $_SESSION["user_login"];


		
		
// instantiate database and contact object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$contact = new contact($db);
 
//GET USER INFORMATION
		$query = "SELECT * FROM users WHERE userid=:userid";
		$query = $pdo-> prepare($query);
		$query-> bindParam(':userid', $userid, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		$posterpix = (!empty($data["profilepix"]) ? "profilepix/" . $data["profilepix"]: "images/user.png");
		
		
		$stmt = "SELECT * FROM feedback WHERE userid=:userid ORDER BY id DESC";
		$stmt = $pdo-> prepare($stmt);
		$stmt-> bindParam(':userid', $userid, PDO::PARAM_INT);
		$stmt->execute();
		
	
// initialize object
$contact = new contact($db);
 
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
 // start table
    echo "<div>";
  
 $row = $stmt->fetchAll();
     
	foreach($row as $row){
		
$ago = $row["contacted"];
$postTime = to_time_ago($ago);
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
					<div class="title"><?php if(empty($row['contact'])){echo '<span class="fa fa-image"></span> ';} 
					echo $row['title'] . ' <font color="#4d9161"><i class="fa fa-check"></i></font>';?>
					<div class="delete-btn dels"><i class="glyphicon glyphicon-trash"></i></div></div></li>
					<li><?php echo "<div style='font-size:13px;color:#8c8c8c; padding:4px;'>".$postTime."</div>";?></li>
					</ul>
					</div>
					
					</div><br>
					<?php
					
					
                echo "</font>";

        }
     
}
 
// tell the user if no records found
else{
    echo "<div class='alert alert-info'>No Contact History Found</div>";
}
 
?>

<style>
.widget-area{
	float:right;
	border-radius:10px;
}
.blank{
	margin-bottom:50px;
}
</style>

<?php
if(isset($success)){
	echo $success;
}
?>
						<div class="blank">
    						<div class="widget-area no-padding">
								<div class="status-upload">
									<form id='create-contact-form' action='#' method='post' style="margin-border-bottom:40px!important;">
									<input type="hidden" name="userid" value="<?php echo $_SESSION['user_login'];?>">
										<input type="text" class="inputmodify" autofocus="" name="title" placeholder="Enter a title" required>
										<br><br>
										<textarea name='contact' class='inputmodify' required placeholder="Tell us your experience and suggestion.."></textarea>
										<ul class="edits" style="padding:8px; margin-top:8px">
											<li>Image</li>
											<li class="upmulti"><a title="Upload Image" data-toggle="tooltip" data-placement="bottom" data-original-title="Image">
											<i class="glyphicon glyphicon-picture"></i></a>
											    <input type="file" name="multiple_files" id="multiple_files" multiple />
												<span id="error_multiple_files"></span>
											</li>
										</ul>
										<button type="submit" class="btn btn-primary green" style="text-transform:none">Post &nbsp;<i style="vertical-align:bottom" class="glyphicon glyphicon-send"></i> </button>
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
//IMGAE UPLOAD SCRIPT ON CONTACT PAGE

$(document).ready(function(){
 load_image_data();
 function load_image_data()
 {
  $.ajax({
   url:"fetch.php",
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
    error_images += 'Image size is too large';
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
    url:"upload_image_contact.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
      $('#error_multiple_files').html('<div id="loader-image"><div id="loader-wrapper"><div id="loader"></div></div></div');
    },   
    success:function(data)
    {
     $('#error_multiple_files').html('');
     load_image_data();
	  // show loader image
                $('#loader-image').show();
                 
                // reload the comment list
                showComment();
				
				//success msg
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


	