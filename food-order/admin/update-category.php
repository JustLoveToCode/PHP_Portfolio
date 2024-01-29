<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br/>
        <br/>

        <?php 
        // Check whether the id is set or not:
        if(isset($_GET['id']))
        {
            //Get the ID and all the Order Details:
            $id =$_GET['id'];
            // Create the SQL Query to get from the tbl_category:
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // Execute the Query:
            $res = mysqli_query($conn, $sql);

            // Count the Rows to check whether the id is Valid or Not:
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // Getting All the Data from the SQL DataBase Management
                // for the Respective Columns for the Same DataBase Management:
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else{
                // Redirect to Manage Category with the Session Message:
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                header('location'.SITEURL.'admin/manage-category.php');
            }


        }
        else{
            // Redirect to the Manage Category:
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <!-- Create the First Row -->
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text"
                        name="title"
                        value="<?php echo $title;?>">
                    </td>
                </tr>
                <!-- Create the Second Row -->
                <tr>
                    <td>Current Image:</td>
                    <td>
                       <?php
                       if($current_image !="")
                       {
                        // Display the Image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>"
                        width="150px">
                        <?php
                       }
                       else{
                        // Display the Message
                        echo "<div class='error'> Image is not Added</div>";
                       }

                       ?>
                    </td>
                </tr>
                <!-- Create the Third Row -->
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <!-- Create the Fourth Row -->
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";}?>  type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <!-- Create the Fifth Row -->
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category"
                        class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        // Passing the Value through our form, 
        // Hence it is the POST Method:
        if(isset($_POST['submit']))
        {
            // Get all the Values from our Form Submission:
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured=$_POST['featured'];
            $active = $_POST['active'];

            //Upload the New Image if Selected
            if(isset($_FILES['image']['name']))
            {

                $image_name = $_FILES['image']['name'];

                if($image_name!=""){

                    $ext = explode('.',$image_name);

 
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext[1];
        

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path="../images/category/".$image_name;

                    $upload=move_uploaded_file($source_path,$destination_path);
   
                    if($upload==false){
                        // Set Message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                        // Redirect to the Add Category Page:
                        header('location:'.SITEURL.'admin/add-category.php');
                        // Stop the Process:
                        die();
                    }


                    // Remove the Current Image if the Image is Available:
                    if($current_image!="")
                    {
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);
                        // Check whether the Image is Removed or Not:
                        // If Failed to remove, display the Message and Stop the Processes:
                        if($remove == false){
                            // Failed to remove the Image:
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the Current Image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            // Stop the Process:
                            die();
                        }
                    }
                   



                }
                else{
                    $image_name = $current_image;
                }
            }
            else{
                $image_name = $current_image;
            }


            //Update the DataBase
            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name='$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";
            // Execute the Query:
            $res2=mysqli_query($conn, $sql2);

            // Redirect to Manage the Category with the Message:
            if($res2==true){
                // Category Updated:
                $_SESSION['update']="<div class='success'>Category Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            } else{
                // Failed to Update the Category:
                $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
           }
        }
        ?>

    </div>
</div>


<?php 
include('partials/footer.php');
?>