<?php include('partials/menu.php');?>

       
        <!-- Main Content Section Start -->
        <div class="main-content">
            <!-- Putting the div with the wrapper class -->
            <div class="wrapper">
                <h1>DashBoard</h1>
                <br/>
                <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <br/>

                <div class="col-4 text-center">
                    <?php 
                    // Create the SQL Query:
                    $sql = "SELECT * FROM tbl_category";
                    // Execute the Query:
                    $res = mysqli_query($conn,$sql);
                    // Count the Number of the Rows in the DataBase Management:
                    // Count the Number of the Rows:
                    $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count;?></h1>
                    <br/>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                    // Create the SQL Query:
                    $sql2 = "SELECT * FROM tbl_food";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2=mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2?></h1>
                    <br/>
                    Foods
                </div>

                <div class="col-4 text-center">
                    <?php
                    $sql3 = "SELECT * from tbl_order";
                    $res3 = mysqli_query($conn,$sql3);
                    $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3?></h1>
                    <br/>
                    Total Order
                </div>

                <div class="col-4 text-center">
                    <?php 
                    // Create the SQL Query to Get the Total Revenue Generated:
                    // Using the Aggregate Function in mySQL Function using the Sum Keyword:
                    // for that Particular Column which is called total Column using AS keyword as the Alias Name:
                    // using the WHERE keyword as the Conditional Operator:
                    // The reason is because only when it is Delivered, then the business will receive the Payment:
                    $sql4 = "SELECT SUM(total) AS Total from tbl_order WHERE status='Delivered'";

                    // Execute the Query using mysqli_query Here:
                    $res4 = mysqli_query($conn, $sql4);
                    // Fetch the Single Row of the Result:
                    // from the mySQL DataBase Management:
                    // Return as the Associative Array Keys Correspond
                    // to the Column Names and the Values Correspond to the
                    // Data in those Columns for the Fetched Row:
                    $row4 = mysqli_fetch_assoc($res4);
                    // If $row4 actually have Data and it is Not Equal to Null:
                    if ($row4 !== null && $row4['Total'] !== null) {
                        $total_revenue = $row4['Total'];
                    } else {
                        $total_revenue = 0;
                    }
                    ?>
                    <h1>$<?php echo $total_revenue?></h1>
            
                    <br/>
                   Revenue Generated
                </div>

                <!-- This create the float:none and clear:both
                to move the next div to the next line -->
                <div class="clearfix">

                </div>
                
            </div>
        </div>
        <!-- Main Content Section End -->

<?php include('partials/footer.php');?>