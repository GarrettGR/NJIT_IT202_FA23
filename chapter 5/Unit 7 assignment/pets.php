<?php
    //including the database file to get access to the database
    require_once('database.php');

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


        <!-- linking styling / images -->
        <link rel = 'stylesheet' href = 'style.css'>

        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:no-preference)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:dark)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:light)">
                
    </head>
    <body>
        <!-- including the header -->
        <span><?php $page = 'pets'; include_once('header.php'); ?></span>

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
                <tr >
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
        <span><?php include_once('footer.php'); ?></span>
    </body>
<html>