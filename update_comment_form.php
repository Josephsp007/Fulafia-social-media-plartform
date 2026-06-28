<?php
// get comment id
$product_id=isset($_GET['product_id']) ? $_GET['product_id'] : die('ERROR: comment ID not found.');

// include database and object files
include_once 'database.php';
include_once 'objects/comment.php';

// instantiate database and comment object
$database = new Database();
$db = $database->getConnection();

// initialize object
$comment = new comment($db);

// set comment id property
$comment->com_id=$product_id;

// read single comment
$comment->readOne();
?>


<!--we have our html form here where new comment information will be entered-->
<div class="blank">
<div class="widget-area no-padding"  style="margin-bottom:80px!important">
<div class="status-upload">
<form id='update-comment-form' action='#' method='post' border='0'>
<input type='hidden' name='com_id' value='<?php echo $product_id ?>' /> 
<textarea name='comment' class='form-control' required><?php echo htmlspecialchars($comment->comment);?></textarea>

<button type="submit" class="btn btn-primary" style="text-transform:none; margin-top:12px!important;">Done <i class="fa fa-check"></i> </button>

<span id="read-post" class="btn btn-primary" style="text-transform:none; margin-top:12px!important; margin-right:4px!important; padding:6.5px 10px 6.5px 10px; float:right">
&nbsp; Home&nbsp;<i class="fa fa-home"></i>&nbsp;</span>
</form>
</div><!-- Status Upload  -->

</div><!-- Widget Area -->
</div>



<script>
$('#read-post').click(function(){

// show a loader img
$('#loader-image').show();

// show create post button
$('#create-post').show();

// hide read products button
$('#read-products').hide();

// show products
showProducts();
});
</script>
