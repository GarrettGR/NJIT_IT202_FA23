<!-- This page allows the insertion of a new animal into the pet store SQL datapase; provides the ability for a manager to 'bring a rescue' to the pet store -->

<?php
include_once('src/php/login_verify.php');
require_once('src/php/database.php');

$query = 'SELECT breadCategories.breadCategoryID, breadCategories.breadCategoryName, MIN(bread.breadCode) FROM bread RIGHT JOIN breadCategories ON bread.breadCategoryID = breadCategories.breadCategoryID GROUP BY breadCategories.breadCategoryID ORDER BY breadCategories.breadCategoryID ASC';
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$statement->closeCursor();

$_SESSION['codes'] = array();
foreach ($result as $row) {
  $_SESSION['codes'][$row['breadCategoryID']] = substr($row['MIN(bread.breadCode)'], 0, -3) . '%';
}

// setting session variables to default values if they are not set
if (!isset($_SESSION['animal_data'])) {
  $_SESSION['animal_data'] = array();
}
if (!isset($_SESSION['pet_error_message'])) {
  $_SESSION['pet_error_message'] = array();
}

if ($_SESSION['animal_data'] != array()){
  $animal_type = $_SESSION['animal_data']['animal_type'];
  $breadName = $_SESSION['animal_data']['animal_name'];
  $description = $_SESSION['animal_data']['animal_description'];
  $price = $_SESSION['animal_data']['animal_price'];
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
    <div class="row justify-content-sm-center">
      <div class="col-8">
        <h1>Rescue</h1>

        <h4>We are so glad you have decided to bring us the pet you found!</h4>

        <div class="d-flex">
          <h6 style="padding-right: 1em;">Fill out this form to add a new animal to the store!</h6>

          <!-- error message -->
          <?php if (!empty($_SESSION['pet_error_message'])) { ?>
            <div class="text-danger">
              <h6 class="font-weight-bold"> <?php echo $_SESSION['pet_error_message'][1]; ?> </h6>
            </div>
          <?php } ?>
        </div>

      </div>
    </div>
    <div class="row justify-content-sm-center pt-1">
      <div class="col-6">
        <form action="src/php/add_pet.php" method="POST" name="rescue_form" id="rescue_form">

          <!-- dropdown to select animal type -->
          <div class="mt-2" id="animal-type">
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

          <!-- animal code handling -->
          <div class="row">
            <!-- switch and radio buttons to choose to override the breadcode -->
            <div class="col-6">
              <div class="form-check form-switch" id="toggle-manual">
                <label class="form-check-label" for="automatic">Automatic Animal Code</label>
                <input class="form-check-input" type="checkbox" id="automatic" name="automatic" value="true" checked>
              </div>
              <div class="mb-3" id="manual-override" style="display: none">
                <div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="override-radio" 
                    id="numeric-override"
                    value="numeric" checked>
                    <label class="form-check-label" for="numeric-override">
                      Override Numberic Value
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="override-radio" 
                    id="entire-override"
                    value="entire">
                    <label class="form-check-label" for="entire-override">
                      Override Entire Animal Code
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <!-- input for the animal code -->
            <div class="col-6">
              <div class="mb-3" id="animal_code" style="display: none">
                <label for="animal-code" class="form-label">Animal Code</label>
                <div class="invalid-feedback" id="animal-code-feedback">
                  Please enter a valid Animal Code.
                </div>
                <input type="text" class="form-control" id="animal-code" name="breadCode" value="<?php echo substr($breadCode, -3); ?>" placeholder="Ex. 006">
              </div>
            </div>
          </div>

          <!-- the rest of the form inputs -->
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
          <div class="row justify-content-sm-center pt-1 mb-3">
            <div class="col-3">
              <input style="margin-left: .5em;" type="submit" value="Add Animal">
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- php/jquery error message handling -->
  <?php if($_SESSION['pet_error_message'] != array()) { ?>
    <?php if($_SESSION['pet_error_message'][0]=='type') { ?>
      <script>
        $('#animal-type').addClass('is-invalid');
        $('#animal-type-feedback').text('<?php echo $_SESSION['pet_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#animal-type').removeClass('is-invalid');
        $("#animal-type-feedback").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['pet_error_message'][0]=='code') { ?>
      <script>
        $('#animal-code').addClass('is-invalid');
        $('#animal-code-feedback').text('<?php echo $_SESSION['pet_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#animal-code').removeClass('is-invalid');
        $("#animal-code-feedback").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['pet_error_message'][0]=='name') { ?>
      <script>
        $('#animal-name').addClass('is-invalid');
        $('#animal-name-feedback').text('<?php echo $_SESSION['pet_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#animal-name').removeClass('is-invalid');
        $("#animal-name-feedback").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['pet_error_message'][0]=='description') { ?>
      <script>
        $('#animal-description').addClass('is-invalid');
        $('#animal-description-feedback').text('<?php echo $_SESSION['pet_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#animal-description').removeClass('is-invalid');
        $("#animal-description-feedback").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['pet_error_message'][0]=='price') { ?>
      <script>
        $('#animal-price').addClass('is-invalid');
        $('#animal-price-feedback').text('<?php echo $_SESSION['pet_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#animal-price').removeClass('is-invalid');
        $("#animal-price-feedback").hide();
      </script>
    <?php } ?>
  <?php } ?>

  <!-- unset the saved session animal data and error messages -->
  <?php unset($_SESSION['animal_data']); ?>
  <?php unset($_SESSION['pet_error_message']); ?>

  <?php include 'src/html/footer.html'; ?>
</body>

</html>