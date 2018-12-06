<?php
include './DButils.php';

// define variables and set to empty values
$username  = $password = "";
$response_array = array(
  "validationError" => false
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $response_array['validationError']['root'] = "No user matching these details could be found.";
  } else {
    $username = tidy_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    $response_array['validationError']['root'] = "No user matching these details could be found.";
    $passwordErr = "A Password is required";
  } else {
    $password = tidy_input($_POST["password"]);
  }
}

function tidy_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (!$response_array["validationError"]) {

  
  if(checkTableExists('customers')) {
    
    // get the user and authenticate
    $user = queryDB("SELECT user, pass FROM Customers WHERE user='$username'");

    if(password_verify($password, $user['pass'])) {
      // User is verified
        $sessionDB = "CREATE TABLE IF NOT EXISTS Customers (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
          user VARCHAR(30) NOT NULL,
          pass VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
          reg_date TIMESTAMP
          )";

    } else {
      $response_array['validationError']['root'] = "No user matching these details could be found.";
    }

  } else {
    $response_array['validationError']['root'] = "No user matching these details could be found.";
  }

  // $testUser = "SELECT Username";

  // $createDB = "CREATE TABLE IF NOT EXISTS Customers (
  //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  //   user VARCHAR(30) NOT NULL,
  //   pass VARCHAR(30) NOT NULL,
  //   email VARCHAR(50) NOT NULL,
  //   reg_date TIMESTAMP
  //   )";

  // dbExec($createDB);

  // $createUser = "INSERT INTO Customers (user, pass, email) VALUES ('$registrant_username' , '$registrant_password' , '$registrant_email')";

  // dbExec($createUser);

  // $response_array['newUser'] = array(
  //   "user" => $registrant_username,
  //   "email" => $registrant_email
  // );
}

header('Content-type: application/json');
echo json_encode($response_array);
?>



