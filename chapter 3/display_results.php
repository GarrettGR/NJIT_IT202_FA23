<?php
    //get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);

    $error_message = '';
    $investment_error_message = '';
    $interest_error_message = '';
    $years_error_message = '';


    //validate input data
    if ($investment === FALSE)
        $investment_error_message = 'Investment must be a valid number.';
    else if ($investment <= 0)
        $investment_error_message = 'Investment must be greater than zero.';
    else if ($interest_rate === FALSE) 
        $interest_error_message = 'Interest rate must be a valid number.';
    else if ($interest_rate <= 0) 
        $interest_error_message = 'Interest rate must be greater than zero.';
    else if ($years === FALSE)
        $years_error_message = 'Years must be a valid whole number.';
    else if ($years <= 0) 
        $years_error_message = 'Years must be greater than zero.';
    else if ($years > 30)
        $years_error_message = 'Years must be less than 31.';
    
    if ($investment_error_message != ''){
        $error_message = $investment_error_message;
        include('future_value_form.php');
        exit();
    } else if ($interest_error_message != ''){
        $error_message = $interest_error_message;
        include('future_value_form.php');
        exit();
    } else if ($years_error_message != ''){
        $error_message = $years_error_message;
        include('future_value_form.php');
        exit();
    }

    //calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) 
        $future_value += $future_value * $interest_rate * .01;
    
    //apply currency and percent formatting
    $investment_f = '$'.number_format($investment, 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
?> 
<!DOCTYPE html>
    <head>
        <title>Future Value Calculator</title>
    </head>
    <body>
        <main>
            <h1>Future Value Calculator</h1>
            <label>Investment Amount:</label>
            <span><?php echo $investment_f; ?></span><br>
            <label>Yearly Interest Rate:</label>
            <span><?php echo $yearly_rate_f; ?></span><br>
            <label>Number of Years:</label>
            <span><?php echo $years; ?></span><br>
            <label>Future Value:</label>
            <span><?php echo $future_value_f; ?></span><br>
        </main>
    </body>
</html>