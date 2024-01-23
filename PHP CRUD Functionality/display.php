<!-- Display the Data -->
<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='root';
$DATABASE='phptutorial';

// Getting the DataBase Connection:
$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if($con){
    // This is using the SQL to select all the Data from the data Table
    // Whatever data that is inserted in the DataBase Management:
    $sql = "Select * FROM `data`";
    $queryexecute=mysqli_query($con,$sql);
    if($queryexecute){
        // This function will count the number of rows inside the DataBase
        // and checking the Number of rows using the mysqli_num_rows Method:
        $numRows=mysqli_num_rows($queryexecute);
        if($numRows>0){
            // Fetch the Next Line of the Data Automatically:
            // This is displaying the Data One by one:
            $row=mysqli_fetch_assoc($queryexecute);
            echo $row['id'] . ". " . $row['username'] . " and " . $row['email'];
            $row['email'];
            echo "<br>";
            // Fetch the Next Line of the Data Automatically:
            // This is displaying the Data One by one:
            $row=mysqli_fetch_assoc($queryexecute);
            echo $row['id'] . ". " . $row['username'] . " and " . $row['email'];
            $row['email'];
            echo "<br>";
            // Fetch the Next Line of the Data Automatically:
            // This is displaying the Data One by one:
            $row=mysqli_fetch_assoc($queryexecute);
            echo $row['id'] . ". " . $row['username'] . " and " . $row['email'];
            $row['email'];
            echo "<br>";


        }

    }
} else{
    die(mysqli_error($con));
}

?>