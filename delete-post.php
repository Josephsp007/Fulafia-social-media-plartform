<?php

	include("include/config.php");
	session_start();

	$userid = $_SESSION['user_login'];
	
	
	
	
	
	//Delete POSTs and Unlink Images
		if(isset($_POST["postId"])){
		$postId = intval($_POST["postId"]);
		
		//Remove previous Draft image on folder before deleting
		$query=$pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id");
		$query->bindParam(":post_id", $postId, PDO::PARAM_STR);
		$query->execute();
		$postImgs = $query->fetch();
		//remove images
		@unlink('images/post-images/'.$postImgs["image1"]);
		@unlink('images/post-images/'.$postImgs["image2"]);
		@unlink('images/post-images/'.$postImgs["image3"]);
		@unlink('images/post-images/'.$postImgs["image4"]);
		@unlink('images/post-images/'.$postImgs["image5"]);
		@unlink('images/post-images/'.$postImgs["image6"]);
		@unlink('images/post-images/'.$postImgs["image7"]);
		@unlink('images/post-images/'.$postImgs["image8"]);
		@unlink('images/post-images/'.$postImgs["image9"]);
		@unlink('images/post-images/'.$postImgs["image10"]);
		
		//Delete
		$stmt = $pdo->prepare("DELETE FROM posts WHERE post_id=:post_id");
		$stmt->bindParam(":post_id",$postId,PDO::PARAM_STR);
		$stmt->execute();
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//Delete Temp Uploaded Image - if delete image icon was clicked
	if(isset($_POST["delid"])){
		$delid = intval($_POST["delid"]);
		
		//Remove previous Draft image on folder before deleting
		$query=$pdo->prepare("SELECT * FROM temp_attach WHERE temp_id=:temp_id");
		$query->bindParam(":temp_id", $delid, PDO::PARAM_STR);
		$query->execute();
		$prevImg = $query->fetch();
		@unlink('images/post-images/'.$prevImg["image"]);
		
		$stmt = $pdo->prepare("DELETE FROM temp_attach WHERE temp_id=:temp_id");
		$stmt->bindParam(":temp_id",$delid,PDO::PARAM_STR);
		$stmt->execute();
		
		
		
		
		
		
		
		//delete all & remove images on temp table if Post was discarded(autoSaved discarded) - command from create_form.php
		if($_POST["delid"] == "all"){
		
		//remove from folder
		$query=$pdo->prepare("SELECT * FROM temp_attach WHERE userid=:userid");
		$query->bindParam(":userid", $userid, PDO::PARAM_STR);
		$query->execute();
		$revImg = $query->fetchAll();
		foreach($revImg as $rev){
		@unlink('images/post-images/'.$rev["image"]);
		}
			
		$sql = $pdo->prepare("DELETE FROM temp_attach WHERE userid=:userid");
		$sql->bindParam(":userid",$userid,PDO::PARAM_STR);
		$sql->execute();
		if($sql){
		echo "<script>
				//fadeOut temp_attach container
				$('#uploads').fadeOut(); 
				
				 //Toaster
				var Toast = Swal.mixin({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 4000
				});
		
				Toast.fire({
				icon: 'success',
				title: 'Autosaved deleted'
				});
	
			</script>";
	}
	
	}
	
	
	
	//delete images fro temp_attach if post was success
	if($_POST["delid"] == "posted"){
		$sql = $pdo->prepare("DELETE FROM temp_attach WHERE userid=:userid");
		$sql->bindParam(":userid",$userid,PDO::PARAM_STR);
		$sql->execute();
	}





	}