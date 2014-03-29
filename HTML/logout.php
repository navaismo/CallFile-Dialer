<?php
session_start(); //Start the current session
session_destroy(); //Destroy it! So we are logged out now
header("location:index.php?msg=Successfully Logged out&type=1"); // Move back to login.php with a logout message
?>
