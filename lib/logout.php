<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();

// Unset the user cookie
setcookie(
    'user',
    '',
    time(),
    "/");

// Destroy the session.
session_destroy();
 
// Redirect to login page
// header("location: login.php");
exit;
?>