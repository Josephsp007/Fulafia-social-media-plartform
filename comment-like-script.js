
$(document).ready(function(){

    // like and unlike click
    $(".like, .unlike").click(function(){
        var id = this.id;   // Getting Button id
        var split_id = id.split("_");

        var text = split_id[0];
        var com_id = split_id[1];  // postid

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else{
            type = 0;
        }

        // AJAX Request
        $.ajax({
            url: './likeunlike-comment.php',
            type: 'post',
            data: {com_id:com_id,type:type},
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $("#likes_"+com_id).text(likes);        // setting likes
                $("#unlikes_"+com_id).text(unlikes);    // setting unlikes

                if(type == 1){
                    $("#like_"+com_id).css("color","#2fac02");
                    $("#unlike_"+com_id).css("color","#888");
                }
				   
                if(type == 0){
                    $("#unlike_"+com_id).css("color","#ee4e4e");
                    $("#like_"+com_id).css("color","#888");
					
                }

            }
        });

    });

});