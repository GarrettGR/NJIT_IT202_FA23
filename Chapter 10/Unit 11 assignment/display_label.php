<?php
include_once('src/php/login_verify.php');

// get the data from the form
$first_name = filter_input(INPUT_POST, 'first-name');
$last_name = filter_input(INPUT_POST, 'last-name');
$address_one = filter_input(INPUT_POST, 'address-one');
$address_two = filter_input(INPUT_POST, 'address-two');
$state = strtoupper(filter_input(INPUT_POST, 'state'));
$city = filter_input(INPUT_POST, 'city');
$zip_code = filter_input(INPUT_POST, 'zip-code');
$ship_date = filter_input(INPUT_POST, 'ship-date');
$package_dimensions = filter_input(INPUT_POST, 'package-dimensions');
$package_weight = filter_input(INPUT_POST, 'package-weight');
$order_number = filter_input(INPUT_POST, 'order-number');

// clear error message and shipping data
$error_message = array();
$_SESSION['label_error_message'] = array();
$shipping_data = array();
$_SESSION['shipping_data'] = array();

// store the data in a serialized array in the session
$shipping_data = array(
  'first_name' => $first_name,
  'last_name' => $last_name,
  'address_one' => $address_one,
  'address_two' => $address_two,
  'state' => $state,
  'city' => $city,
  'zip_code' => $zip_code,
  'ship_date' => $ship_date,
  'package_dimensions' => $package_dimensions,
  'package_weight' => $package_weight,
  'order_number' => $order_number
);

// make sure no fields are empty
if (empty($first_name)) {
  $error_message[0] = 'first';
  $error_message[1] = 'First name cannot be empty.';
} else if (empty($last_name)) {
  $error_message[0] = 'last';
  $error_message[1] = 'Last name cannot be empty.';
} else if (empty($address_one)) {
  $error_message[0] = 'address';
  $error_message[1] = 'Address 1 cannot be empty.';
} else if (empty($city)) {
  $error_message[0] = 'city';
  $error_message[1] = 'City cannot be empty.';
} else if (empty($state)) {
  $error_message[0] = 'state';
  $error_message[1] = 'State cannot be empty.';
} else if (empty($zip_code)) {
  $error_message[0] = 'zip';
  $error_message[1] = 'Zip code cannot be empty.';
} else if (empty($ship_date)) {
  $error_message[0] = 'date';
  $error_message[1] = 'Ship date cannot be empty.';
} else if (empty($package_dimensions)) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Package dimensions cannot be empty.';
} else if (empty($package_weight)) {
  $error_message[0] = 'weight';
  $error_message[1] = 'Package weight cannot be empty.';
} else if (empty($order_number)) {
  $error_message[0] = 'number';
  $error_message[1] = 'Order number cannot be empty.';
}

// go back to the shipping page if there is an error
if ($error_message != array()) {
  $_SESSION['label_error_message'] = $error_message;
  $_SESSION['shipping_data'] = $shipping_data;
  header('Location: shipping.php');
  exit();
}

//delim the package dimensions
$dimension_array = explode(',', $package_dimensions);
$length = $dimension_array[0];
$width = $dimension_array[1];
$height = $dimension_array[2];

//format the ship date
$ship_date = date('F j, Y', strtotime($ship_date));


//array of state abbreviations
$states = [
  'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana',
  'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire',
  'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas',
  'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming',
];

// function to count digits in a number
function count_digit($number)
{
  return strlen($number);
}

// validate input data
if (!array_key_exists($state, $states)) {
  $error_message[0] = 'state';
  $error_message[1] = 'State must be a valid state abbreviation.';
} else if (count_digit($zip_code) != 5) {
  $error_message[0] = 'zip';
  $error_message[1] = 'Zip code must be 5 digits.';
} else if ($zip_code < 0) {
  $error_message[0] = 'zip';
  $error_message[1] = 'Zip code must be positive.';
} else if ($zip_code > 99999) {
  $error_message[0] = 'zip';
  $error_message[1] = 'Zip code must be less than 99999.';
} else if ($package_weight > 150) {
  $error_message[0] = 'weight';
  $error_message[1] = 'Weight must be less than 150 pounds.';
} else if ($package_weight < 0) {
  $error_message[0] = 'weight';
  $error_message[1] = 'Weight must be positive.';
} else if ($length > 36) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Length must be less than 36 inches.';
} else if ($width > 36) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Width must be less than 36 inches.';
} else if ($height > 36) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Height must be less than 36 inches.';
} else if ($length < 0) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Length must be positive.';
} else if ($width < 0) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Width must be positive.';
} else if ($height < 0) {
  $error_message[0] = 'dimensions';
  $error_message[1] = 'Height must be positive.';
}

// go back to the shipping page if there is an error
if ($error_message != array()) {
  $_SESSION['label_error_message'] = $error_message;
  $_SESSION['shipping_data'] = serialize($shipping_data);
  header('Location: shipping.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
  <?php include 'src/html/header.html'; ?>
  <main>
    <div class="row row justify-content-sm-center">
      <div class="col-3">
        <!-- button / form to go back and edit the label -->
        <form style="display: inline;" action="src/php/edit_shipping.php" method="POST">
          <input type="hidden" name="shipping_data" value="<?php echo htmlspecialchars(serialize($shipping_data)); ?>">
          <button type="submit" class="btn btn-outline-secondary">Edit</button>
        </form>
        <!-- <button onclick="window.location.href='src/php/edit_shipping.php' " class="btn btn-outline-secondary">Edit</button> -->

        <!-- button to print the label -->
        <button onclick="printDiv('label')" class="btn btn-outline-secondary">Print</button>
        <!-- <button onclick="window.print()" class="btn btn-outline-secondary">Print</button> -->
        
        <!-- button to create a new label -->
        <button onclick="window.location.href='shipping.php'" class="btn btn-outline-secondary">New Label</button>
        <!-- <button onclick="window.location.href='src/php/new_shipping.php'" class="btn btn-outline-secondary">New Label</button> -->
      </div>
    </div>
    <div class="row justify-content-sm-center">
      <div class="col-8">
        <h1>Shipping</h1>
        <h5>Fill out this form to generate the shipping label!</h5>
      </div>
      <div class="row justify-content-sm-center pt-2">
        <div class="label" id="label">
          <h2>UPS Shipping Label</h2>
          <p class="address"><?php echo $address_one; ?></p>
          <?php if ($address_two) { ?>
            <p class="address"><?php echo $address_two; ?></p>
          <?php } ?>
          <p class="address"><?php echo $city . ', ' . $state . ' ' . $zip_code; ?></p>
          <div class="city-state-zip">
            <p>Newark</p>
            <p>NJ 07103</p>
          </div>
          <p>Weight: <?php echo $package_weight; ?> lbs</p>
          <p>Dimensions: <?php echo $length . 'in x ' . $width . 'in x ' . $height; ?>in</p>
          <p>Order Number: <?php echo $order_number; ?></p>
          <p>Tracking Number: <?php echo rand(9999999, 99999999); ?></p>
          <p>Ship Date: <?php echo $ship_date; ?></p>
          <figure>
            <img style="width:100%; height:auto" src="images\barcode.jpg" alt=" shipping barcode" width="100px" height="100px">
          </figure>
        </div>
      </div>
  </main>

  <script>
    function printDiv(divId) {
      var printContents = $('#' + divId).html();
      var originalContents = $('body').html();
      $('body').html(printContents);
      window.print();
      $('body').html(originalContents);
    }
  </script>

  <?php include 'src/html/footer.html'; ?>
</body>

</html>