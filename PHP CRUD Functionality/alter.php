<!-- Altering the Table -->

<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';
$DATABASE='phptutorial';

$con =mysqli_connect($HOSTNAME,$USERNAME,
$PASSWORD, $DATABASE);
if($con){
    
   $sql = "alter table `data` add email VARCHAR(100)";
   $queryexecute = mysqli_query($con, $sql);
   if($queryexecute){
    echo "Table Altered Successfully Here";
   } else{
    die(mysqli_error($con));
   }
}
else{
    die(mysqli_error($con));
}

?>
