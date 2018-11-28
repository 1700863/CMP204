<?php

include './DButils.php';

// define variables and set to empty values
// $registrant_usernameErr = $registrant_email_err = $$registrant_password_err = "";
$registrant_username = $registrant_email = $registrant_password = "";
$response_array = array(
  "validationError" => false
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $registrant_username = $_POST["username"];
  $registrant_email = $_POST["email"];
  $registrant_password = $_POST["password"];


  if (empty($registrant_username)) {
    $response_array['validationError']['username'] = "A Username is required";
  } else {
    $registrant_username = tidy_input($registrant_username);
  }

  if (empty($registrant_email)) {
    $response_array['validationError']['email'] = "Email is required";
  } else {
    if (!filter_var($registrant_email, FILTER_VALIDATE_EMAIL)) {
      $response_array['validationError']['email'] = "Invalid email format"; 
    } else {
      $registrant_email = tidy_input($registrant_email);
    }
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

  $createDB = "CREATE TABLE IF NOT EXISTS Customers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    user VARCHAR(30) NOT NULL,
    pass VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP
    )";

  dbExec($createDB);

  $createUser = "INSERT INTO Customers (user, pass, email) VALUES ('$registrant_username' , '$registrant_password' , '$registrant_email')";

  dbExec($createUser);

  $response_array['newUser'] = array(
    "user" => $registrant_username,
    "email" => $registrant_email
  );
}

header('Content-type: application/json');
echo json_encode($response_array);
?>
