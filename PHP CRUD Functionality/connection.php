<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';

$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD);
if($con){
    echo "Connection Successful";
}
else{
    die(mysqli_error($con));
}
?>
