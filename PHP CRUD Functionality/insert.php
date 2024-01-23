<!-- Inserting the Data into the DataBase Management -->

<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';
$DATABASE='phptutorial';

$con=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD,
$DATABASE);

if($con){
   $sql = "insert into `data`(username, email) values(
    'tower','tower@hotmail.com')";
    $queryexecute=mysqli_query($con, $sql);
    if($queryexecute){
        echo "Data is Inserted Successfully";
    } else{
        die(mysqli_error($con));
    }
} else{
    die(($con));
}