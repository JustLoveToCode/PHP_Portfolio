
<?php
    // Authorization - Access Control
    // Check whether the User is Logged In or Not
    // If the User Session is Not Set:
    if(!isset($_SESSION['user']))
    {
    // If the User is Not Logged In:
    // Redirect to the Login Page with the Message:
    $_SESSION['no-login-message'] ="<div class='error text-center'>Please Login to access Admin Panel</div>";
    // Redirect it to the Login Page:
    header('location:'.SITEURL.'admin/login.php');
    }

?>