<!-- Displaying All the Data -->

<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = 'root';
$DATABASE = 'phptutorial';

$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if ($con) {
    // This is using the SQL Method by Select * FROM `data`;
    $sql = "SELECT * FROM `data`";
    // Using the mysqli_query($con,$sql) Here:
    $queryexecute = mysqli_query($con, $sql);
    // If the $queryexecute exist:
    if ($queryexecute) {
        $numRows = mysqli_num_rows($queryexecute);
        // If the $numRows is greater than 0:$numRows>0:
        if ($numRows > 0) {
            // Start the table outside the loop:
            // Create the Table Row with the Table Heading
            // which is the ID, Name and the Email:
            echo '<table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>';
            // Using the While Loop to Iterate Through the $queryexecute Method Here:
            while ($row = mysqli_fetch_assoc($queryexecute)) {
                // Output each row inside the loop:
                echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['email'] . '</td>
                    </tr>';
            }
            // Close the table after the loop
            echo '</table>';
        } else {
            echo "No data found";
        }
    } else {
        die(mysqli_error($con));
    }
} else {
    die(mysqli_connect_error());
}
?>