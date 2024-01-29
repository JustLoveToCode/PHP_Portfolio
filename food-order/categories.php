<!-- Include the Partial File for the Navigation Menu -->
<?php include('partials-front/menu.php')?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            // Display all the Categories that are active using the SQL Query:
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
            // Execute the Query:
            $res = mysqli_query($conn, $sql);

            // Count the Rows:
            $count = mysqli_num_rows($res);

            // Check whether the Categories are Available or not:
            if($count>0)
            {
                // Categories is Available
                // Using the while Loop to fetch the Data from mySQL DataBase Management:
                while($row=mysqli_fetch_assoc($res))
                {
                    // Get the Values from the DataBase Management in mySQL DataBase:
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                   
                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                        <?php 
                            if($image_name == "")
                            {
                                // Image is Not Available:
                                echo "<div class='error'>Image is Not Found</div>";
                            }   
                            else 
                            {
                                // Image is Available:
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">;
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
                // Categories is Not Available
                echo "<div class='error'>Categories Not Found.</div>";
            }

            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<!-- Include the Partial Files for the Footer -->
<?php include('partials-front/footer.php');?>