<?php include('partials/menu.php');?>
<!-- Main Content Section Starts -->
    <div class="main-content"> 
        <div class="wrapper">
            <h1>Admin</h1>
            <br/>

            <?php
            // If the $_SESSION is 'add':
            if(isset($_SESSION['add']))
            {
                // Displaying the Session Message for Add:
                echo $_SESSION['add'];
                // Removing the Display Message for Add:
                unset($_SESSION['add']);
            }
    
            if(isset($_SESSION['delete']))
            {
                // Displaying the Session Message for Delete:
                echo $_SESSION['delete'];
                // Removing the Display Message for Delete:
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user_not_found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
            ?>
            <br/>
            <br/>
            <br/>

            <!-- Button to Add the Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br/>
            <br/>
            <br/>
            <br/>

            <!-- Creating the table -->
            <table class="tbl-full">
                <!-- This is the table row data -->
                <tr>
                    <th>Serial Number</th>
                    <th>Full Name</th>
                    <th>UserName </th>
                    <th>Actions</th>
                </tr>
                <!-- This is the table Row Data -->
                <?php
                // Query to get all the Admin from the DataBase
                    $sql = "SELECT * FROM tbl_admin";
                //Execute the Query
                    $res=mysqli_query($conn,$sql);
                // Check whether the Query is Executed or Not:
                if($res==TRUE){
                    // Count Rows to Check Whether we have the 
                    // Data in the DataBase Management:
                    // Function to get all the rows in the DataBase Management:
                    $count = mysqli_num_rows($res);
                    // Check the Number of Rows where the $count > 0 greater than 0: 
                    if($count>0){
                        // We have the Data in the DataBase Management
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            // Using the while Loop to get all the Data from the 
                            // DataBase Management:
                            // While loop will run as long as we have the Data
                            // in the DataBase Management:
                            // This is the Column Name in the DataBase Management:
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];
                            // Display the Values in our Table:
                            ?>
                            <!-- Display the Data using the echo Method -->
                               <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $full_name;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" 
                                        class="btn-primary">Change Password</a>
                                        <a href="<?php
                                        echo SITEURL;
                                        ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php 
                                        echo SITEURL;
                                        ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                            </tr>   
                            
                            <?php
                        }
                    }
                    else{
                        // We do not have the DataBase Management:
                    }
                }

                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php');?>