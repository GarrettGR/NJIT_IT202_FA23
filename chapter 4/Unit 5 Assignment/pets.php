<?php
    // $host = "sql1.njit.edu";
    // $username = "grg";
    // $password = "3bm3bmchtrNJIT";
    // $dbname = "mysql:host=sql1.njit.edu;dbname=grg";

    $host = "localhost:3306"; //use :3307 if XAMPP SQL (MariaDB) server instead
    $username = "root";
    $password = "3bm3bmchtrMS";
    $name = "it202";
    $dbname = "mysql:host=$host;dbname=$name";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $db = new PDO($dbname, $username, $password, $options);
        echo '<script> alert("Connected successfully") </script>';
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo '<button onclick="window.location.href = \'index.php\';">Return to Home Page</button> <br>';
        die("An error occurred while connecting to the database: " . $error_message);
    }

    $statement = $db->query("SELECT breadCategoryID, breadCode, breadName, description, price FROM bread");
    $data = $statement->fetchAll();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hartrum's Pet Shop - Pet List</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Garrett Gonzalez-Rivas">
        <meta name="description" content="Pet shop website">
        <meta name="keywords" content="Pet, Store, Pet Store">

        <link rel = 'stylesheet' href = 'style.css'>

    </head>
    <body>
        <span><?php $page = 'pets'; include_once('header.php'); ?></span><br>
        <main>
          
        <h1> Our Pets: </h1>

        <table class = "data">
                <tr>
                    <th>bread category name </th>
                    <th>bread code</th>
                    <th>bread name</th>
                    <th>description</th>
                    <th>price</th>
                </tr>

        <?php foreach($data as $row){
            echo "<tr>";
            foreach($row as $column){
                echo "<td style='text-align:center'>$column</td>";
            }
            echo "</tr>";
        } ?>

        </table>

        </main>
        <span><?php include_once('footer.php'); ?></span><br>
    </body>
<html>