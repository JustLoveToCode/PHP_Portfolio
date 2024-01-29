<?php
    //Include the Constants Page:
    include('../config/constants.php');
    // Either use either the && or the AND Keyword:
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Proceed to Delete the Data:
        echo "Proceed to Delete the Data";

        // Get the ID and the Image Name:
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        // Remove the Image if Available:
        // Check whether the Image is Available or Not and Delete Only if Available
        if($image_name!= "")
        {
            // It has the image and need to be removed from the Folder:
            // Get the Image Path that need to be Deleted:
            $path = "../images/food/".$image_name;

            // Remove the Image File from the food Folder:
            $remove = unlink($path);

            // Check whether the Image is Removed or Not:
            // If the $remove is false Boolean Value:
            if($remove==false){
                //Failed to Remove the Image If Failed to Remove the Image File:
                $_SESSION['upload'] = "<div class='error'>Failed to Remove the Image File</div>";
                //Redirect to the Manage Food: This is the Location that the User will be Redirected to:
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stopping the Processes of Deleting Food:
                die();
            }
        }

        // Delete the Food from the SQL Query on the DataBase Management:
        $sql ="DELETE FROM tbl_food WHERE id=$id";

        // Execute the Query using mysqli_query() Here:
        $res = mysqli_query($conn, $sql);

        // Check Whether the Query is Executed Successfully or not
        // and set the Session Message Respectively:
        if($res==true)
        {
        //This is the Session Message that will be Displayed:
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        // The Full URL of the file that you want to Redirect:
        header('location:'.SITEURL.'admin/manage-food.php');
        die();

        // If Failed to Delete the Food: The else Statement will be Executed:
        } else
        {
            $_SESSION['delete'] ="<div class='error'>Failed to Delete the Food.</div>";
            // Redirect the User to the Manage Food Page:
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }

        // Redirect to the Manage Food with the Session:

    }
    else{
        // Redirect to the Manage Food Page:
        $_SESSION['unauthorize']="<div class='error'>UnAuthorized Access to Data.</div>";
        // This is where you want to Redirect the User:
        header('location:'.SITEURL.'admin/manage-food.php');
        die();
    }
?>