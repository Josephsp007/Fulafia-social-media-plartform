 
 <!--INITIATE JQUERY DROP SEARCH-->
  <script src="js/JqueryautoSearch.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'compose-search.php?key=%QUERY',
        limit : 5
    });
});
    </script>
	
<!--/INITIATE JQUERY DROP SEARCH-->


	
            <div class="box-body">
              <div class="form-group">
			  <span id="getimage"></span>
	<input style="width:100%; font-size:17px;" type="text" id="typeahead" name="typeahead" class="form-control typeahead " autocomplete="off" spellcheck="false" placeholder="To:" value="">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">
                      <h1><u>Heading Of Message</u></h1>
                      <h4>Subheading</h4>
                      <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and I will give you a complete account of the system, and expound the actual teachings
                        of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                        how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                        is there anyone who loves or pursues or desires to obtain pain of itself.</p>
                      <ul>
                        <li>List item one</li>
                        <li>List item two</li>
                      </ul>
                      <p>Thank you,</p>
                      <p>John Doe</p>
                    </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
			


	<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
  
  
  
  //get selected user image
  
  $(document).ready(function(){
	  $("#typeahead").change(function(){
		 
		 
			 let username = $("#typeahead").val();
			 // $("#getimage").load("load-profile-data.php #image");
		  
		 $.post("load-profile-data.php", {username: username}).done(function(data){
			$("#getimage").load("load-profile-data.php #image");
		 });
		  
		
		

  
  });
  });
</script>