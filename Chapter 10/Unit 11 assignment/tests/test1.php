<?php

$users = array(
  1 => array(
    'name' => 'John',
    'email' => 'john@gmail.com',
    'age' => 30,
    'city' => 'New York'
  ),
    2 => array(
        'name' => 'Mike',
        'email' => 'mike@yahoo.com',
        'age' => 35,
        'city' => 'Los Angeles'
    )

);

echo json_encode($users);

?>