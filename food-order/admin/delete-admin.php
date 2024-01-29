<?php
    // Include the constants.php file:
    include('../config/constants.php');

    // 1. Get the id of the Admin to be Deleted Here:
    // using the _GET Keyword:
    $id = $_GET['id'];


    // 2. Create SQL Queries to Delete the Admin:
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the Query:
    $res = mysqli_query($conn, $sql);

    // Check whether the Query has been Executed Successfully or Not
    if($res == true){
        // Query Executed Successfully and Admin will be Deleted:
        echo "Admin Deleted Successfully";

        // Create the Session Variable to Display the Message:
        // If it is Successful:
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect to the Manage Admin Page:
        header('location:'.SITEURL.'admin/manage-admin.php');
        die();


    }
    else{
        // Fail to Delete the Admin:
        $_SESSION['delete'] = "<div class='error'>Failed to Delete the Admin. Try Again</div>";
        // Redirect to the Manage Admin Page:
        header('location:'.SITEURL.'admin/manage-admin.php');
        die();
    }

    // 3. Redirect to the Manage Admin Page with the Message: Success or Error


?>