<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br/>
        <?php
        // Check whether the id is set or not in the URL:
        if(isset($_GET['id']))
        {
            // Get the Order Details Here:
            $id=$_GET['id'];
            // Get all the Order Details using 
            // SQL Query to get the Order Details using the WHERE keyword:
            $sql = "SELECT * FROM tbl_order where id=$id";

            // Execute the SQL Query:
            $res = mysqli_query($conn, $sql);

            // Count the Rows:
            $count =mysqli_Num_rows($res);
            // If the count is equal to 1, it mean that the Data is Available:
            if($count==1){
                // The Details is Available:
                // Fetch the Row of Data from the mySQL DataBase Management:
                // using mysqli_fetch_asoc($res) Method:
                // Getting the Different Data from the Different Columns Respectively:
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            }
            else{
                // Details is Not Availble:
                // Redirect to the Manage Order Page:
                header('location:'.SITEURL.'admin/manage-order.php');
                die();
            }
        }
        else{
            // Redirect to the Manage Order Page:
            header('location:'.SITEURL.'admin/manage-order.php');
            die();
        }
        ?>
        <form action="" Method="POST">
            <table class="tbl-30">
                <tr>
                    <!-- Displaying the Food Name: -->
                    <td>Food Name:</td>
                    <td><b><?php echo $food;?></b></td>
                </tr>
                <tr>
                    <!-- Displaying the Price -->
                    <td>Price:</td>
                    <td><b>$<?php echo $price;?></b></td>
                </tr>
                <tr>
                    <!-- Displaying the Quantity -->
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <!-- Displaying the Different Options: -->
                    <td>Status:/td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="on Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>   
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option> 
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>  
                        </select>
                    </td>
                </tr>
                <tr>
                    <!-- Displaying the Customer Name: -->
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>
                <tr>
                    <!-- Displaying the Customer Contact: -->
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>
                <tr>
                    <!-- Displaying the Customer Email: -->
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>
                <tr>
                    <!-- Displaying the Customer Address: -->
                    <td>Customer Address:</td>
                    <textarea name="customer_address" cols="30" rows="5">
                        <?php echo $customer_address;?>
                    </textarea>
                </tr>
                <tr>
                    <!-- Displaying the input of type "submit" and value="Update Order"-->
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the Update Button is CLicked or Not:
        if(isset($_POST['submit']))
        {
            // Get all the Values from the Form:
            $id=$_POST['id'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $total = $price * $qty;
            $status= $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address=$_POST['customer_address'];

            // Update the Values:
            $sql2 = "UPDATE tbl_order SET
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address='$customer_address'
            WHERE id = $id
            ";

            // Execute the Query:
            $res2 = mysqli_query($conn, $sql2);
            // Check whether it is Updated or Not
            // And Redirect to the Manage Order with the Message:
            if($res2==true){
                // Updated Successfully
                $_SESSION['update'] ="<div class='success'>The Order is Updated Successfully</div>";
                echo "<script>window.location.href='http://localhost/food-order/admin/manage-order.php';</script>";
            }
            else{
                // Failed to Update the Data:
                $_SESSION['update'] = "<div class='error'>Failed to Update the Order</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }

        ?>
    </div>
</div>


<?php include('partials/footer.php');?>