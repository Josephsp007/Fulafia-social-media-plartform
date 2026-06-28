
<?php

include("include/config.php");
session_start();

if(isset($_SESSION["user_login"])){
		header("location: index.php");
	}

	
?>
	
	



<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Register | Login</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<link rel="stylesheet" href="css/styles.css">
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/welcome-style.css">

</head>


<body>

<div class="image-container">
<img src="images/background-image/fulafia.png">
<img src="images/background-image/fulafia.png">
</div>


<?php
//include("include/header.php");

?>


<!--SIDE BAR FOR NON LOGIN USERS-->
<style>
body{
/*background:#E6EAEA!important;*/
background-image: radial-gradient(ellipse closest-side, rgba(225, 225, 225, 0),#E6EAEA), url(images/africa.jpg)!important;
background-repeat: repeat!important;
font-family: "proxima-nova", "Source Sans Pro", sans-serif!important;
box-sizing:border-box;
margin:0!important;
}

@media(min-width:990px){
.ts-sidebar{
	display:none;
}
}

.image-container{
position:absolute;
z-index: -1;
display:flex;
width:90%;
height:90%;
gap:5%;
margin-top:3%;
margin-left:8%;
filter:brightness(0.8) contrast(1.2) saturate(1.5)
}





/*LOGIN*/


a {
  text-decoration: none;
  color: #1ab188;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
a:hover {
  color: #179b77;
}

.tab-group {
  list-style: none;
  padding: 0;
  margin: 0 0 15px 0;
}
.tab-group:after {
  content: "";
  display: table;
  clear: both;
}
.tab-group li a {
  display: block;
  text-decoration: none;
  padding: 13px;
  background: rgba(160, 179, 176, 0.25);
  color: #a0b3b0;
  font-size: 18px;
  float: right;
  width: 50%;
  text-align: center;
  cursor: pointer;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
.tab-group li a:hover {
  background: #1e3d5c;
  color: #ffffff;
}
.tab-group .active a {
  background: #1e3d5c;
  color: #ffffff;
}

.tab-content > div:last-child {
  display: none;
}


label {
  position: absolute;
  -webkit-transform: translateY(14px);
          transform: translateY(14px);
  left: 19px;
  font-weight:normal;
  color:#868181!important;
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
  -webkit-backface-visibility: hidden;
  pointer-events: none;
  font-size: 14px;
}


label.active {
  -webkit-transform: translateY(56px);
   transform: translateY(56px);
  left: 2px;
  font-size: 14px;  padding-bottom:10px!important;
}

label.highlight {
  color: #888;
}

input, textarea {
  border-radius: 0;
  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
  transition: border-color .25s ease, box-shadow .25s ease;
}

.field-wrap {
  position: relative;
  margin-bottom: 25px;
}

.top-row:after {
  content: "";
  display: table;
  clear: both;
}
.top-row > div {
  float: left;
  width: 48%;
  margin-right: 4%;
}
.top-row > div:last-child {
  margin: 0;
}


.forgot {
  margin-top: -20px;
  text-align: right;
}

</style>



<p><br>


<div class="form-body" style='/*background:radial-gradient(#354b73, #021731)!important*/'>
      
      <ul class="tab-group">
        <li class="tab"><a href="#signup" style="border-top-right-radius:10px;border-bottom-right-radius:10px;">Sign Up</a></li>
        <li class="tab active" id='tablog'><a href="#login" style="border-top-left-radius:10px;border-bottom-left-radius:10px;">Log In</a></li>
      </ul>
      
      <div class="tab-content">
	  

		<!--LOGIN -->
		
    <div id="login"> 
		

		
  <center>
 <h2 style='color:#767e80' id="wlcm">Welcome Back!</h2>
  </center>    
  <br> 
  
				
		<div id="result"></div>
		
		
    
  <form method="post" id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          
            <div class="field-wrap">
            <div id="errs"></div>
            <label>
               &nbsp;&nbsp; <i class="fa fa-user"></i>&nbsp;&nbsp;Email or Username
            </label>
			<input class="inputmodify" type="text" name="email" id="email" autocomplete="off" autofocus value="<?php if(isset($_POST["email"])){echo $_POST["email"];}?>">
          </div>
          
          <div class="field-wrap">
            <label>
              &nbsp;&nbsp; <i class="fa fa-key"></i>&nbsp;&nbsp;Password
            </label>
			<input class="inputmodify" type="password" id="password" name="password" value="<?php if(isset($_POST["password"])){echo $_POST["password"];}?>" >
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button type="submit" name="login" id="login" class="btn btn-primary" style='width:100%; text-transform:capitalize; font-weight:normal;letter-spacing:1px'>
		  <span id="log">Log In</span>  
		<!-- animation in style.css only show when success on login-->
		  
		  <span id="roll"><span id='pleaseWait'>Please Wait </span><i class="fa fa-spinner fa-pulse"></i></span>
		  </button>
          
          </form>



        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		<div id="signup">   
         	  
			  
	<form class="form" id="reg-form">
	<center>
	<h2 style='color:#767e80'>Sign Up For Free</h2>
	</center>    <br>   
		  
	<!--REGISTER -->
		  		
		<div id="registered"></div>
		<div id="regErr"></div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Full Name
              </label>
             <input class="inputmodify" type="text" autofocus name="name" id="name" value="<?php if(isset($_POST["name"])){echo $_POST["name"];}?>">
            </div>
        
		
            <div class="field-wrap">
              <label>
                Username
              </label>
              <input class="inputmodify" type="text" name="nick"  id="nick" value="<?php if(isset($_POST["nick"])){echo $_POST["nick"];}?>">
            </div>
          </div>
		  

          <div class="top-row">
          <div class="field-wrap">
          <label>
            Email
          </label>
		<input class="inputmodify" type="text" name="email" id="regemail" value="<?php if(isset($_POST["email"])){echo $_POST["email"];}?>">
          </div>
        
          <div class="field-wrap">
          <label>
           Staff ID / Matric Number
          </label>
		<input class="inputmodify" type="text" name="matric" id="matric" value="<?php if(isset($_POST["matric"])){echo $_POST["matric"];}?>">
          </div>
          </div>
        
        
        
        
          <div class="field-wrap">
            <label>
              Set Password
            </label>
			<input class="inputmodify" type="password" id="pass" name="password">
			</div>

          
          <button id="register" class="btn btn-primary" style="width:100%; outline:none;text-transform:capitalize; font-weight:normal;letter-spacing:1px">
		  <span id="regbtn-txt">Get Started</span><span id="regbtn-txt2">Processing <i class="fa fa-spinner fa-pulse"></i></span>
		  </button>
          
          </form>

        </div>

		
	</div><!-- tab-content -->
	</div> <!-- /form -->



<script>
var close = document.getElementsByClassName("closebtn");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>



<!-- LOGIN REGISTER TRICK -->

<script>

//Login Scripts

	$(document).ready(function(){
	
	//hide Error div when its clicked
	$('div#errs').click(function(){
		$('div.error-alert').fadeOut("slow");
	});
	
	
	$('span#roll').hide();
	
	$('button#login').click(function(e){
		e.preventDefault();
	
	var email = $('input#email').val();
	if(email ==''){
		
	$('div#errs').html('<div class="error-alert errors"><span class="closebtn">&times;</span><strong>Email or Username Required</strong></div>');
	
	$('input#email').focus();
	return false;
	}
  
	
	var password = $('input#password').val();
	if(password ==''){
	$('div#errs').html('<div class="error-alert errors"><span class="closebtn">&times;</span><strong>Enter your password</strong></div>');
	$('input#password').focus();
	return false;
	}
		
	$.ajax({
	
	type: 'POST',
	url: 'login-script.php',
	data: $('#loginform').serialize(),
	beforeSend: function(){
		$('span#roll').show();
		$('span#log').hide();
	},
	complete: function(){
		$('span#roll').hide();
		$('span#log').show();
	},
	success: function(data){
		var data = $('#result').html(data);
	}
		
	});
	});

	});
	
	
	

//Register Scripts

	$(document).ready(function(){
	$('span#regbtn-txt2').hide();
	
	$('button#register').click(function(e){
		e.preventDefault();
		
	
	//hide Error div when its clicked
	$('div#regErr').click(function(){
		$('div.error-alert').fadeOut("slow");
	});
	
	var name = $('input#name').val();
	if(name ==''){
	$('#regErr').html('<div class="error-alert errors" id="nameError"><span class="closebtn">&times;</span><strong>Name is required</strong></div>');
	$('input#name').focus();
	return false;
	}
	
	var nick = $('input#nick').val();
	if(nick ==''){
	$('#regErr').html('<div class="error-alert errors" id="nameError"><span class="closebtn">&times;</span><strong>Username is required</strong></div>');
	$('input#nick').focus();
	return false;
	}
	
	var email = $('input#regemail').val();
	if(email ==''){
	$('#regErr').html('<div class="error-alert errors" id="nameError"><span class="closebtn">&times;</span><strong>Email is required</strong></div>');
	$('input#regemail').focus();
	return false;
	}
	

  var matric = $('input#matric').val();
	if(matric ==''){
	$('#regErr').html('<div class="error-alert errors" id="nameError"><span class="closebtn">&times;</span><strong>Enter Staff ID/Matric Number</strong></div>');
	$('input#matric').focus();
	return false;
	}


  
	var pass = $('input#pass').val();
	if(pass ==''){
	$('#regErr').html('<div class="error-alert errors" id="nameError"><span class="closebtn">&times;</span><strong>Enter Password</strong></div>');
	$('input#pass').focus();
	return false;
	}

	


	$.ajax({
	type: 'POST',
	url: 'signup-script.php',
	data: $('#reg-form').serialize(),
	beforeSend: function(){
		$('span#regbtn-txt2').show();
		$('span#regbtn-txt').hide();
	},
	success: function(data){
		var data = $('#registered').html(data);		
		$('span#regbtn-txt2').hide();
		$('span#regbtn-txt').show();
	}
		
	});
	});

	});




$('.form-body').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

      if (e.type === 'keyup') {
            if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if( $this.val() === '' ) {
            label.removeClass('active highlight'); 
            } else {
            label.removeClass('highlight');   
            }   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
            label.removeClass('highlight'); 
            } 
      else if( $this.val() !== '' ) {
            label.addClass('highlight');
            }
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
</script>













<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>





