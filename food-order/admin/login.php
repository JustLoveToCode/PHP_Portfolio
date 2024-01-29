<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login-Food Order System</title>
        <link rel='stylesheet' href='../css/admin.css'>
    </head>

    <body>
        <!-- This is the width of 20% on the login div -->
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br/><br/>
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            ?>
            <br/>
            <br/>
            <!-- Login Form Start Up -->
            <form action="" method="POST" class="text-center">
                Username:<br/>
                <input type="text" name="username" placeholder="Enter Your Username" class="text-center"><br/><br/>
            
                Password:<br/>
                <input type="password" name="password" placeholder="Enter Your Password" class="text-center"><br/><br/>

                <input type='submit' name="submit" value="Login" class="btn-primary">
                <br/><br/>
            </form>
            <!-- Login Form End Here -->
            <p class="text-center">Created By-<a href="www.google.com">Developer Architect</a></p>
        </div>
    </body>
</html>

<?php
    // Check Whether the Submit Button is Clicked or Not:
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data for Login Form Here:
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        // Encrypt the Password
        // $password = md5($_POST['password']);
        $raw_password=md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,$raw_password);

        //2. SQL Queries to check whether the User with the username and password actually exist or not
        // from the DataBase Management by Tally what the username and password is equal to
        // what the user has key into the form: tbl_admin is the DataBase Table:
        $sql = "SELECT * from tbl_admin WHERE username='$username' AND password='$password'";

        // Execute the SQL Queries:
        $res = mysqli_query($conn, $sql);

        // Count rows to check whether the User exist or not:
        $count = mysqli_num_rows($res);

        // Check whether the User actually exist or not:
        if($count==1){
            // User is Available and Login is Successful
            $_SESSION['login'] = "<div class='success'>Login is Successful</div>";
            // Check whether the User is Logged In or Not and Logout will Unset It:
            $_SESSION['user'] = $username;

            // Redirect to the Home Page:
            header('location:'.SITEURL.'admin/index.php');
        } else{
            // User Not Available and Login Fail:
            $_SESSION['login'] = "<div class='error text-center'>Login Failed, Please Try Again</div>";
            header('location:'.SITEURL.'admin/login.php');
            die();

        }


  
    }

?>