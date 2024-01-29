<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br/>
        <br/>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        // Check for the Image Upload
        if(isset($_SESSION['upload']))
        {
            echo($_SESSION['upload']);
            unset($_SESSION['upload']);
        }

        ?>
        <br/>
        <br/>
        <!-- Add Category Form Starts with the method="POST" -->
        <!-- enctype properties will allowed us to upload the file or image -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <!-- When the input type is "file" for the input,
                        you can actually upload the file or image from your Computer -->
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                        <!-- The value will be saved in the DataBase -->
                        <!-- while the text Yes or No will be shown in the Browser User Interface -->
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                        <!-- Create the input type which is the radio button and having
                        the value of either "Yes" or "No" -->
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>
        <!-- Add Category Form Ends -->
        <!-- Check Whether the Submit Button is Clicked or Not -->
        <?php
        if(isset($_POST['submit']))
        {
           // Get the value from our Category Form Submission:
           $title = $_POST['title'];
           
           // For Form Radio Input Type, We need to check whether the Button is Selected or Not:
           if(isset($_POST['featured'])){
            // Get the value from Form for the featured properties:
            $featured = $_POST['featured'];

           }

           else{
            // Set the Default value which is set under the input
            // for the value="Yes" or value="No":
            $featured = "No";
           }
           if(isset($_POST['active']))
           {
            $active = $_POST['active'];
           }
           // We will give the Default Value

        else{
            $active="No";
        }
        // Check whether the Image is Selected or Not and Set the Value for the Image Name accordingly:
        // Using the $_FILES[] to see all the files that is being selected:
        // print_r($_FILES[]);
        // Breaking the Code Here
        // die();
        // Create SQL Queries to insert the Data into the DataBase Management:

        if(isset($_FILES['image']['name'])){
            // Upload the Image:
            // To upload the image, we need image name and source path
            // and the destination path:
            $image_name = $_FILES['image']['name'];

            // Upload the Image Only if the Image is Selected:
            if($image_name!="")
            {
            // Auto Renaming the Image:
            // Get the Extension of our image(.jpg, .png, .gif): specialfood1.jpg:
            // It will break into 3 Different Names Here and extract the .jpg, .png or .gif Here:
            // You will get the $ext in the form of the Array which is ['string1', '.png'] = $ext Here:
            // Hence, to access the .png here, you will need to use $ext[1] here:
            $ext = explode('.',$image_name);

            // Rename the Image with the New Name //Food_Category_100.jpg
            // Using the rand(000,999) will get you the random number from 000 to 999:
            $image_name = "Food_Category_".rand(000,999).'.'.$ext[1];

            // Getting the $source_path Here:
            $source_path = $_FILES['image']['tmp_name'];
            // Where you want to upload your Images using Concatenation:
            $destination_path="../images/category/".$image_name;
            // Upload the Image:
            $upload=move_uploaded_file($source_path,$destination_path);
            // Check whether the image is uploaded or not:
            // and if the image is not uploaded, then we will stop the process
            // and redirect with error message:
            if($upload==false){
                // Set Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                // Redirect to the Add Category Page:
                header('location:'.SITEURL.'admin/add-category.php');
                // Stop the Process:
                die();
            }
            }
        } else{
            // Do not upload the image and set the image_name value as blank:
            $image_name="";

        }
        $sql = "INSERT INTO tbl_category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";
        // Execute the Query and save in the DataBase Management:
        $res = mysqli_query($conn, $sql);

        // Check whether the Query is Executed Successfully or not and Data Added or Not:
        if($res == true){
            // Query Executed and Category Added:
            $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
            // Redirect to the Manage Category Page:
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
        else{
            // Failed to Add the Category:
            $_SESSION['add']="<div class='error'>Failed to add the Category</div>";
            header('location:'.SITEURL.'admin/add-category.php');
            die();
        }
        }
        ?>
    </div>
</div>



<? include('partials/footer.php');?>