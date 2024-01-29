<!-- Create the Partial for the menu.php File -->
<?php include('partials-front/menu.php');?>

<?php
// Check whether the id is passed or not:
if(isset($_GET['id']))
{
    // Category Id is set and get the id:
    $category_id = $_GET['category_id'];
    // Get the Category title based on the Category Id using the Specific Column Name:
    $sql = "SELECT title from tbl_category WHERE id=$category_id";

    // Execute the Query:
    $res = mysqli_query($conn, $res);

    // Get the Value from the DataBase Management:
    $row = mysqli_fetch_assoc($res);
    // Getting the $row['title'] and storing it as the $category_title Variable:
    $category_title = $row['title'];



}
else{
    // Category not passed:
    // Redirect to the Home Page:
    header('location:'.SITEURL);

}

?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?> "</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            // Create SQL Query to get the foods based on the Selected Category:
            $sql2 = "SELECT * from tbl_food WHERE category_id=$category_id";

            // Execute the Query Here: 
            $res2 = mysqli_query($conn, $sql2);

            // Count the Number of Rows:
            $count2  = mysqli_num_rows($res2);

            // Check whether the Food is Available or not:
            if($count2>0)
            {
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    // Getting all the Data from mySQL DataBase Management
                    // and display all of the Data:
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // If the $image is Not Available:
                            if($image == "")
                            {
                                // Image is Not Available
                                echo "<div class='error'>Image is Not Available</div>";
                            }
                            // else display the Image that is Available:
                            else{
                                // Image is Available
                                ?>
                                <!-- Getting the Image Based on the Selected Category: -->
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" 
                                alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>   
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?> </h4>
                            <p class="food-price">$2<?php echo $price;?></p>
                            <p class="food-detail">
                                <?php echo $description;?>
                            </p>
                            <br>
                            <a href="<?php SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else{
                // Food is Not Available:
                echo "<div class='error'>Food is Not Available.</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->

<!-- Create the Partial for the footer.php -->
<?php include('partials-front/footer.php');?>