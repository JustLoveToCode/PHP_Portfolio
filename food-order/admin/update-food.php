
<?php 
include('partials/menu.php');?>
<?php
// Check whether the id is actually Set or Not:
if(isset($_GET['id']))
{
    // Get all the Details:
    $id=$_GET['id'];
    // SQL Query to get the Selected Food using the SELECT method:
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    // Execute the Query:
    $res2 = mysqli_query($conn, $sql2);

    // Get the Value based on the Query Executed:
    $row2 = mysqli_fetch_assoc($res2);

    // Getting the Individual Value of the $row Variable:
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}
else{
    // Redirect to Manage Food:
    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food Page</h1>
        <br/><br/>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Creating the Table with the width of 30% -->
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5">
                        <?php echo $description; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value=<?php echo $price;?>>
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image == "")
                        {
                            // Image is Not Available
                            echo "<div class='error'>Image is Not Available</div>";
                        }
                        else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" alt="<?php echo $title;?>
                            " width="200px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                // Query to Get the active Categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute the Query:
                                $res = mysqli_query($conn, $sql);
                                // Count the Number of the Rows:
                                $count = mysqli_num_rows($res);
                                // Check whether the Category is Available or Not using the $count>0
                                if($count>0){
                                    // Category is Available, fetch the Data:
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>">
                                    <?php echo $category_title;?>
                                    </option>
                                    <?php
                                    }
                                }
                                else{
                                    // The Category is Not Available
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                            ?>
                            <option value="0">Testing Category</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['submit']))
        {
            // Get all the Details from the form:
            $id = $_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Upload the Image if it is Selected:
            // Check whether the Upload Button is Clicked or Not:
            if(isset($_FILE['image']['name']))
            {
                // Upload Button Clicked:
                // This is the New Image Name:
                $image_name = $_FILES['image']['name'];

                // Check whether the Files is Available or Not:
                if($image_name!=""){
                    // Image is Available:
                    // Uploading the New Image:

                    // Rename the Image:
                    // Get the Extension of the Image
                    $explode_array = explode('.', $image_name);
                    $ext = end($explode_array);
                    // Renaming the Image File:
                    $image_name = "Food-Name-".rand(000,999).'.'.$ext;
                    //Get the Source Path and the Destination Path:
                    $src_path = $_FILE['image']['tmp_name']; // This is the Source Path
                    $dest="../images/food".$image_name; // This is the Destination Path
                    // Upload the Image using the move_uploaded_file and getting
                    // the $src_path and the $dest Path Variable:
                    $upload=move_uploaded_file($src_path, $dest);

                    // Check whether the Image is Uploaded or Not Uploaded:
                    if($upload == false){
                        // Failed to Upload the Image:
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
                        // Redirect to Manage Food Page:
                        header("location:".SITEURL.'admin/manage-food.php'); 
                        // Stop the Process
                        die();
                    }
                    // Remove the Image if the New Image is Uploaded
                    // and Current Image exist:

                    // Remove the Current Image if Available:
                    if($current_image!="") {
                        // Current Image is Available:
                        // Remove the Image:
                        $remove_path= "../images/food/".$current_image;
                        // Unlink Function to remove the Image from the files:
                        $remove = unlink($remove_path);
                        // Check whether the Image is Removed or Not Removed:
                        if($remove == false){
                            $_SESSION['remove-failed']="<div class='error'>Failed to Remove the Current Image</div>";
                            // Redirect to the Manage Food:
                            header('location:'.SITEURL.'admin/manage-food.php');
                            // Stop the Process:
                            die();
                        } 
                    }
                }
                else{
                    // Default Image if the Image is Not Selected:
                    $image_name = $current_image;
                }
            }
            else{
                // Default Image when the Button is Not Clicked:
                $image_name = $current_image;
               

            }

            // Update the Food into the SQL DataBase Management:
            $sql3 ="UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id
            ";
            // Execute the SQL Query:
            $res3 = mysqli_query($conn, $sql3);

            // Check whether the Query is Executed or Not:
            if($res3 == true)
            {
                // Query Executed and Food Updated:
                $_SESSION['update'] = "<div class='success'>Food is Updated Successfully</div>";
                // Redirect to the http:localhost/food-order/admin/manage-food.php
                echo "<script>window.location.href='http://localhost/food-order/admin/manage-food.php';</script>";
                exit();
            }
            else{
                // Failed to Update the Food:
                $_SESSION['update'] = "<div class='error'>Failed to Update the Food</div>";
                // Redirect to the http:localhost/food-order/admin/maange-food.php
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();

            }
            // Redirect to Manage Food with the Session Message:
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
