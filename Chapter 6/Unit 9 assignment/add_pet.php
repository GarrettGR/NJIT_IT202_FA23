<!-- a page to insert a new animal into the pet store SQL page; provides the ability to 'bring a rescue' to the pet store -->
<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!$_SESSION['logged_in']) {
        include('login_error.php');
        exit();
    }

    $get_codes = function(){
        global $db;
        global $result;
        global $codes;

        $query = 'SELECT breadCategories.breadCategoryID, breadCategories.breadCategoryName, MIN(bread.breadCode) FROM bread RIGHT JOIN breadCategories ON bread.breadCategoryID = breadCategories.breadCategoryID GROUP BY breadCategories.breadCategoryID ORDER BY breadCategories.breadCategoryID ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        $codes = [];
        foreach ($result as $row) {
            $codes[$row['breadCategoryID']] = substr($row['MIN(bread.breadCode)'], 0, -3) . '%';
        }
    };

    //including the database connection file
    require_once('database.php');

    //seeting default values for the variables
    if (!isset($breadCategoryID)) { $breadCategoryID = ''; }
    if (!isset($breadCode)) { $breadCode = ''; }
    if (!isset($breadName)) { $breadName = ''; }
    if (!isset($description)) { $description = ''; }
    if (!isset($price)) { $price = ''; }
    if (!isset($animal_type)) { $animal_type = 0; }
    if (!isset($error_message)) { $error_message = [0,""]; }
    if (!isset($codes)) { $codes = []; }
    if (!isset($result)) { $result = []; }


    // $query = 'SELECT DISTINCT breadCategoryID, breadCode FROM bread WHERE breadCode LIKE "%-001" ORDER BY breadCategoryID ASC';
    // $query = 'SELECT breadCategoryID, MIN(breadCode) FROM bread GROUP BY breadCategoryID ORDER BY breadCategoryID ASC';

    if (isset($_POST['formSubmit'])){
        //getting the data from the form
        $animal_type = filter_input(INPUT_POST, 'animal_type', FILTER_VALIDATE_INT);
        $breadName = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES); //FILTER_SANITIZE_STRING has been deprecated (?) so I used this instead (found on StackOverflow)
        $description = filter_input(INPUT_POST, 'animal_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $breadCode = filter_input(INPUT_POST, 'animal_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $price = filter_input(INPUT_POST, 'animal_price', FILTER_VALIDATE_FLOAT);
        $animalCode = filter_input(INPUT_POST, 'manual_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(!empty($animalCode)){
            $manual = true;
        } else {
            $manual = false;
        }

        //getting the codes from the hidden input
        $codes = unserialize($_POST['codes']);

        //validating the data
        $error_message = [0,""];
        $max_Price = 999.99;

        if ($animal_type == 0) {
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
            unset($_POST['formSubmit']);
            include('add_pet.php');
            exit();
        }

        if ($manual){
            $query = 'SELECT breadCode FROM bread';
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();

            $existing_codes = array_values($result);

            $breadCategoryID = $animal_type;
            $breadCode = $animalCode;
            if(!is_string($breadCode)){
                $error_message[0] = 7;
                $error_message[1] = 'Please enter a valid 3-letter/3-digit animal code, seperated by a hyphen';
            } else if (strlen($breadCode) != 7){
                $error_message[0] = 7;
                $error_message[1] = 'Please enter a valid 3-letter/3-digit animal code, seperated by a hyphen';
            } else if (substr($breadCode, -4, -3) != '-'){
                $error_message[0] = 7;
                $error_message[1] = 'Please enter a valid 3-letter/3-digit animal code, serperated by a hyphen';
            } else if (!is_numeric((int)(substr($breadCode, -3)))){
                $error_message[0] = 7;
                $error_message[1] = 'Please enter a valid 3-letter/3-digit animal code, seperated by a hyphen';
            } else if (!is_string(substr($breadCode, 0, 3))){
                $error_message[0] = 7;
                $error_message[1] = 'Please enter a valid 3-letter/3-digit animal code, seperated by a hyphen';
            } else if (array_search($breadCode, $existing_codes) !== false){
                $error_message[0] = 6;
                $error_message[1] = 'Please enter a unique 3-letter/3-digit animal code, seperated by a hyphen';
            }
        } else {
            if ($codes[$animal_type] == '%'){
                $breadCategoryID = $animal_type;

                $existing_codes = array_values($codes);
                foreach ($existing_codes as $key => $value) {
                    if ($value!='%'){
                        $existing_codes[$key] = substr($value, 0, -2);
                    }
                }

                if ($breadCode == ''){
                    $error_message[0] = 5;
                    $error_message[1] = 'this is the first time we\'ve seen this animal type, enter its 3-letter code manually'; 
                } else if (!is_string($breadCode)){
                    $error_message[0] = 5;
                    $error_message[1] = 'Please enter a valid 3-letter animal code';
                } else if (strlen($breadCode) != 3){
                    $error_message[0] = 5;
                    $error_message[1] = 'Please enter a valid 3-letter animal code';
                }else if (array_search($breadCode, $existing_codes) !== false){
                    $error_message[0] = 5;
                    $error_message[1] = 'Please enter a unique 3-letter animal code';
                }
        
                //if an error message exists, go to the add_pet.php page
                if (!empty($error_message[1])) {
                    unset($_POST['formSubmit']);
                    include('add_pet.php');
                    exit();
                }

                $breadCode = $breadCode . '-001';

            } else {
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
            }
        }

        // query statement to insert the data into the database
        $statement = $db->query("INSERT INTO bread (breadCategoryID, breadCode, breadName, description, price, dateAdded) VALUES ('$breadCategoryID', '$breadCode', '$breadName', '$description', '$price', NOW())");

        echo '<script> alert("Go to \"Pets\" page to see your rescue added to our database") </script>';

        //unset the form submit variable to prevent automatic resubmission (loop)
        unset($_POST['formSubmit']);
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

        <script>    
            function toggleVis() {
                var x = document.getElementById("manual_entry");
                if (x.style.display === "none") {
                    x.style.display = "inline";
                } else {
                    x.style.display = "none";
                }        
            }
        </script>

        <style>
            .tooltip {
                position: relative;
                display: inline-block;
                border-bottom: 1px dotted black;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                width: 220px;
                background-color: black;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px 0;
                position: absolute;
                z-index: 1;
                top: -5px;
                left: 110%;
            }

            .tooltip .tooltiptext::after {
                content: "";
                position: absolute;
                top: 50%;
                right: 100%;
                margin-top: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent black transparent transparent;
            }
            .tooltip:hover .tooltiptext {
                visibility: visible;
            }
        </style>
            
    </head>

    <body>

        <!-- including the header -->
        <span><?php $page = 'rescue'; include_once('header.php'); ?></span>

        <main>

            <h1> We are so glad that you have decided to bring us the pet you found! </h1>
            <h3> Please fill out the form below to add the pet to our database. <h3><br>

            <!-- displays an error message if there is one -->
            <?php if (!empty($error_message[1])) { ?>
                <p style="color: red; font-weight: bold"><?php echo htmlspecialchars($error_message[1]); ?></p><br>
            <?php } ?>

            <!-- form to add a new animal to the database -->
            <form action="add_pet.php" method="post"> <!-- action="adding_pet.php" -->
                <div id="data">

                    <!-- call the php function to get the codes used to fill in the dropdown & for bread-type assignments -->
                    <?php $get_codes(); ?>

                    <!-- hidden 'input' to pass the $codes variable through the $_POST array -->
                    <input type="hidden" name="codes" value='<?php echo serialize($codes) ?>' >

                    <!-- creates a selection dynamically as a result of whatever is in the SQL database -->
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && ($animal_type == 0 || $error_message[0]==1) && ($error_message[0]!=5 || $error_message[0]!=6)) { ?>
                        <label style="color: red" for="animal_type">Animal Type:</label>
                    <?php } else if ($error_message[0]!=5 || $error_message[0]!=6) { ?>
                        <label for="animal_type">Animal Type:</label>
                    <?php } ?>
                    <?php if ($error_message[0]!=5 || $error_message[0]!=6){ ?>
                            <select name="animal_type" id="animal_type" value=<?php echo htmlspecialchars($breadCategoryID) ?>>
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
                    <?php }?>

                    <!-- allows breadCode to be set manually in the case that there is a breadCategoryID that does not have an entry in "bread" -->
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_message[0]==5) { ?>
                        <label style="color: red" for="animal_code">Animal Code:</label>
                    <?php } else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_message[0]==6){ ?>
                        <label for="animal_code">Animal Code:</label>
                    <?php } ?>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && ($error_message[0]==5 || $error_message[0]==6)){ ?>
                        <input type="text" name="animal_code" id="animal_code" placeholder="ie. 'BRD' " value="<?php echo htmlspecialchars($breadCode); ?>"><br>
                    <?php } ?>

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

                    <!-- a toggle-style switch which allows breadCode to be set manually, overridding the automatic setting by the dropdown -->
                    <br><label for="visibility_checkbox"> Set Animal Code Manually: </label><br>
                    <label class="switch">
                        <input type="checkbox" name="visibility_checkbox" id="visibility_checkbox" onclick='toggleVis()'>
                        <span class="slider round"></span>
                    </label>
                    <div id="manual_entry" style="display:none">
                        <input type="text" name="manual_code" id="manual_code" placeholder="ie. 'BRD-001' " value="<?php echo $breadCode ?>">
                    </div>
                    <div class="tooltip">(note)
                        <span class="tooltiptext">this entry field is not to be used when using the automattic code generation of the drop down or when creating a new animal letter-code and having it automatically assign it a '-001' end to the code, this will override any other code and is only for meeting the requirements of the assignment</span>
                    </div>
                    
                    <br>
            
                    <!-- a reset/clear button -->
                    <br><label for="reset">&nbsp;</label>
                    <input type="reset" name="reset" id="reset" value="Clear" onclick="<?php unset($error_message) ?>"><br>

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