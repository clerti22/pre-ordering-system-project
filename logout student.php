<?php
session_start();
session_unset();  // Remove all session variables
session_destroy();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  // Destroy the session
header('Location: login_student.php');  // Redirect to the login page
exit();
?>