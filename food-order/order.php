<!-- Creating the partials-front folder with the menu.php-->
<?php include('partials-front/menu.php')?>

<?php 
// Check whether the Food id is set or not:
if(isset($_GET['food_id']))
{
    //Get the Food Id and Details of the Selected Food:
    $food_id = $_GET['food_id'];
    //Get the Details of the Selected Food:
    $sql = "SELECT * from tbl_food WHERE id=$food_id";
    // Execute the Query:
    $res = mysqli_query($conn, $sql);
    // Count the Rows:
    $count = mysqli_num_rows($res);
    // Check whether the Data is Available or Not:
    if($count==1){
        // We have the Available Data:
        // Get the Data from the DataBase Management:
        // This function will fetch the next row from the result set
        // represented by the $res and return it as the Associative Array.
        // Each key in the Array correspond to the Column Name from the result set
        // and the Array Values contain the Corresponding Data for Each Column in the Current Row:
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else{
        // Food is Not Available:
        // Redirect to the HomePage:
        header('location:'.SITEURL);
        die();
    }
}
else{
    // Redirect the User to the Home Page:
    header('location:'.SITEURL);
    die();
}
?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <!-- Using the method="POST" -->
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        // Check whether the Image is Available or Not:
                        if($image_name == ""){
                            // Image is Not Available Here:
                            echo "<div class='error'>Image is Not Available</div>";
                        }
                        
                        else{
                            // Image is Available Here:                           
                            ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" alt="Chicken Hawaii Pizza" 
                           class="img-responsive img-curve">
                           <?php
                        }
                        ?>
                    /div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price">$<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            // Check whether the Submit Button is Clicked or Not:
            if(isset($_POST['submit']))
            {
                // If the Submit Button is Clicked:
                // Get all the Details from the Form:
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                // Total is Equal to Price Multiply by the Quantity:
                $total = $price * $qty;
                // Y is the Year, m is the Month, d is the Day
                // h is the Hour and i is the Minutes
                // s is the Seconds for the time in Seconds
                // a is the Am or Pm:
                // This is the Order Date and it will get the Current Date and Time:
                $order_date = date("Y-m-d h:i:sa");
                // Ordered, On Delivery, Delivered, Cancelled:
                $status = "Ordered"; 
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // Save the Order into the DataBase Management in mySQL DataBase:
                // Create the SQL Query to save the Data into the mySQL DataBase:
                $sql2 = "INSERT INTO tbl_order SET
                -- Add the Columns Here for the SQL DataBase Management:
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address='$customer_address'
                ";

                // Execute the Query Here:
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the Query is Successfully Executed or Not:
                if($res2==true){
                    // Query is Executed and Order is Saved:
                    // Using 2 CSS classes which is the class of success and text-center:
                    $_SESSION['order'] = "<div class='success text-center'>Food Order is Placed Successfully.</div>";
                    header('location:'.SITEURL);
                    die();
                }
                else{
                    // Failed to Save the Order:
                    // Using 2 CSS classes which is the class of error and text-center:
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order the Food. Please Try Again.</div>";
                    header('location:'.SITEURL); 
                    die();
                }
            }
            ?>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



<!-- Creating the partial-front Folder with the footer.php file -->
<?php include('partials-front/footer.php');?>