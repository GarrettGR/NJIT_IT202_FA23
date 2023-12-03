<!-- This page allows the insertion of a new animal into the pet store SQL datapase; provides the ability for a manager to 'bring a rescue' to the pet store -->

<?php
include_once('src/php/login_verify.php');
require_once('src/php/database.php');

$query = 'SELECT breadCategories.breadCategoryID, breadCategories.breadCategoryName, MIN(bread.breadCode) FROM bread RIGHT JOIN breadCategories ON bread.breadCategoryID = breadCategories.breadCategoryID GROUP BY breadCategories.breadCategoryID ORDER BY breadCategories.breadCategoryID ASC';
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$statement->closeCursor();

$_SESSION['codes'] = [];
foreach ($result as $row) {
  $_SESSION['codes'][$row['breadCategoryID']] = substr($row['MIN(bread.breadCode)'], 0, -3) . '%';
}

//seeting default values for the variables
if (!isset($breadCategoryID)) {
  $breadCategoryID = '';
}
if (!isset($breadCode)) {
  $breadCode = '';
}
if (!isset($breadName)) {
  $breadName = '';
}
if (!isset($description)) {
  $description = '';
}
if (!isset($price)) {
  $price = '';
}
if (!isset($animal_type)) {
  $animal_type = 0;
}
if (!isset($error_message)) {
  $error_message = [0, ""];
}
if (!isset($result)) {
  $result = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
  <?php include 'src/html/header.html'; ?>
  <main class="bg-light text-dark">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <form action="src/php/add_pet.php" method="POST" name="rescue_form" id="rescue_form">

          <!-- error message -->
          <div class="text-danger" id="general_error"></div>

          <!-- dropdown to select animal type -->
          <div class="mb-3" id="animal-type">
            <label for="animal-type" class="form-label">Animal Type</label>
            <div class="invalid-feedback" id="animal-type-feedback">
              Please select a valid Animal Type.
            </div>
            <select class="form-select" aria-label="Default select example" name="animal_type" id="animal_type">
              <option value="0" selected>Choose an animal type</option>
              <?php foreach ($result as $row) : ?>
                <option value="<?php echo $row['breadCategoryID']; ?>"><?php echo $row['breadCategoryName']; ?></option>
              <?php endforeach; ?>
            </select><br>
          </div>

          <!-- switch and radio buttons to choose to override the breadcode -->
          <div class="form-check form-switch" id="toggle-manual">
            <label class="form-check-label" for="automatic">Automatic Animal Code</label>
            <input class="form-check-input" type="checkbox" id="automatic" checked>
          </div>
          <div class="mb-3" id="manual-override" style="display: none">
            <div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  Override Numberic Value
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Override Entire Animal Code
                </label>
              </div>
            </div>
          </div>

          <!-- checkboxes to choose how to set a new breadcode -->
          <div class="mb-3" id="toggle-manual-input">
            <div>
              <h2> Manual BreadCode input for creation </h2>
            </div>
          </div>

          <!-- the rest of the form inputs -->
          <div class="mb-3" id="animal_code" style="display: none">
            <label for="animal-code" class="form-label">Animal Code</label>
            <div class="invalid-feedback" id="animal-code-feedback">
              Please enter a valid Animal Code.
            </div>
            <input type="text" class="form-control" id="animal-code" name="breadCode" value="<?php echo $breadCode; ?>">
          </div>
          <div class="mb-3" id="animal_name">
            <label for="animal-name" class="form-label">Animal Name</label>
            <div class="invalid-feedback" id="animal-name-feedback">
              Please enter a valid Animal Name.
            </div>
            <input type="text" class="form-control" id="animal-name" name="breadName" value="<?php echo $breadName; ?>">
          </div>
          <div class="mb-3" id="animal_description">
            <label for="animal-description" class="form-label">Animal Description</label>
            <div class="invalid-feedback" id="animal-description-feedback">
              Please enter a valid Animal Description.
            </div>
            <textarea class="form-control" id="animal-description" name="description" rows="3" value="<?php echo $description ?>"></textarea>
          </div>
          <div class="mb-3" id="animal_price">
            <label for="animal-price" class="form-label">Animal Price</label>
            <div class="invalid-feedback" id="animal-price-feedback">
              Please enter a valid Animal Price.
            </div>
            <input type="text" class="form-control" id="animal-price" name="price" value="<?php echo $price; ?>">
          </div>

          <!-- submit button -->
          <div>
            <input type="submit" value="Add Animal">
          </div>
        </form>
      </div>
    </div>
  </main>
  <script src="src/js/rescue_validation.js"></script>
  <?php include 'src/html/footer.html'; ?>
</body>

</html>