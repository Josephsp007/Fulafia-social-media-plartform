		
		
	//POST REACTION
	$(".all-reaction").hide();	//hide reaction btn
	
	//if user click anywhere ouside the react btn close it
	$(document).on('click', function(e){
		if($(e.target).closest(".all-reaction").length ===0){
			$(".all-reaction").hide();
		};
	});
		
	$(document).ready(function(){
	$(".react").click(function(e){
		var id = this.id;
		var splitId = id.split("_");
		var reactId = splitId[1];
		
		$(".react_"+reactId).fadeIn(59).show();
		//Hide when a react button clicked
		$(".react_"+reactId).click(function(){
			$(".react_"+reactId).slideUp("slow");
		});
	});
	});
	
	//PROCESS LIKE TYPE
	
	$(".reaction").click(function(){
		var reactId = this.id
		var split = reactId.split("_");
		var reactType = split[0];
		var postId = split[1];
		var type = "like";
		
		$.ajax({
			type: "POST",
			data: {reactType:reactType, postId:postId, type:type},
			url: "likeunlike-post.php",
			success: function(data){
				//return count
				$("#label_"+postId).html(data); //change label text
				
				//replace thumb icon with the current clicked 
				var reactImg = "<center><img src='images/react/"+reactType+".png' class='reacted'></center>"; 
				$("#react_"+postId).html(reactImg);
				
				//switch icon background based on clicked reaction
				if(reactType =="thumb"){
				$("#react_"+postId).css("background","#e8e8ff");
				}else if(reactType =="love"){
				$("#react_"+postId).css("background","#ffdddd");
				}else if(reactType =="haha"){
				$("#react_"+postId).css("background","#fff7d8");
				}else if(reactType =="wow"){
				$("#react_"+postId).css("background","#fff7d8");
				}else if(reactType =="sad"){
				$("#react_"+postId).css("background","#fff7d8","padding","2px");
				}else if(reactType =="angry"){
				$("#react_"+postId).css("background","#ffdddd");
				}
				
			}
		});
		
		});