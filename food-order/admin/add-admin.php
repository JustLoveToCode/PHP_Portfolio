<!-- Adding the Navigation Menu from the partials Folder -->
<?php include('partials/menu.php');?>



<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>
        <br/>

        <?php
        // Checking whether the Session is Set or Not:
        if(isset($_SESSION['add'])){
            // Display the Session Message:
            echo $_SESSION['add'];
            // Remove the Session Message:
            unset($_SESSION['add']);
        }
        
        ?>

        
<!-- Creating the form of the method called "POST" here -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>UserName:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your UserName">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>

                </tr>
            </table>    
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>

<?php
    // Process the Value from Form and Save it in the DataBase Management:
    // Check whether the Submit Button is Clicked or Not:
    // Check whether the value on submit is passed using the Post Method
    // or Not:
    // Using the Post Method to Submit the Data:
    if(isset($_POST['submit']))
    {   
       // Get the Data from the Form Here:
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       // This is the Password Encryption with the MD5:
       // This is One Way Encryption of the Password:
       // And it cannot be Decrypted:
       $password = md5($_POST['password']);

       // Creating the SQL Queries to save the
       // Data into the DataBase Management called the tbl_admin Table:
       // Use the INSERT Method to Insert into the DataBase Management:
       // Using the INSERT INTO to Add the Data and 
       // SET the Data inside the DataBase Management:
       $sql = "INSERT INTO tbl_admin SET
       full_name='$full_name',
       username='$username',
       password='$password'
       ";
       
    // Executing Query and Serving the Data into the DataBase:
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Check whether the (Query is Executed) is inserted or not
    // and display the Appropriate Message
    if($res == true){
        // Data is inserted and Message is Displayed:
        // echo "Data is Inserted";
        // Create a Session Variable to display the Message:
        $_SESSION['add'] = "Admin Added Successfully";
        // Redirect the Page to Mange Admin
        // SITEURL is the Home URL:
        header("location:".SITEURL."/admin/manage-admin.php");
        die();
    }
    else{
        // Failed to Insert the Data:
        // Create a Session Variable to display the Message:
        $_SESSION['add'] = "Failed to Add Admin";
        // Redirect the Page to Add Admin:
        header("location:".SITEURL."admin/add-admin.php");
        die();
    }
    }
?>



