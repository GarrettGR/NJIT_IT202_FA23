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
        // die("An error occurred while connecting to the database: " . $error_message);
    }

    // $statement = $db->query("SELECT breadCategoryID, breadCode, breadName, description, price FROM bread");
    // $data = $statement->fetchAll();

    //query statement to get all data from the bread table and join it with the breadCategories table
    $statement = $db->query("SELECT breadCategoryName, breadCode, breadName, description, price FROM breadCategories INNER JOIN bread ON breadCategories.breadCategoryID = bread.breadCategoryID");
    $data = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
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

</html>