<?php
// Include constants.php for SITEURL
include('../config/constants.php');
// Destroy the Session using session_destroy():
// Unsets $_SESSION['user']
session_destroy();
// Redirect to Login Page:
header('location:'.SITEURL.'admin/login.php');
die();
?>