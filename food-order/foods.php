<!-- Create the Partial Folder for the menu.php-->
<?php include('partials-front/menu.php')?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // Display the Foods that are active using the SQL Query:
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

            // Execute the Query:
            $res = mysqli_query($conn, $sql);

            // Count the Rows:
            $count = mysqli_num_rows($res);

            // Check whether the Foods are Available or not:
            if($count>0)
            {
                //Foods are Available
                while($row= mysqli_fetch_assoc($res))
                {
                    // Get the Values Here from the SQL Table:
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            // Check whether the Image is Available or Not:
                            if($image_name=="")
                            {
                                // Image is Not Available:
                                echo "<div class='error'>Image is Not Available</div>";

                            }
                            else{
                                // Image is Available:
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" 
                                alt="Chicke Hawain Pizza" 
                                class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                       
                        </div>

                         <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                              <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>"class="btn btn-primary">Order Now</a>
                        </div>
            </div>
                    <?php
                }
            }
            else{
                //Foods are Not Available
                echo "<div class='error'>Food is not Found</div>";
            }
            ?>  
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->

<!-- Creating the Partial Folder for Footer -->
<?php include('partials-front/footer.php');?>