<?php include('partials-front/menu.php');?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
             // Get the Search Keyword using the POST Keyword:
             // Old Query $search = $_POST['search']:
             $search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            <!-- Display the Keyword once you have Search for it using mySQL DataBase Management -->
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>
        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                // SQL Query to get the Foods Based on the Search Keyword 
                // using the OR and the LIKE keyword:
                // This Search Keyword will match either the title or the description:
                // SQL Injection for Hacker:
                // $search = burger' DROP Database name;--This will Delete our DataBase in mySQL:
                // "SELECT * FROM tbl_food WHERE title like '%burger'%' OR description LIKE '%burger'%'"
                $sql= "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute the Query:
                $res = mysqli_query($conn, $sql);

                // Count the Number of the Rows:
                $count = mysqli_num_rows($res);

                // Check whether the food Available or Not
                if($count>0){
                    // Food is Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Getting the Details Here:
                        $id = $row['id'];
                        $title= $row['title'];
                        $price=$row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                    // Check whether the Image Name is Available or Not:
                                    if($image_name==""){
                                        // Image is Not Available
                                        echo "<div class='error'>Image is Not Available</div>";
                                    }
                                    else{
                                        // Image is Available
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" 
                                        alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }

                                    ?> 
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title?></h4>
                                <p class="food-price"><?php echo $price?></p>
                                <p class="food-detail">
                                    <?php echo $description?>
                                </p>
                                <br>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php

                    }

                } else{
                    // Food is Not Available
                    echo "<div class='error'>Food Not Found</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>