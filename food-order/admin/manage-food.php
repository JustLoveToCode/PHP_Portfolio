<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br/>
            <br/>
            <!-- Button to Add the Admin -->
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
            
            <br/>
            <br/>
            <br/>
            <br/>

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);

            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>

            <table class="tbl-full">
                <!-- Create the Different Table Row with the Different Table Data -->
                <!-- Creating the Table Row for the Table Data -->
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Create the SQL Query to Get All the Foods:
                // and store it in the Variable $sql:
                $sql = "SELECT * FROM tbl_food";
                // Execute the Query using mysqli_query():
                $res = mysqli_query($conn, $sql);

                // Count the Number of the Rows to Check whether we have the Row Data or Not
                $count = mysqli_num_rows($res);
                // Create the Serial Number Variable and Set the Default Value as 1:
                $sn = 1;
                if($count>0)
                {
                    // We have food in the DataBase
                    // Get the food from the DataBase and Display them:
                    while($row =mysqli_fetch_assoc($res))
                    {
                        // Get the Values from the Individual Columns in the mySQL DataBase Management:
                        $id=$row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        // This is Breaking the PHP
                        ?>
                        <!-- This is starting the PHP again -->
                        <!-- Create the Different Table Row with the Different Table Data -->
                        <tr>
                            <!-- Using the echo Method to echo the $sn, $title and the $price -->
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $price;?></td>

                            <td>
                                <?php 
                                // Check whether we have the Image Name or Not:
                                if($image_name==""){
                                    // We do not have the Image Name, Display the Error Message:
                                    echo "<div class='error'>Image Not Displayed</div>";
                                }
                                else{
                                // We have the Image, Display the Image:
                                ?>
                                <!-- Create the Path and Attach the Image to the food Folder Here -->
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="200px">
                                <?php

                                }
                                
                                ?>
                            </td>

                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id?>&image_name=<?php

                                ?>" class="btn-secondary">Update Food</a>
                                <!-- This is the Full URL String Concatenation to the File-->
                                <!-- SITEURL; here is referring to http:localhost/food-order/ -->
                                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php
                                echo $image_name;
                                ?>" 
                                class="btn-danger">Delete Food</a>
                            </td>
                        </tr>
                        <?php


                    }
                }
                else{
                    // Food is Not Added in the DataBase
                    echo "<tr><td colspan='7' class='error'>Food Not Added Yet</td></tr>";
                }
                ?>

            </table>
    </div>
</div>