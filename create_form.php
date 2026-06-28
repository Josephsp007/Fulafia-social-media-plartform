<?php
include("include/config.php");


session_start();
$userid = $_SESSION["user_login"];


$sql = "SELECT * from users where userid=:userid";
$query = $pdo -> prepare($sql);
$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
$query->execute();
$row=$query->fetch();
$userimage = (!empty($row["profilepix"]) ? "images/profilepix/".$row["profilepix"]: "images/site/user.png");

$sql = "SELECT location,country from userdata where userid=:userid";
$query = $pdo -> prepare($sql);
$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
$query->execute();
$userLocation=$query->fetch();
?>


<style>


.listing{
margin:2px;
height:85px;
width:90px;
border-radius:4px;
opacity:.8
}
.listing:hover{
opacity:1;
}
.clos{
background: #fbfbfbe8;
border-radius: 50%;
color: #222;
padding: 4px;
text-align: center;
right: 40px;
top: -19px;
font-size: 20px;
position: relative;
z-index: 10;
width: 28px;
}


@media(min-width:1150px){
.create-post-form{
min-width:500px;
}
}

.create-post-form{
max-width:500px;
margin:auto;
}

.select2-container--default .select2-selection--single{
display:none!important;
}
.select2-container--bootstrap4 .select2-selection--single {
height: 50px!important;
padding: 5px;
}
.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
color: #939ba2!important;
font-size: 20px;
line-height: calc(1.8em)!important;
}


.cancelAll{
padding:8px;
border-bottom:1px solid #e9ecef;
}
.cancelAll:hover, .optList div:hover,.optList label:hover,.draft-btn:hover{
background:#ededed;
color:#444!important;
border-radius:1px;
cursor:pointer;
}



.bulk-img{
border:1px solid #ced4da;
border-radius: 5px;
margin:10px 0px 10px 0px;
}
.upload-btn{
background: #eff2f9;
padding: 15px;
cursor:pointer;
border-top: 1px solid #dbdfe7;
color: rgb(130 138 149);
height: 90px;
margin-top: 5px!important;
width: 100%;
text-align: center;
border-bottom-right-radius: 5px;
border-bottom-left-radius: 5px;
transition:0.5s;
}

.upload-btn:hover{
background: #dae1f1;
padding: 10px;
color: rgb(104 112 124);
transition:0.5s;
}

/*DARK MODE*/
.dark-mode .cancelAll, .dark-mode .dropdown-divider{
border-color: rgb(0 0 0 / 26%)!important;
}

.dark-mode .cancelAll{
color: #a9a9a9;
}

/*normal gray*/
.dark-mode #h4,.dark-mode .info{
color:#cccdcf!important;
}


/*gray border and dark bg*/
.dark-mode .upload-btn{
color:#cccdcf;
background:#292e34;
border:1px solid #4f5962;
}

.dark-mode .bulk-img, .dark-mode .select2-container--bootstrap4 .select2-selection {
border-color:#6c757d;
}

/*Mild Gray Backround*/
.dark-mode .select2-container--bootstrap4 .select2-selection{
background-color: #343a40;
}
</style>










<script>
/*leave page warning

document.querySelector(".green").addEventListener("click", function(){
window.btn_clicked = true;
});
window.onbeforeunload = function(){
if(!window.btn_clicked){
return "Unsaved Data";
}
};
*/
</script>






				
				

	
	<div class="row scroll">

	<div class="col-md-12">

	<div class="card">
	<div class="card-header with-border">
	
	<div style="color:#869099;margin:8px;">Post on eBlaze</div>
	<h5 style="font-weight:700!important">
	<i style="color:#6792bd;" class="material-icons">store</i>&nbsp; Create A Post
	</h5>
	
	<div class="user-panel mt-3 mb-3 d-flex">
	<a href="../profile.php?profileid=MQ==">
	<img class="img-circle" src="<?php echo $userimage;?>" style="width:55px; height:55px;border:2px solid #bbb;">
	</a>
	<div class="info" style="margin-left:3px;"><b><?php echo htmlspecialchars($row["name"]);?></b><br>
	<div style="color:#869099;font-size:14px;white-space:normal">Posts on eBlaze is · <i class="glyphicon glyphicon-globe"></i> Public</div>
	</div>
	</div>
	</div>
	
	
	

	<div class="cancelAll" style="font-weight:600;font-size:18px;border-bottom:1px solid #e9ecef;padding:10px 50px;">
	&nbsp; <span class="material-icons">backspace </span>&nbsp; Cancel &nbsp;</div>
	
	
	<div class="create-post-form" style="padding:15px;">
	
	<div id="errs" align="center" style="color:#eb1111;margin:10px 5px;font-weight:400;"></div>
	
	<!--Photo con for new Post-->
	<div class="bulk-img" id="newFile">
	
	<!--Uploaded Photo-->
	<div id="uploaded" style="margin-top:8px">
	
<?php
//temp uploaded images
$sql=$pdo->prepare("SELECT * FROM temp_attach WHERE userid=:userid");
$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
$sql->execute();
$postpix=$sql->fetchAll();

if($sql->rowCount() >0){
	echo "<div id='uploads' style='display:flex;flex-wrap:wrap;justify-content:center;padding:10px;'>";
	foreach($postpix as $postpixs){
	echo "<div></div>
	<span style='margin-right:-30px' class='postPixList_".$postpixs['temp_id']."'>
	<img src='images/post-images/".$postpixs['images']."' class='listing' alt='Ads Image'>
	<i class='fas fa-close clos postPixList_".$postpixs['temp_id']."' id='".$postpixs['temp_id']."'></i></span>";
	}
	echo "</div>";
	
}
?>		
	
	</div> 
	
	
	
	<div align="center" style="color:#869099;font-size:14px;margin-top:15px;"><b>Photos · <span id="countPix">0</span>/10</b> 
	<br>You can upload upto 10 photos</div>
	
	<label for="image" class="upload-btn" data-toggle="tooltip" style="margin:0px">
	<span class="material-icons" style="font-size:30px;margin-top:-5px">add_to_photos</span>
	<br><small align="center"><b>Add photos</b></small>
	</label>
	<input type='file' name='image' class='adsimage display-none' id='image' multiple="multiple" accept="image/*" />
	</div>
	

	
	<div class="form-group">
	<textarea class="form-control" rows="3" maxlength="400" name="post" id="postValues" placeholder="Your post text . . ." 
	style="margin-top: 0px; margin-bottom: 0px; height: 91px;"></textarea>
	</div>
	
	<i class="material-icons" style="color:#f13636">location_on</i> 
	<?php if(!empty($userLocation["location"])){echo htmlspecialchars($userLocation["location"]);}
			if(!empty($userLocation["country"])){echo htmlspecialchars($userLocation["country"]);}
			if(!empty($userLocation["country"]) AND empty($userLocation["country"])){echo "Post Location";}
	?>
	<div class="input-group form-group">
	<div class="input-group-prepend">
	<span class="input-group-text"><i class="material-icons">location_on</i></span>
	</div>
	<input type="text" value="<?php if(!empty($userLocation["country"])){echo htmlspecialchars($userLocation["country"]);}?>" class="form-control" name="location" id="location" placeholder="Location" style="padding:25px;font-size:20px;"
	value="<?php if(!empty($userLocation["location"])){echo htmlspecialchars($userLocation["location"]);}?>">
	</div>
	
	
	<br>
	<button id="publish" class="btn btn-primary btn-lg btn-block" 
	style="background-color:#316896;margin-top:5px;border-color:#446a8b;">Publish</button>
	
	</div>
	
	

	
		<br>
	<div class="cancelAll" style="font-weight:600;font-size:18px;border-top:1px solid #e9ecef; padding: 10px 60px;">
	<span class="material-icons">backspace </span>&nbsp; Cancel</div>
	
	
	
	
	
	
	
	
	
	</div><!--/Card-->
	</div>
	<!-- /.col -->
	</div>
	<!-- /body row -->
				
				
				
				
				
				
				
				
				
				







<?php
		//Check Autosaved image from temp_attach
		$query = $pdo->prepare("SELECT COUNT(*) AS count FROM temp_attach WHERE userid=:userid");
		$query->bindParam(":userid",$userid, PDO::PARAM_STR);
		$query->execute();
		$count= $query->fetch();
		if($count["count"]>0 AND !isset($_GET["img"])){
		
?>			 

	
<script>
$(document).ready(function() {

//Toaster
var Toast = Swal.mixin({
toast: true,
position: 'top',
showConfirmButton: false,
timer: 4000
});



//Alert auto Save modal

$.confirm({
closeIcon: true,
closeIconClass: 'fa fa-close',
icon: 'fa fa-question-circle',
	type:'blue',
	title: 'Auto Saved Found',
	content:'We found an Auto Saved Data from your previous post, do you want to recover?<br><b>NB: It\'ll auto removed after a week if action was not taken</b>',
theme: 'modern', //'bootstrap', //'supervan', // 'material', 

buttons: {
confirm: {
	text: 'Delete',
	action: function() {
// trigger the delete file

var delid = "all";
$.post("delete-post.php", { delid:delid }).done(function(data){
	
	$("#errs").html(data);
	
	//clear the textarea
	//$("#textarea").html("");

	});
	}
},

Recover: function () {
		Toast.fire({
		icon: 'success',
		title: 'Autosaved recovered'
		});
} 

} 
});



});


</script>
	

		<?php }?>			
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
					


<script>

$(document).ready(function() {

// change page title
function changePageTitle(page_title){   
// change page title
$('#page-title').text(page_title);
// change title tag
document.title=page_title;
}



//Submit Form
$('textarea#postValues').on('keyup',function() {
$("#postValues").css({"border-color":"1px solid #ced4da"});
});

$("#publish").click(function(){

let post = "post";
let postText = $("#postValues").val().trim();
let location = $("#location").val().trim();

$('#loader-image').show();

//send data
$.post("post-script.php", {post:post,postText:postText,location:location}).done(function(data){
	
$('#loader-image').hide();
	
$('#errs').html(data);

//$('#create-post').show();
	
	//srcoll top to post
	$("html, body").animate({
		scrollTop: $(".scroll").offset().top
	}, 0);
		
});
	
});










// If Cancel Btn was clicked
$('.cancelAll').click(function(){

// change page title
changePageTitle('eBlaze.com | Home');

// show a loader img
$('#loader-image').show();

// show create post button
$('#create-post').show();
$('.crate-post').show();

// fade out effect first
$('#page-content').fadeOut('slow', function(){
$('#page-content').load('read.php', function(){
	// hide loader image
	$('#loader-image').hide(); 
		
//show the post button container
	$('.optionCon').fadeIn();
		
	// fade in effect
	$('#page-content').fadeIn('slow');
});
});

//SHOW & fadeout THE LOAD PROGRESS
$('#load_data_message').show();
$('#load_data').fadeIn('slow');

//show the ads column - index page
$('#adsBoard').fadeIn();

});















//UPLOADING NEW POST IMAGE 

$('#image').change(function(){
var form_data = new FormData();
var files = $('#image')[0].files;
if(files.length > 10)
{

//Toast error
Toast.fire({
icon: 'error',
title: 'You can\'t select more than 10 images'
})

return false;
}
else
{
for(var i=0; i<files.length; i++)
{
var name = document.getElementById("image").files[i].name;
var ext = name.split('.').pop().toLowerCase();
if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
{

//Toast error
Toast.fire({
icon: 'error',
title: 'Please select a valid image file'
})

return false;
}
var oFReader = new FileReader();
oFReader.readAsDataURL(document.getElementById("image").files[i]);
var f = document.getElementById("image").files[i];
var fsize = f.size||f.fileSize;
if(fsize > 9194304) //9mb
{

//Toast error
Toast.fire({
icon: 'error',
title: 'Image is too large. Allowed max size is 9MB'
})
return false;
}
else
{
form_data.append("postploads[]", document.getElementById('image').files[i]);
}
}


if(files.length > 0){
$.ajax({
url:"post-script.php",
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

//Embed image
$("#uploaded").html(data);

//load Image Counter
$("#countPix").load("load-profile-data.php #countPostPix");

//remove red border from textarea
$("#postValues").css({"border-color":"1px solid #ced4da"});

}
});
}

}//Image Length



});












//Delete Temp uploaded image if the delete icon on the img was clicked
$(document).ready(function(){
$(".clos").click(function(){
let delid = this.id;

$.ajax({
	url: 'delete-post.php',
	type: 'POST',
	data: {delid:delid},
	success:function(data){
		
	$("#uploaded").append(data);
	
	//slowly fadeOut deleted img
	$(".postPixList_"+delid).fadeOut();
	
	//load Image Counter
	$("#countPix").load("load-profile-data.php #countPostPix");
	
	}
});	
});
});









/* disable submit button untill text is entered on textarea		
$('#publish').prop('disabled', true);


var postValues = $("#postValues").val();

if(postValues !=0) {
	$('#publish').prop('disabled', false);
} else {
	$('#publish').prop('disabled', true);
}
});*/
});


</script>