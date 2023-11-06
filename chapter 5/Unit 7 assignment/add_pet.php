<!-- a page to insert a new animal into the pet store SQL page; provides the ability to 'bring a rescue' to the pet store -->
<?php
    //including the database connection file
    require_once('database.php');

    //seeting default values for the variables
    if (!isset($breadCategoryID)) { $breadCategoryID = ''; }
    if (!isset($breadCode)) { $breadCode = ''; }
    if (!isset($breadName)) { $breadName = ''; }
    if (!isset($description)) { $description = ''; }
    if (!isset($price)) { $price = ''; }

    if(!isset($animal_type)) { $animal_type = 0; }
    if(!isset($codes)) { $codes = []; }

    // $query = 'SELECT DISTINCT breadCategoryID, breadCode FROM bread WHERE breadCode LIKE "%-001" ORDER BY breadCategoryID ASC';
    // $query = 'SELECT breadCategoryID, MIN(breadCode) FROM bread GROUP BY breadCategoryID ORDER BY breadCategoryID ASC';

    $query = 'SELECT breadCategories.breadCategoryID, breadCategories.breadCategoryName, MIN(bread.breadCode) FROM bread INNER JOIN breadCategories ON bread.breadCategoryID = breadCategories.breadCategoryID GROUP BY breadCategories.breadCategoryID ORDER BY breadCategories.breadCategoryID ASC';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($result as $row) {
        $codes[$row['breadCategoryID']] = substr($row['MIN(bread.breadCode)'], 0, -3) . '%';
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hartrum's Pet Shop - Add Pet</title>

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
        <span><?php $page = 'add_pet'; include_once('header.php'); ?></span>

        <main>

            <h1> We are so glad that you have decided to bring us the pet you found! </h1>
            <h3> Please fill out the form below to add the pet to our database. <h3><br>

            <!-- displays an error message if there is one -->
            <?php if (!empty($error_message[1])) { ?>
                <p style="color: red; font-weight: bold"><?php echo htmlspecialchars($error_message[1]); ?></p><br>
            <?php } ?>

            <!-- form to add a new animal to the database -->
            <form action="adding_pet.php" method="post"> <!-- action="<_?php echo htmlentities($_SERVER['PHP_SELF']); ?>" -->
                <div id="data">

                    <!-- hidden 'input' to pass the $codes variable through the $_POST array -->
                    <input type="hidden" name="codes" value="<?php $codes ?>">

                    <!-- creates a selection dynamically as a result of whatever is in the SQL database -->
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && ($animal_type == 0 || $error_message[0]==1)) { ?>
                        <label style="color: red" for="animal_type">Animal Type:</label>
                    <?php } else { ?>
                        <label for="animal_type">Animal Type:</label>
                    <?php } ?>
                    <select name="animal_type" id="animal_type" value="<?php echo htmlspecialchars($breadCategoryID) ?>">
                        <option value="0">--SELECT--</option>
                        <!-- <option value="1">Bird</option>
                        <option value="2">Cat</option>
                        <option value="3">Dog</option>
                        <option value="4">Snake</option>
                        <option value="5">Fish</option> -->
                        <?php foreach ($result as $row) { ?>
                            <option value="<?php echo $row['breadCategoryID']; ?>"><?php echo $row['breadCategoryName']; ?></option>
                        <?php } ?>
                    </select><br>

                    <!-- traditional input form feilds -- with the exception of the error-reactive coloring -->
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && (empty($breadName) || $error_message[0]==2)) { ?>
                        <label style="color: red" for="animal_name">Animal Name:</label>
                    <?php } else { ?>
                        <label for="animal_name">Animal Name:</label>
                    <?php } ?>
                    <input type="text" name="animal_name" id="animal_name" value="<?php echo htmlspecialchars($breadName); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && (empty($description) || $error_message[0]==3)) { ?>
                        <label style="color: red" for="animal_description">Animal Description:</label>
                    <?php } else { ?>
                        <label for="animal_description">Animal Description:</label>
                    <?php } ?>
                    <input type="text" name="animal_description" id="animal_description" value="<?php echo htmlspecialchars($description); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && (empty($price) || $error_message[0]==4)) { ?>
                        <label style="color: red" for="animal_price">Animal Price:</label>
                    <?php } else { ?>
                        <label for="animal_price">Animal Price:</label>
                    <?php } ?>
                    <input type="text" name="animal_price" id="animal_price" value="<?php echo htmlspecialchars($price); ?>"><br>
            
                    <!-- a reset/clear button -->
                    <br><label for="reset">&nbsp;</label>
                    <input type="reset" name="reset" id="reset" value="Clear"><br>

                    <!-- a submit button -->
                    <br><label for="formSubmit">&nbsp;</label>
                    <input type="submit" name="formSubmit" id="formSubmit" value="Add Pet"><br>
                </div>
            </form>

        </main>

        <!-- include the footer -->
        <span><?php include_once('footer.php'); ?></span>
    </body>
</html>