<!-- Creating the Partial File for the menu.php file -->
<?php  include('partials-front/menu.php');
?>

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
    <?php
    if(isset($_SESSION['order']))
    {
        // The Message will be Ouput
        echo $_SESSION['order'];
        // This will remove the Message after the Website Page Refresh:
        unset($_SESSION['order']);
    }

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
        <!-- Create the SQL Query to get the Data or Categories from the DataBase Management -->
        <!-- Using the LIMIT keyword to LIMIT only 3 Data from the DataBase Management 
        using the WHERE keyword to set the image and text based on a Specific Conditions-->
            <?php
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' and featured='Yes' LIMIT 3";

            //Execute the Query Here:
            $res = mysqli_query($conn, $sql);

            // Count the Numbers of the Rows Here to check
            // whether the Categories actually exist:
            $count = mysqli_num_rows($res);

            if($count>0){
                // Using the while Loop to fetch the Data
                // in the Particular $row:
                while($row=mysqli_fetch_assoc($res))
                {
                    // Get the Value like title, image_name and id
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                     <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php 
                            // Check whether the Image is Available or not:
                            if($image_name=="")
                            {
                                //Display the Message
                                echo "<div class='error'>Image is Not Available</div>";
                            }
                            else{
                                // Image is Available:
                                // Close the PHP and create the HTML:
                                ?>
                                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" 
                                alt="Pizza" class="img-responsive img-curve">
                                <!-- Open the PHP again -->
                                <?php
                            }
                            ?> 
                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php

                }

            }
            else{
                // Categories is Not Available:
                echo "<div class='error'>Categories is Not Added</div>";
            }
        
            ?>
           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            // Getting the Foods from the DataBase Management that are active and featured:
            // SQL Query:
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            // Execute the Query:
            $res2 = mysqli_query($conn, $sql2);

            // Count the Number of the Rows:
            $count2 = mysqli_num_rows($res2);

            // Check whether the Food is Available or Not:
            if($count2>0)
            {
                // Get all the Values Here:
                while($row=mysqli_fetch_assoc($res2))
                {
                    // Get all the Values Here:
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    // Closing the PHP Tags:
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            // Check whether the Image are Available or Not
                            // In this case, if statement for the Image is Not Available:
                            if($image_name=="")
                            {
                                //Image is Not Available:
                                echo "<div class='error'>Image is Not Available</div>";
                            } else{
                                //Image is Available:
                               ?>
                                <img src="<?php SITEURL;?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                               <?php
                            }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?> </h4>
                            <p class="food-price">$<?php echo $price;?></p>
                            <p class="food-detail">
                            <?php echo $description;?>
                            </p>
                            <br>
                            <!-- This Anchor Tag will direct you to the Order Form -->
                            <!-- Using the Query Parameters to Pass the food_id -->
                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" 
                            class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <!-- Opening the PHP Tags Here -->
                    <?php
                }  
            }
            else{
                // Food is Not Available
                echo "<div class='error'>Food is Not Available</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

<!-- Creating the Partial Folder for the footer.php -->
<?php 
include('partials-front/footer.php');?>