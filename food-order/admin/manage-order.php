<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

            <br/>
            <br/>
            <br/>
            <?php
            // This is the Message that will be Displayed
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>

            <br/><br/>

            <table class="tbl-full">
                <tr>
                    <!-- Creating the Table Heading -->
                    <th>Serial Number</th>
                    <th>Food</th>
                    <th>Price </th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Get all the Orders from the DataBase:
                // Since we want to Order in the Descending Order
                // from the Latest Order to the Earlier Order
                // We use the ORDER BY Keyword and the DESC:
                // Display from the Latest Order at the Very Start:
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                // Execute the Query
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                // Create the Serial Number and set the Initial Value as 1:
                $sn=1; 
                // If the $count is greater than 0:
                // It mean that there is Data Available:
                if($count>0){
                    // Order is Available
                    // Using the while Loop to fetch the Data:
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get all the Orders Details Here for the Different Columns:
                        // from the SQL DataBase Management using $row['column'] Format:
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status=$row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address=$row['customer_address'];
                        // Break the PHP
                        ?>
                        <!-- Display the Data in the Single Row Here -->
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td>
                                <?php
                                // Create the Different Color Status for the Different Order Status:
                                if($status == "Ordered"){
                                    echo "<label>$status</label>";
                                }
                                elseif($status == "On Delivery"){
                                    echo "<label style='color:orange;'>$status</label>";
                                }
                                elseif($status == "Delivered"){
                                    echo "<label style='color:green;'>$status</label>";
                                }
                                elseif($status=="Cancelled"){
                                    echo "<label style='color:red;'>$status</label>";
                                }
                                ?>
                            </td>
                            <td><?php echo $status;?></td>
                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact;?></td>
                            <td><?php echo $customer_email;?></td>
                            <td><?php echo $customer_address;?></td>
                            <td>
                                <a href="<?php echo SITEURL?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>
                        <!-- Starting the PHP Again -->
                        <?php
                    }
                }
                else{
                    // Order is Not Available
                    echo "<tr<td colspan='12' class='error'>Orders is Not Available</td></tr>";
                }

                ?>
            </table>

        
    </div>
</div>

<!-- Adding the Footer from the partials Folder -->
<?php include('partials/footer.php')?>