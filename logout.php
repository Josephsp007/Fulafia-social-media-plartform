<script src="js/jquery.min.js"></script>

<?php

session_start();

$_SESSION = array();

session_destroy();

?>

<?php
header("location: ../register-login.php");
?>