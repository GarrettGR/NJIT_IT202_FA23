<?php

    //connecting to the database
    require_once('database.php');

    //getting the data from the form
    $animal_type = filter_input(INPUT_POST, 'animal_type', FILTER_VALIDATE_INT);
    $breadName = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES); //FILTER_SANITIZE_STRING has been deprecated (?) so I used this instead (found on StackOverflow)
    $description = filter_input(INPUT_POST, 'animal_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $price = filter_input(INPUT_POST, 'animal_price', FILTER_VALIDATE_FLOAT);

    //getting the codes from the hidden input
    $codes = unserialize($_POST['codes']);

    //validating the data
    $error_message = [0,""];
    $max_Price = 999.99;

    if (empty($animal_type)) {
        $error_message[0] = 1;
        $error_message[1] = 'Please select an animal type';
    } else if (empty($breadName)) {
        $error_message[0] = 2;
        $error_message[1] = 'Please enter an animal name';
    } else if (empty($description)) {
        $error_message[0] = 3;
        $error_message[1] = 'Please enter an animal description';
    } else if (empty($price)) {
        $error_message[0] = 4;
        $error_message[1] = 'Please enter an animal price';
    } else if (!is_numeric($price)) {
        $error_message[0] = 4;
        $error_message[1] = 'Please enter a valid price';
    } else if ($price < 0) {
        $error_message[0] = 4;
        $error_message[1] = 'Please enter a positive price';
    } else if ($price > $max_Price) {
        $error_message[0] = 4;
        $error_message[1] = 'Please enter a price less than $' . $max_Price;
    }

    //if an error message exists, go to the add_pet.php page
    if (!empty($error_message[1])) {
        include('add_pet.php');
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

    // query statement to insert the data into the database
    $statement = $db->query("INSERT INTO bread (breadCategoryID, breadCode, breadName, description, price, dateAdded) VALUES ('$breadCategoryID', '$breadCode', '$breadName', '$description', '$price', NOW())");

    echo '<script> alert("Go to \'Pets\' page to see your rescue added to our database") </script>';

    //unset the form submit variable to prevent automatic resubmission (loop)
    // unset($_POST['formSubmit']);

?>