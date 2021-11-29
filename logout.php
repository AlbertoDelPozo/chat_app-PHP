<?php 
//to destroy the session
session_start();
$_SESSION = array();
session_destroy();
setcookie(session_name(), 123, time() - 1000);
//redirection to the index
header("Location: index.php");

?>