<?php 
    // Include the Constants File:
    include('../config/constants.php');
    // Check Whether the id and image_name value is Set or Not:
    // We must pass the id and the Image Name:
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Get the Value and Delete the Data:
        $id = $_GET['id'];
        $image_name=$_GET['image_name'];

        // Remove the Physical Image File that is Available in the File:
        if($image_name!="")
        {
            // Image is Available, so Remove It:
            // Create the Path for our Image by Getting the Image and using the String Concatenation
            // by using the Dot Notation Method Here:
            $path="../images/category/".$image_name;
            // Remove the Physical Image by using the unlink() Method:
            $remove = unlink($path);
            // If failed to Remove the Image then add an Error Message and STOP the Process:
            if($remove == false)
            {
                // Set the Session Message:
                $_SESSION['remove'] = "<div class='error'>Failed to Remove the Category Image</div>";
                // Redirect to Manage Category Page Based on the File Path:
                header('location:'.SITEURL.'admin/manage-category.php');
                // We then Stop the Process:
                die();
            }
        }

        // Delete the Data from the DataBase Management in MySQL DataBase Management
        // SQL Queries - Delete the Data from the DataBase Management:
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the Query Here using mysqli_query($conn, $sql) Here:
        $res=mysqli_query($conn, $sql);

        // Check Whether the Data is Deleted from the DataBase Management of mySQL DataBase:
        // Check whether $res actually exist here:
        if($res==true){
            // Set the Success Message and Redirect:
            $_SESSION['delete'] = "<div class='success'>The Category is Deleted Successfully</div>";
            // Redirect to the Manage Category:
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        } else{
            // Set the Failed Message and Redirect:
            $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
            // Redirect to the Manage Category Page:
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }

        // Redirect to the Manage Category Page with the Message:
    }
    else{
        // Redirect to the Manage Category Page:
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
    }

    
?>