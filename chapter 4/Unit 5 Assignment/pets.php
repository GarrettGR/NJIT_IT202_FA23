<?php
    //connection info for database
    $host = "sql1.njit.edu";
    $username = "grg";
    $password = "3bm3bmchtr-NJIT";
    $dbname = "mysql:host=$host;dbname=$username";

    // $host = "127.0.0.1:3306"; //use :3307 if XAMPP SQL (MariaDB) server instead
    // $username = "root";
    // $password = '3bm3bmchtrMS';
    // $name = "it202";
    // $dbname = "mysql:host=$host;dbname=$name";

    // $options = [
    //     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //     PDO::ATTR_EMULATE_PREPARES   => false,
    // ];

    //try to connect to the database, otherwise throw an error and allow for return to home
    try {
        $db = new PDO($dbname, $username, $password);
        echo '<script> alert("Connected successfully") </script>';
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo '<button onclick="window.location.href = \'index.php\';">Return to Home Page</button> <br>';
        die("An error occurred while connecting to the database: " . $error_message);
    }

    // $statement = $db->query("SELECT breadCategoryID, breadCode, breadName, description, price FROM bread");
    // $data = $statement->fetchAll();

    //query statement to get all data from the bread table and join it with the breadCategories table
    $statement = $db->query("SELECT breadCategoryName, breadCode, breadName, description, price FROM breadCategories INNER JOIN bread ON breadCategories.breadCategoryID = bread.breadCategoryID");
    $data = $statement->fetchAll();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hartrum's Pet Shop - Pet List</title>

        <!-- metadata -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Garrett Gonzalez-Rivas">
        <meta name="description" content="Pet shop website">
        <meta name="keywords" content="Pet, Store, Pet Store">


        <!-- linked and local styling -->
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:no-preference)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:dark)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:light)">
        <link rel = 'stylesheet' href = 'style.css'>
        
        <style>
            .dataTable {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 10px;
                width: 100%;
            }

            .dataTable th {
                text-align: center;
                border: 1px solid black;
                padding: 10px;
            }

            .dataTable td {
                text-align: center;
                border: 1px solid black;
                padding: 10px;
            }
        </style>
        
    </head>
    <body>
        <!-- including the header -->
        <span><?php $page = 'pets'; include_once('header.php'); ?></span><br>
        <main>
          
        <h1> Our Pets: </h1>

        <!-- table to display the data from the database -->
        <table class = "dataTable">
                <tr>
                    <th>bread category name </th>
                    <th>bread code</th>
                    <th>bread name</th>
                    <th>description</th>
                    <th>price</th>
                </tr>

        <!-- loop through the data from SQL table -->
        <?php foreach($data as $row):?>
            <tr>
                <td><?php echo $row['breadCategoryName']; ?></td>
                <td><?php echo $row['breadCode']; ?></td>
                <td><?php echo $row['breadName']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
            <tr>
        <?php endforeach; ?>

        </table>

        </main>
        <!-- include the footer -->
        <span><?php include_once('footer.php'); ?></span><br>
    </body>
<html>