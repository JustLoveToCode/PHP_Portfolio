<!-- Deleting the Data -->
<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';
$DATABASE='phptutorial';

$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,
$DATABASE);

if($con){
  $sql = "delete from `data` where `id` = '1'";
  $queryexecute = mysqli_query($con, $sql);
  if($queryexecute){
    echo "Deleted Data Successfully";
  } else{
    die(mysqli_error($con));
  }
} else{
    die(mysqli_error($con));
}


?>

