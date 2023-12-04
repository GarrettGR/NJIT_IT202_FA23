<?php
    //get  data from the form
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $address_one = filter_input(INPUT_POST, 'address_one');
    $address_two = filter_input(INPUT_POST, 'address_two');
    $state = strtoupper(filter_input(INPUT_POST, 'state'));
    $city = filter_input(INPUT_POST, 'city');
    $zip_code = filter_input(INPUT_POST, 'zip_code');
    $ship_date = filter_input(INPUT_POST, 'ship_date');
    $package_dimensions = filter_input(INPUT_POST, 'package_dimensions');
    $package_weight = filter_input(INPUT_POST, 'package_weight');
    $order_number = filter_input(INPUT_POST, 'order_number');

    $error_message = '';
    $weight_error_message = '';
    $dimension_error_message = '';
    $zip_error_message = '';
    $state_error_message = '';

    //delim the package dimensions
    $dimension_array = explode(',', $package_dimensions);
    $length = $dimension_array[0];
    $width = $dimension_array[1];
    $height = $dimension_array[2];

    //format the ship date
    $ship_date = date('F j, Y', strtotime($ship_date));


    //validate input data
    $dimension_array = explode(',', $package_dimensions);
    $states = [
    'AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana',
    'IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire',
    'NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas',
    'UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming',];

    function count_digit($number) {
        return strlen($number);
    }

    if ($package_weight > 150)
        $weight_error_message = 'Weight must be less than 150 pounds.';
    else if ($length > 36)
        $dimension_error_message = 'Length must be less than 36 inches.';
    else if ($width > 36)
        $dimension_error_message = 'Width must be less than 36 inches.';
    else if ($height > 36)
        $dimension_error_message = 'Height must be less than 36 inches.';
    else if ($length < 0)
        $dimension_error_message = 'Length must be positive.';
    else if ($width < 0)
        $dimension_error_message = 'Width must be positive.';
    else if ($height < 0)
        $dimension_error_message = 'Height must be positive.';
    else if (!array_key_exists($state, $states))
        $state_error_message = 'State must be a valid state abbreviation.';
    else if (count_digit($zip_code) != 5)
        $zip_error_message = 'Zip code must be 5 digits.';
    else if ($zip_code < 0)
        $zip_error_message = 'Zip code must be positive.';
    else if ($zip_code > 99999)
        $zip_error_message = 'Zip code must be less than 99999.';

    if ($weight_error_message != ''){
        $error_message = $weight_error_message;
        include('shipping.php');
        exit();
    } else if ($dimension_error_message != ''){
        $error_message = $dimension_error_message;
        include('shipping.php');
        exit();
    } else if ($zip_error_message != ''){
        $error_message = $zip_error_message;
        include('shipping.php');
        exit();
    } else if ($state_error_message != ''){
        $error_message = $state_error_message;
        include('shipping.php');
        exit();
    }
?> 
<!DOCTYPE html>
    <head>
        <title>Hartrum's Pet Shop - Shipping Label</title>
        <link rel = 'icon' href = "src/img\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:no-preference)">
        <link rel = 'icon' href = "src/img\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:dark)">
        <link rel = 'icon' href = "src/img\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:light)">
        <link rel = 'stylesheet' href = 'style.css'>
    
        <style>
            .label {
                border: 1px solid black;
                padding: 10px;
                width: 300px;
                background-color: white;
            }

            .label h2 {
                margin: 0;
            }

            .label p {
                margin: 0;
            }

            .label .address {
                font-weight: bold;
            }

            .label .city-state-zip {
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <span><?php $page = 'shipping'; include_once('header.php'); ?></span><br>
        <main>
            <h1>Shipping Label: </h1>
            <div class="label">
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
                <p>Tracking Number: <?php echo rand(9999999,99999999);?></p>
                <p>Ship Date: <?php echo $ship_date; ?></p>
                <figure>
                    <img style="width:100%; height:auto" src="images\barcode-on-white-background-illustration-free-vector.jpg" alt=" shipping barcode" width="100px" height="100px">
                </figure>
            </div>
        </main>
        <span><?php include_once('footer.php'); ?></span><br>
    </body>
</html>