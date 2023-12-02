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

// echo json_encode($users);

?>

<html>
  <head>
    <title>Test 3</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- <script src="test1.js"></script> -->
    <script src="test2.js"></script>
  </head>
  <body>
    <main>
      <h1>User</h1>
      <div>
        <label for="user-id">Enter ID:</label>
        <input type="text" name="user-id" id="user-id" value="1" />
        <input type="button" id="view-button" value="View" />
      </div>
      <div id="display"></div>
    </main>
  </body>
</html>
