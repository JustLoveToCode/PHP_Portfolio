<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';

$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD);
if($con){
    
    $sql = "create database `phptutorial`";
    $queryexecute = mysqli_query($con,$sql);
    if($queryexecute){
        echo "Successfully create the DataBase";
    } else{
        die(mysqli_error($con));
    }
}
else{
    die(mysqli_error($con));
}
?>