<?php

include './DButils.php';

// define variables and set to empty values
// $registrant_usernameErr = $registrant_email_err = $$registrant_password_err = "";
$registrant_username = $registrant_email = $registrant_password = "";
$response_array = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $response_array['error']['username'] = "A Username is required";
  } else {
    $registrant_username = test_input($_POST["username"]);
  }
  
  if (empty($_POST["email"])) {
    $response_array['error']['email'] = "Email is required";
  } else {
    $registrant_email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["password"])) {
    $response_array['error']['password'] = "A Password is required";
  } else {
    $registrant_password = test_input($_POST["password"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$createDB = "CREATE TABLE IF NOT EXISTS Customers (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  user VARCHAR(30) NOT NULL,
  pass VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  reg_date TIMESTAMP
  )";

$response_array['dbCreate'] = dbExec($createDB);

$createUser = "INSERT INTO Customers (user, pass, email) VALUES ('$registrant_username' , '$registrant_password' , '$registrant_email')";

$response_array['userCreate'] = dbExec($createUser);
// }

// Update user record

// IF Statement

header('Content-type: application/json');
echo json_encode($response_array);
?>
