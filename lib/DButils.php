<?php
include './../config.php';

function queryDB($query){
    $result = "";
    try {
        $conn = new PDO("mysql:host=" . $GLOBALS['servername'] . ";dbname=" . $GLOBALS['dbname'], $GLOBALS['username'], $GLOBALS['password']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare($query); 
        $stmt->execute();
    
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    }
    catch(PDOException $e)
    {
        $result = $query . "<br>" . $e->getMessage();
    }

    $conn = null;

    return $result;
}

function dbExec($query){
    $result = "";
    try {
        $conn = new PDO("mysql:host=" . $GLOBALS['servername'] . ";dbname=" . $GLOBALS['dbname'], $GLOBALS['username'], $GLOBALS['password']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec($query);
    
        // set the resulting array to associative
        $result = true; 

    }
    catch(PDOException $e)
    {
        $result = $query . "<br>" . $e->getMessage();
    }

    $conn = null;

    return $result;
}

function createDB($db){

    return queryDB("CREATE DATABASE " . $db);

}

?>