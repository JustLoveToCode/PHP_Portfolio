<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/>
        <br/>
        <?php
        // Creating the Session for add:
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        // Creating the Session for remove:
        if(isset($_SESSION['remove']))
        {
            echo($_SESSION['remove']);
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
 
        

        ?>
        <br/>

            <!-- Button to Add the Admin -->
            <!-- echo SITEURL will create http://localhost/food-order/ and then
            the admin/add-category.php is added followed after -->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>

            <br/>
            <br/>
            <br/>
            <br/>

            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Image </th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Query to get all the Categories from the DataBase MySQL
                $sql = "SELECT * FROM tbl_category";

                // Execute the Query:
                $res=mysqli_query($conn, $sql);

                // Count the Rows:
                $count =mysqli_num_rows($res);

                // Create the Serial Number Variable and Assign Value as 1:
                $sn = 1;


                // Check Whether we have the Data in the DataBase mySQL:
                if($count>0){
                    // We have the Data in the DataBase Management:
                    // Get the Data and display it using the while Loop as
                    // long as we have data in the DataBase Management:
                    while($row=mysqli_fetch_assoc($res))
                    {
                    // Getting the Individual rows of the data 
                    // from the mySQL DataBase Management:
                        $id=$row['id'];
                        $image_name=$row['image_name'];
                        $title =$row['title'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                            <tr>
                                <td><?php echo $sn++;?> </td>
                                <td><?php echo $title;?></td>

                                <td>
                                    <?php 
                                    // Check whether the image name is Available or Not:
                                    if($image_name!=""){
                                        //Display the Image and Resizing the image to be width="100px":
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"
                                        width="100px">
                                        <?php


                                    } else{
                                        //Display the Image:
                                        echo "<div class='error'>Image Not Added</div>";
                                    }
                                    ?>
                                </td>

                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                    <!-- This is the GET Method for getting the URL and the Image Name -->
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&
                                    image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                        <?php
                    }
                } else{
                    // We do not have the Data in the DataBase Management:
                    // We will display the Message inside the Table
                    // Break the PHP:
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="error">No Category Added Here</div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
    </div>
</div>

<?php include('partials/footer.php');?>