<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to index page
header("Location: ../");
exit();
?>