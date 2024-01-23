<!-- Update the Table -->
<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';
$DATABASE='phptutorial';

// Creating the Connection Here using the PHP Variables:
$con=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

// If the $con actually exist:
if($con){
// Update the Table data setting the username 
// where the value will be Updated Successfully
// using the update and set keyword Here:
   $sql = "update `data` set `username`='kanama2' where
   `username`='khana'";
   $queryexecute=mysqli_query($con,$sql);
   if($queryexecute){
// This is what you want to echo if the result is successful:
    echo "Data Updated Successfully";
   }
   else{
    die(mysqli_error($con));
   }
} else{
    die(mysqli_error($con));
}


?>