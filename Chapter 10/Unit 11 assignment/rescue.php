<!-- This page allows the insertion of a new animal into the pet store SQL datapase; provides the ability for a manager to 'bring a rescue' to the pet store -->

<?php
include_once('src/php/login_verify.php');
require_once('src/php/database.php');

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

    
};

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
    <?php include 'src/html/header.html'; ?>
    <main>
        <div class="row">
            <div class="col-6">
                <h1>Rescue</h1>
                <p>This is the rescue page!</p>
            </div>
        </div>
    </main>
    <?php include 'src/html/footer.html'; ?>

</html>