<?php
include_once('src/php/login_verify.php');

// set the default values for session variables if they dont exist
if (!isset($_SESSION['shipping_data'])) {
  $_SESSION['shipping_data'] = array();
}
if (!isset($_SESSION['label_error_message'])) {
  $_SESSION['label_error_message'] = array();
}

// get the data from the serialized array (if it exists)
if ($_SESSION['shipping_data'] != array()) {
    $shipping_data = $_SESSION['shipping_data'];
    $first_name = $shipping_data['first_name'];
    $last_name = $shipping_data['last_name'];
    $address_one = $shipping_data['address_one'];
    $address_two = $shipping_data['address_two'];
    $state = $shipping_data['state'];
    $city = $shipping_data['city'];
    $zip_code = $shipping_data['zip_code'];
    $ship_date = $shipping_data['ship_date'];
    $package_dimensions = $shipping_data['package_dimensions'];
    $package_weight = $shipping_data['package_weight'];
    $order_number = $shipping_data['order_number'];
}

if (!isset($first_name)) {
  $first_name = '';
}
if (!isset($last_name)) {
  $last_name = '';
}
if (!isset($address_one)) {
  $address_one = '';
}
if (!isset($address_two)) {
  $address_two = '';
}
if (!isset($state)) {
  $state = '';
}
if (!isset($city)) {
  $city = '';
}
if (!isset($zip_code)) {
  $zip_code = '';
}
if (!isset($ship_date)) {
  $ship_date = '';
}
if (!isset($package_dimensions)) {
  $package_dimensions = '';
}
if (!isset($package_weight)) {
  $package_weight = '';
}
if (!isset($order_number)) {
  $order_number = '';
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
        <h1>Shipping</h1>
        <h5>Fill out this form to generate the shipping label!</h5>

        <form class="pt-2" action="display_label.php" method="post" name="shipping_form" id="rescue_form">

          <!-- error message -->
          <?php if ($_SESSION['label_error_message']!=array()) { ?>
            <div class="text-danger mt-2" id="general_error">
              <p> <?php echo $_SESSION['label_error_message'][1] ?> </p>
            </div>
          <?php } ?>

          <h2 class="mt-2">Address Information: </h2>
          <div class="row">
            <div class="col-6">
              <div class="mb-3" id="first-name">
                <label for="first-name" class="form-label">First Name: </label>
                <div class="invalid-feedback text-danger" id="first_name_error"></div>
                <input type="text" class="form-control" name="first-name" id="first-name" value="<?php echo htmlspecialchars($first_name); ?>">
              </div>
              <div class="mb-3" id="address-one">
                <label for="address-one" class="form-label">Address Line 1: </label>
                <div class="invalid-feedback text-danger" id="address_one_error"></div>
                <input type="text" class="form-control" name="address-one" id="address-one" value="<?php echo htmlspecialchars($address_one); ?>">
              </div>
              <div class="mb-3" id="city">
                <label for="city" class="form-label">City: </label>
                <div class="invalid-feedback text-danger" id="city_error"></div>
                <input type="text" class="form-control" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>">
              </div>
              <div class="mb-3" id="zip-code">
                <label for="zip-code" class="form-label">Zip Code: </label>
                <div class="invalid-feedback text-danger" id="zip_code_error"></div>
                <input type="number" class="form-control" name="zip-code" id="zip-code" placeholder='Ex. "08844"' value="<?php echo htmlspecialchars($zip_code); ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3" id="last-name">
                <label for="last-name" class="form-label">Last Name: </label>
                <div class="invalid-feedback text-danger" id="last_name_error"></div>
                <input type="text" class="form-control" name="last-name" id="last-name" value="<?php echo htmlspecialchars($last_name); ?>">
              </div>
              <div class="mb-3" id="address-two">
                <label for="address-two" class="form-label">Address Line 2: </label>
                <div class="invalid-feedback text-danger" id="address_two_error"></div>
                <input type="text" class="form-control" name="address-two" id="address-two" value="<?php echo htmlspecialchars($address_two); ?>">
              </div>
              <div class="mb-3" id="state">
                <label for="state" class="form-label">State (abbrev.): </label>
                <div class="invalid-feedback text-danger" id="state_error"></div>
                <input type="text" class="form-control" name="state" id="state" placeholder='Ex. "NJ"' value="<?php echo htmlspecialchars($state); ?>">
              </div>
            </div>
          </div>

          <h2 class="mt-2">Package Information: </h2>
          <div class="row">
            <div class="col-6">
              <div class="mb-3" id="ship-date">
                <label for="ship-date" class="form-label">Ship Date: </label>
                <div class="invalid-feedback text-danger" id="ship_date_error"></div>
                <input type="date" class="form-control" name="ship-date" id="ship-date" value="<?php echo htmlspecialchars($ship_date); ?>">
              </div>
              <div class="mb-3" id="package-dimensions">
                <label for="package-dimensions" class="form-label">Package Dimensions: </label>
                <div class="invalid-feedback text-danger" id="package_dimensions_error"></div>
                <input type="text" class="form-control" name="package-dimensions" id="package-dimensions" placeholder='Ex. "L,W,H"' value="<?php echo htmlspecialchars($package_dimensions); ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3" id="package-weight">
                <label for="package-weight" class="form-label">Package Weight: </label>
                <div class="invalid-feedback text-danger" id="package_weight_error"></div>
                <input type="text" class="form-control" name="package-weight" id="package-weight" value="<?php echo htmlspecialchars($package_weight); ?>">
              </div>
              <div class="mb-3" id="order-number">
                <label for="order-number" class="form-label">Order Number: </label>
                <div class="invalid-feedback text-danger" id="order_number_error"></div>
                <input type="text" class="form-control" name="order-number" id="order-number" value="<?php echo htmlspecialchars($order_number); ?>">
              </div>
            </div>
          </div>

          <div class="mt-1">
            <input type="submit" value="Create Label">
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- php/jquery error message handling -->
  <?php if ($_SESSION['label_error_message']!=array()) { ?>
    <?php if ($_SESSION['label_error_message'][0]=='first') { ?>
      <script>
        $('#first-name').addClass('is-invalid');
        $('#first_name_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#first-name').removeClass('is-invalid');
        $("#first_name_error").hide();
      </script>
    <?php } ?>
    <?php if ($_SESSION['label_error_message'][0]=='last') { ?>
      <script>
        $('#last-name').addClass('is-invalid');
        $('#last_name_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#last-name').removeClass('is-invalid');
        $("#last_name_error").hide();
      </script>
    <?php } ?>
    <?php if ($_SESSION['label_error_message'][0]=='address') { ?>
      <script>
        $('#address-one').addClass('is-invalid');
        $('#address_one_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#address-one').removeClass('is-invalid');
        $("#address_one_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='city') { ?>
      <script>
        $('#city').addClass('is-invalid');
        $('#city_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#city').removeClass('is-invalid');
        $("#city_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='state') { ?>
      <script>
        $('#state').addClass('is-invalid');
        $('#state_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#state').removeClass('is-invalid');
        $("#state_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='zip') { ?>
      <script>
        $('#zip-code').addClass('is-invalid');
        $('#zip_code_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#zip-code').removeClass('is-invalid');
        $("#zip_code_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='date') { ?>
      <script>
        $('#ship-date').addClass('is-invalid');
        $('#ship_date_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#ship-date').removeClass('is-invalid');
        $("#ship_date_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='dimensions') { ?>
      <script>
        $('#package-dimensions').addClass('is-invalid');
        $('#package_dimensions_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#package-dimensions').removeClass('is-invalid');
        $("#package_dimensions_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='weight') { ?>
      <script>
        $('#package-weight').addClass('is-invalid');
        $('#package_weight_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script> 
        $('#package-weight').removeClass('is-invalid');
        $("#package_weight_error").hide();
      </script>
    <?php } ?>
    <?php if($_SESSION['label_error_message'][0]=='number') { ?>
      <script>
        $('#order-number').addClass('is-invalid');
        $('#order_number_error').text('<?php echo $_SESSION['label_error_message'][1]; ?>').show();
      </script>
    <?php } else {?>
      <script>
        $('#order-number').removeClass('is-invalid');
        $("#order_number_error").hide();
      </script>
    <?php } ?>
  <?php } ?>


  <!-- unset the saved session shipping data and error messages -->
  <?php unset($_SESSION['shipping_data']); ?>
  <?php unset($_SESSION['label_error_message']); ?>


  <script src="src/js/shipping_validation.js"></script>
  <?php include 'src/html/footer.html'; ?>
</body>

</html>