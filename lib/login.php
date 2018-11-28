<?php

include './DButils.php';

// define variables and set to empty values
// $registrant_usernameErr = $registrant_email_err = $$registrant_password_err = "";
$registrant_username = $registrant_password = "";
$response_array = array(
  "validationError" => false
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $registrant_username = $_POST["username"];
  $registrant_password = $_POST["password"];


  if (empty($registrant_username)) {
    $response_array['validationError']['username'] = "A Username is required";
  } else {
    $registrant_username = tidy_input($registrant_username);
  }

  if (empty($registrant_password)) {
    $response_array['validationError']['password'] = "<p>A Password is required</p>";
  } else {
    $uppercase = preg_match('@[A-Z]@', $registrant_password);
    $lowercase = preg_match('@[a-z]@', $registrant_password);
    $number    = preg_match('@[0-9]@', $registrant_password);
    if (!$uppercase || !$lowercase || !$number || strlen($registrant_password) < 8) {
      $response_array['validationError']['password'] = "<p>Password must contain:</p><p>At least 8 characters</p><p>At least 1 number</p><p>At least one upper case letter</p><p>At least one lower case letter</p>";
    } else {
      $registrant_password = tidy_input($registrant_password);
    }
  }
}

function tidy_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!$response_array["validationError"]) {

  $getUser = "";

  dbExec($getUser);

  $response_array['newUser'] = array(
    "user" => $registrant_username,
    "email" => $registrant_email
  );

  if(){
    $createDB = "CREATE TABLE IF NOT EXISTS Customers (
    SELECT username, 
    FROM Customers,
    WHERE EXISTS (user input)
    )";
  }
}

header('Content-type: application/json');
echo json_encode($response_array);
?>
