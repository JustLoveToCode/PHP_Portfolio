<!-- Include the code in the menu and
hence it will be Applied to all the files since it is a partial folder -->
<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>



<html>
    <head>
        <!-- Creating the title -->
        <title>Food Order Website - Home Page</title> 
        <!-- Creating the link to the style.css -->
        <link rel="stylesheet" href="../css/admin.css">  
    </head>
    <body>
        <!--Menu Section Start -->
        <div class="menu text-center">
            <!-- Putting the div with the wrapper class -->
            <div class="wrapper">
                <ul>
                    <li><a href="../admin/index.php">Home</a></li>
                    <li><a href="../admin/manage-admin.php">Admin Manager</a></li>
                    <li><a href="../admin/manage-category.php">Category</a></li>
                    <li><a href="../admin/manage-food.php">Food</a></li>
                    <li><a href="../admin/manage-order.php">Order</a></li>
                    <li><a href="../admin/logout.php">Logout</a></li>
                </ul>
            </div>  
        </div>
        <!-- Menu Section End -->