<!-- a php file which can be included to get access to the connected SQL database -->
<?php
    $host = "sql1.njit.edu";
    $username = "gr";
    $password = "3bm3bmchtr-NJIT";
    $dbname = "mysql:host=$host;dbname=$username";
    
    try {
        $db = new PDO($dbname, $username, $password);
        echo '<script> alert("Connected successfully") </script>';
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>