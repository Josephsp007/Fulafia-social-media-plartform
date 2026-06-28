	<?php

	include('include/config.php');

	session_start();

	$userid = $_SESSION['user_login'];







	//Upload script for post in - create_form.php

	if(isset($_FILES["postploads"]["name"])){


	//Allow only 6 image Uploads
	$sql=$pdo->prepare("SELECT COUNT(*) AS counts from temp_attach where userid=:userid");
	$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
	$sql->execute();
	$counts=$sql->fetch();
	if($counts["counts"] >9){
	echo "
		<script>
		var Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 4000
		});
		
		Toast.fire({
		icon: 'error',
		title: 'You can only add up to 10 photos'
		})
		</script>";
		$listed = "listed";
	}else{

	//$output = '';
	sleep(1);
	for($count=0; $count<count($_FILES["postploads"]["name"]); $count++)
	{
	$postimages = $_FILES["postploads"]["name"][$count];
	$tmp_name = $_FILES["postploads"]['tmp_name'][$count];
	$file_array = explode(".", $postimages);
	$file_extension = end($file_array);

	$postimages = $file_array[0] . '-'. rand() . '.' . $file_extension;

	$location = 'images/post-images/' . $postimages;
	if(move_uploaded_file($tmp_name, $location))
	{


	$stmt=$pdo->prepare("INSERT INTO temp_attach (userid,images) VALUES(:userid,:images)");
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->bindParam(":images", $postimages, PDO::PARAM_STR);
	$stmt->execute();
	if($stmt){
	$listed = "listed";
	}

	}//move_uploaded_file
	}

	}
	}


















	//send uploaded images - to form for preview - manage.php left nav
	$sql=$pdo->prepare("SELECT * FROM temp_attach WHERE userid=:userid");
	$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
	$sql->execute();
	$postpix=$sql->fetchAll();

	if(isset($listed)){ 

	if($sql->rowCount() >0){
	echo "<div style='display:flex;flex-wrap:wrap;justify-content:center;padding:10px;'>";
	foreach($postpix as $postpixs){
	echo "<div></div>
	<span style='margin-right:-30px' class='postPixList_".$postpixs['temp_id']."'>
	<img src='images/post-images/".$postpixs['images']."' class='listing' alt='Ads Image'>
	<i class='fas fa-close clos postPixList_".$postpixs['temp_id']."' id='".$postpixs['temp_id']."'></i></span>";
	}

	echo "</div><script>$('#uploaded').fadeIn('fast'); //fadeIn the image div</script>";

	}
	} 

	?>




	<script>
	//Delete uploaded image if the delete icon on the img was clicked
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
	</script>		





























	<?php

	//CREATE POST
	if(isset($_POST["post"])){


	//check image and set var
	$sql=$pdo->prepare("SELECT * FROM temp_attach WHERE userid=:userid");
	$sql-> bindParam(':userid', $userid, PDO::PARAM_STR);
	$sql->execute();
	$getCount = $sql->rowCount();
	if($getCount >10){
	$error[] = "<br>You can only add up to 10 photos.";
	}

	$imageFile=$sql->fetchAll();

	//get images
	if($getCount >0){$image1 = htmlspecialchars($imageFile[0]["images"]);}else{$image1 ="";}
	if($getCount >1){ $image2 = htmlspecialchars($imageFile[1]["images"]);}else{$image2 ="";}
	if($getCount >2){ $image3 = htmlspecialchars($imageFile[2]["images"]);}else{$image3 ="";}
	if($getCount >3){ $image4 = htmlspecialchars($imageFile[3]["images"]);}else{$image4 ="";}
	if($getCount >4){ $image5 = htmlspecialchars($imageFile[4]["images"]);}else{$image5 ="";}
	if($getCount >5){ $image6 = htmlspecialchars($imageFile[5]["images"]);}else{$image6 ="";}
	if($getCount >6){ $image7 = htmlspecialchars($imageFile[6]["images"]);}else{$image7 ="";}
	if($getCount >7){ $image8 = htmlspecialchars($imageFile[7]["images"]);}else{$image8 ="";}
	if($getCount >8){ $image9 = htmlspecialchars($imageFile[8]["images"]);}else{$image9 ="";}
	if($getCount >9){ $image10 = htmlspecialchars($imageFile[9]["images"]);}else{$image10 ="";}



	$location = htmlspecialchars(trim($_POST["location"]));
	$postText = htmlspecialchars(trim($_POST["postText"]));

	if(empty($location)){
	$location = ""; 
	}

	if(empty($postText) AND empty($image1)){
	$error[] = ".";
	echo "Please Enter your post
		<script>
		$('#postValues').focus().css({'border-color': 'rgb(255, 80, 80)'});
		</script>";
		
	}



	if(isset($error)){
	foreach($error as $errors){
	echo $errors;
	}
	}else{

	$created = time();
	$background = "";

	$stmt = $pdo->prepare(
	"INSERT INTO posts (
	post,background,userid,location,created,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10
	)VALUES(
	:post,:background,:userid,:location,:created,:image1,:image2,:image3,:image4,:image5,:image6,:image7,:image8,:image9,:image10
	)");


	$stmt->bindParam(":post",$postText,PDO::PARAM_STR);
	$stmt->bindParam(":background",$background,PDO::PARAM_STR);
	$stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
	$stmt->bindParam(":location",$location,PDO::PARAM_STR);
	$stmt->bindParam(":created",$created,PDO::PARAM_STR);
	$stmt->bindParam(":image1",$image1,PDO::PARAM_STR);
	$stmt->bindParam(":image2",$image2,PDO::PARAM_STR);
	$stmt->bindParam(":image3",$image3,PDO::PARAM_STR);
	$stmt->bindParam(":image4",$image4,PDO::PARAM_STR);
	$stmt->bindParam(":image5",$image5,PDO::PARAM_STR);
	$stmt->bindParam(":image6",$image6,PDO::PARAM_STR);
	$stmt->bindParam(":image7",$image7,PDO::PARAM_STR);
	$stmt->bindParam(":image8",$image8,PDO::PARAM_STR);
	$stmt->bindParam(":image9",$image9,PDO::PARAM_STR);
	$stmt->bindParam(":image10",$image10,PDO::PARAM_STR);
	$stmt->execute();

	if($stmt){
		echo "
		<script>
		
		//Delete temp image if post was successfull
		let delid = 'posted';
			$.post('delete-post.php', {delid:delid});
			
		//refresh the browser if post created 
		window.location.reload();
		
		</script>";
		
	}

	}
	}





	//UPDATE POST	
	if(isset($_POST["updateId"])){
	$updateId = intval($_POST["updateId"]);
	$postText = htmlspecialchars(trim($_POST["postText"]));

	$stmt = $pdo->prepare("UPDATE posts SET post=:post WHERE post_id=:post_id");
	$stmt->bindParam(":post",$postText,PDO::PARAM_STR);
	$stmt->bindParam(":post_id",$updateId,PDO::PARAM_STR);
	$stmt->execute();
	echo $postText . "<script>

	Toast.fire({
	icon: 'success',
	title: 'Updated Successfully'
	})
	</script>";
	}

	?>
