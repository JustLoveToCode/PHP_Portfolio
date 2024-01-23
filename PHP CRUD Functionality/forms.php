<form action="forms.php" method="post">
<div>
<input type="text" name="username" placeholder="Enter your Name" autocomplete="off">
</div>
<br/>


<div>
<input type="email" name="email" placeholder="Enter your Email" autocomplete="off">
</div>
<br/>

<button type="submit">Submit</button>

</form>

<?php
if($_SERVER['REQUEST_METHOD'] =='POST'){
    // Inserting the 'username':
    $username=$_POST['username'];
    // Inserting the 'email':
    $email=$_POST['email'];
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='root';
    $DATABASE='phptutorial';

    $con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,
    $DATABASE);
// If the $con is successful here:
    if($con){
        
        $sql="insert into `data`(username,email) values('$username', '$email')";
        $queryexecute=mysqli_query($con,$sql);
        // Using the if statement here
        if($queryexecute){
            echo "Data Inserted Successfully";
        }
        // Using the else statement here
        else{
        die(mysqli_error($con));
        }
    }
        
    else{
        die(mysqli_error($con));
    }
} 