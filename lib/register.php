<?php
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = "";
$username = $email = $password = "";
$response_array = [];
include './lib/createDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $response_array['error']['username'] = "A Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }
  
  if (empty($_POST["email"])) {
    $response_array['error']['email'] = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["password"])) {
    $response_array['error']['password'] = "A Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Table doesn't exist, create
// if (queryDB("")) {
  
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS Customers (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
      username VARCHAR(30) NOT NULL,
      password VARCHAR(30) NOT NULL,
      email VARCHAR(50) NOT NULL,
      reg_date TIMESTAMP
      )";

$response_array = queryDB($sql);
// }

// Update user record

// IF Statement

header('Content-type: application/json');
echo json_encode($response_array);
?>