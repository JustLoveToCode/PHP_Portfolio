<?php
include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/><br/>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <!-- Creating the td for the text and the input -->
                    <td>Old Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <!-- Creating the td for the text and the input -->
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>   

                <tr>
                    <!-- Creating the td for the text and the input -->
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <!-- The td will span 2 columns with 2 input type  -->
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
               

            </table>
        </form>



    </div>
</div>

<?php
// Check whether the Submit Button is Clicked or Not
if(isset($_POST['submit']))
{
  //Get the Data from the Form:
  // The $_POST['value'] and the value need to 
  // match with the name="confirm_password" or name="new_password" or 
  // name="current_password" above:
  // It is a POST method since we are submitting the form:
  $id = $_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password=md5($_POST['new_password']);
  $confirm_password=md5($_POST['confirm_password']);


  // Check Whether the User with the Current Id and Password Exist
  // or Not: Password is String, Hence it will need the single quote ' '
  // Need to check that the User have the corresponding id and password:
  // Using the SELECT to select DataBase and WHERE keyword for Conditional Statement:
  $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
  

  // Check whether the New Password and Confirm Matched:
  $res = mysqli_query($conn,$sql);

  if($res==true){
    // Check whether the Data is Available or Not:
    $count = mysqli_num_rows($res);

    if($count==1){
       // User Exist and Password can be Changed:
       if($new_password==$confirm_password){
        // Update the Password:
        $sql_2 = "UPDATE tbl_admin SET 
        password='$new_password'
        WHERE id=$id
        ";
        // Execute the Query
        $res2=mysqli_query($conn,$sql2);

        // Check whether the Query is Executed or Not:
        if($res2==true){
            //Display the Success Message:
            //Changed the Password Successfully:
            $_SESSION['change-pwd'] ="<div class='success'>Password Changed Successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else{
            $_SESSION['change-pwd'] = "<div class='error'>There is an Error, Failed to Change Password</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');

        }

       }
       else{
        // Redirect to the Manage Admin Page with the Error Message:
        $_SESSION['pwd-not-match']="<div class='error'>Password do not match</div>";
        // Redirect the User:
        header('location:'.SITEURL.'admin/manage-admin.php');
       }

     
    }
    else{
        // User does not exist, Set Message and Redirect:
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
        // Redirect the User
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

  }

  



}

?>


<?php include('partials/footer.php');?>