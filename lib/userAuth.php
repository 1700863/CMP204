<?php 

// Include config file
require_once "./../config.php";

$serverResponse = array(
        "validationError" => false
    );

function setServerResponse($array, $code) {
    http_response_code($code);
    header('Content-type: application/json');
    echo json_encode($array);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authType = $_POST["submit"];

    if ($authType == "Login") {
        $serverResponse["authType"] = $authType;

        $username = $password = "";

        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $serverResponse["validationError"]["username"] = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $serverResponse["validationError"]["password"] = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(!$serverResponse["validationError"]){
            // Prepare a select statement
            $sql = "SELECT id, username, password FROM users WHERE username = :username";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Check if username exists, if yes then verify password
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row["id"];
                            $username = $row["username"];
                            $hashed_password = $row["password"];
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["username"] = $username;

                                // Create cookie of username
                                setcookie(
                                    'user',
                                    $username,
                                    time() + (86400 * 30),
                                    "/");
                                
                                // Redirect user to welcome page
                                $serverResponse['message'] = "Welcome back, $username";
                                setServerResponse($serverResponse, 202);
                            } else{
                                // Display an error message if password is not valid
                                $serverResponse["validationError"]["submit"] = "Credentials not recognised";
                                setServerResponse($serverResponse, 403);
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $serverResponse["validationError"]["submit"] = "Credentials not recognised";
                        setServerResponse($serverResponse, 403);
                    }
                } else{
                    $serverResponse["validationError"]["submit"] = "Something went wrong, please try again later.";
                    setServerResponse($serverResponse, 503);
                }
            }
            
            // Close statement
            unset($stmt);
        } else {
            setServerResponse($serverResponse, 200);
        }
        
        // Close connection
        unset($pdo);

    } elseif ($authType == "Register") {
        $serverResponse["authType"] = $authType;

        $username = $email = $password = $confirm_password = "";


        // Validate username
        if(empty(trim($_POST["username"]))){
            $serverResponse["validationError"]["username"] = "Please enter username.";
        } else {
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = :username";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $serverResponse["validationError"]["username"] = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    $serverResponse["validationError"]["submit"] = "Something went wrong, please try again later.";
                }
            }
            
            // Close statement
            unset($stmt);
        }
        
        // Validate email
        if(empty(trim($_POST["email"]))){
            $serverResponse["validationError"]["email"] = "Please enter an email.";     
        } else {
            if( filter_var(filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) ){
                $email = trim($_POST["email"]);
            } else {
                $serverResponse["validationError"]["email"] = "Please enter a valid email adddress.";
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $serverResponse["validationError"]["password"] = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $serverResponse["validationError"]["password"] = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $serverResponse["validationError"]["confirm_password"] = "Please confirm password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);

            if($password != $confirm_password){
                $serverResponse["validationError"]["confirm_password"] = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(!$serverResponse["validationError"]){
        // if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // User is created, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;

                    // Create cookie of username
                    setcookie(
                        'user',
                        $username,
                        time() + (86400 * 30),
                        "/");
                    $stmt->fetch();
                    $serverResponse['message'] = "Welcome to the party, $username";
                    setServerResponse($serverResponse, 202);
                } else {
                    $serverResponse["validationError"]["submit"] = "Something went wrong, please try again later.";
                    setServerResponse($serverResponse, 503);
                }
            }
            
            // Close statement
            unset($stmt);
        } else {
            if(array_key_exists("submit", $serverResponse["validationError"])) {
                setServerResponse($serverResponse, 503);
            } else {
                setServerResponse($serverResponse, 400);
            }
        }
        
        // Close connection
        unset($pdo);

    } else {
        $serverResponse["authType"] = "Unkown";
        setServerResponse($serverResponse, 400);
    }

} else {
    $serverResponse["requestError"] = "Method not allowed";
    setServerResponse($serverResponse, 405);
}

// $serverResponse["requestError"] = "Request not recognised.";
// setServerResponse($serverResponse, 500);

?>