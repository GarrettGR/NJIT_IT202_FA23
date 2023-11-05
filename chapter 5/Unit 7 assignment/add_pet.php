<!-- a page to insert a new animal into the pet store SQL page; provides the ability to 'bring a rescue' to the pet store -->
<?php
    //including the database connection file
    include('database.php');

    //seeting default values for the variables
    if (!isset($breadCategoryID)) { $breadCategoryID = ''; }
    if (!isset($breadCode)) { $breadCode = ''; }
    if (!isset($breadName)) { $breadName = ''; }
    if (!isset($description)) { $description = ''; }
    if (!isset($price)) { $price = ''; }

    if(!isset($animal_type)) { $animal_type = 0; }
    if(!isset($codes)) { $codes = []; }
    if(!isset($error_message)) { $error_message = ''; }

    $run = false;

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

    //if the form has been submitted
    if ($run) {
        //getting the data from the form
        // $breadCategoryID = $_POST['animal_type_id']; (set automatically)
        // $breadCode = $_POST['animal_code']; (set automatically)

        $animal_type = filter_input(INPUT_POST, 'animal_type', FILTER_VALIDATE_INT);
        $breadName = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'animal_description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'animal_price', FILTER_VALIDATE_FLOAT);

        //validating the data
        $max_Price = 999.99;

        if (empty($animal_type)) {
            $error_message = 'Please select an animal type';
        } else if (empty($breadName)) {
            $error_message = 'Please enter an animal name';
        } else if (empty($description)) {
            $error_message = 'Please enter an animal description';
        } else if (empty($price)) {
            $error_message = 'Please enter an animal price';
        } else if (!is_numeric($price)) {
            $error_message = 'Please enter a valid price';
        } else if ($price < 0) {
            $error_message = 'Please enter a positive price';
        } else if ($price > $max_Price) {
            $error_message = 'Please enter a price less than $' . $max_Price;
        }

        if (!empty($error_message)) {
            include('add_pet.php');
            $run = false;
            exit();
        }


        //setting the category ID and code based on the animal type
        $breadCategoryID = $animal_type;

        $animal_type = $codes[$animal_type];

        $query = 'SELECT breadCode FROM bread WHERE breadCode LIKE :animal_code ORDER BY breadCode DESC LIMIT 1';
        $statement = $db->prepare($query);
        $statement->bindValue(':animal_code', $animal_type);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        $animal_type = explode('-', $result['breadCode']);
        $breadCode = $animal_type[0] . '-' . str_pad(($animal_type[1] + 1), 3, '0', STR_PAD_LEFT);
        die(var_dump($breadCategoryID, $breadCode, $breadName, $description, $price, $animal_type));

        // query statement to insert the data into the database
        $statement = $db->query("INSERT INTO bread (breadCategoryID, breadCode, breadName, description, price, dateAdded) VALUES ('$breadCategoryID', '$breadCode', '$breadName', '$description', '$price', NOW())");
        $statement->execute();
        $statement->closeCursor();

        echo '<script> alert("Go to \'Pets\' page to see your rescue added to our database") </script>';

        //unset the form submit variable to prevent automatic resubmission (loop)
        // unset($_POST['formSubmit']);

        $run = false;
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
            <?php if (!empty($error_message)) { ?>
                <p style="color: red; font-weight: bold"><?php echo htmlspecialchars($error_message); ?></p><br>
            <?php } ?>

            <!-- form to add a new animal to the database -->
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <div id="data">

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $animal_type == 0) { ?>
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

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($breadName)) { ?>
                        <label style="color: red" for="animal_name">Animal Name:</label>
                    <?php } else { ?>
                        <label for="animal_name">Animal Name:</label>
                    <?php } ?>
                    <input type="text" name="animal_name" id="animal_name" value="<?php echo htmlspecialchars($breadName); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($description)) { ?>
                        <label style="color: red" for="animal_description">Animal Description:</label>
                    <?php } else { ?>
                        <label for="animal_description">Animal Description:</label>
                    <?php } ?>
                    <input type="text" name="animal_description" id="animal_description" value="<?php echo htmlspecialchars($description); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($price)) { ?>
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

                    <!-- a button that sets the $run variable to true -->
                    <br><label for="submit">&nbsp;</label>
                    <!-- <input type="submit" name="submit" id="submit" value="Add Pet (RUN)" ><br> FIX THIS -->
                </div>
            </form>

        </main>

        <!-- include the footer -->
        <span><?php include_once('footer.php'); ?></span>
    </body>
</html>