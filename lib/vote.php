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

    if($authType == "vote")
        $serverResponse["authType"] = $authType;

        $username = "";
        $track = $_POST["track"];


        $sql = "SELECT id FROM trackvote WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $serverResponse["validationError"]["username"] = "You have already voted.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                $serverResponse["validationError"]["submit"] = "Something went wrong, please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        

        
        // Check input errors before inserting in database
        if(!$serverResponse["validationError"]){
            // Prepare an insert statement
            $sql = "INSERT INTO trackvote (username, track) VALUES (:username, :track)";

            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $stmt->bindParam(":track", $param_track, PDO::PARAM_STR);
                
                // Set parameters
                $param_username = $username;
                $param_track = $track;
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["voted"] = $track;

                    $serverResponse['message'] = "Welcome to the party, $username";
                    setServerResponse($serverResponse, 200);
                } else {
                    $serverResponse["validationError"]["submit"] = "Something went wrong, please try again later.";
                    setServerResponse($serverResponse, 503);
                }
            }
            // Close statement
            unset($stmt);
            // }
            
            
        } else {
            if(array_key_exists("submit", $serverResponse["validationError"])) {
                setServerResponse($serverResponse, 503);
            } else {
                setServerResponse($serverResponse, 400);
            }
        }
        

    // } else {
    //     $serverResponse["authType"] = "Unkown";
    //     setServerResponse($serverResponse, 400);
    // }

} else {
    $serverResponse["requestError"] = "Method not allowed";
    setServerResponse($serverResponse, 405);
}

// $serverResponse["requestError"] = "Request not recognised.";
// setServerResponse($serverResponse, 500);

?>