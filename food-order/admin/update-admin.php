<!-- constants.php is already included in the menu.php -->
<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
            <br/>
            <br/>

        <?php
        // Get the ID of the Selected Admin:
        $id = $_GET['id'];
        // Create SQL Queries to get the Details:
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        // Execute the SQL Queries:
        $res = mysqli_query($conn, $sql);

        // Check whether the Query is Executed or Not:
        if($res == true){
            // Check whether the Data is Available or Not
            // by counting the Number of the rows:
            $count = mysqli_num_rows($res);
            // Check Whether we have the Admin Data or Not
            if($count == 1){
                // Get the Details
                // echo "Admin Available";
                // Fetching the Data using the mysqli_fetch_assoc:
                $row=mysqli_fetch_assoc($res);
                // This is the Column Name that will match the mySQL Database Management:
                $full_name = $row['full_name'];
                $username = $row['username'];

            } else{
                // Redirect the User to Manage Admin Page:
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }


        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>UserName:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- The value is hidden, hence it will not be shown -->
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
// Check whether the Submit Button is Clicked or Not Clicked:
if(isset($_POST['submit'])){
// Get all the Values from the form to update:
    // We are passing the values through the form
    // Hence it is a POST METHOD:
    $id = $_POST['id'];
    $full_name=$_POST['full_name'];
    $username =$_POST['username'];

    // Create the SQL Queries:
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id=$id
    ";

    // Execute the Queries:
    $res = mysqli_query($conn,$sql);

    // Check Whether the Queries Executed
    // Successfully or not:
    if($res == true){
        // Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        // Redirected if it is Successful
        header('location:'.SITEURL.'admin/manage-admin.php');
        die();
    } else{
        //Failed to Update the Admin:
        $_SESSION['update'] = "<div class='error'>There is a problem Updating, Please try again</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        die();
    } 
}

?>
<?php include('partials/footer.php');?>