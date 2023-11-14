<!-- a php file which can be included to get access to the connected SQL database -->
<?php
    //setting up database connection variables
    $host = "sql1.njit.edu";
    $username = "grg";
    $password = "3bm3bmchtr-NJIT";
    $dbname = "mysql:host=$host;dbname=$username";
    
    try {
        //connecting to the database
        $db = new PDO($dbname, $username, $password);
        // echo '<script> alert("Connected successfully") </script>';
    } catch (PDOException $e) {
        //displaying an error message if the connection fails
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>