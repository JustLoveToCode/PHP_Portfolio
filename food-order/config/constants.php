<?php
    // Start the Session:
    session_start();

    // Create Constants to store Non Repeating Values DRY:
    // Constants Name are CAPITAL LETTERS:
    define("SITEURL", 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'food-order');
    // Execute the Query and Save the Data into the DataBase Management:
    // Creating the Connection Here for the LOCALHOST, DB_USERNAME or DB_PASSWORD:
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    // Selecting the DataBase Management:
    $db_select=mysqli_select_db($conn, DB_NAME) or die(sqli_error());
    ?>