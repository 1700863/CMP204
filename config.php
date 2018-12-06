<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'cmp204');
 
define('DB_SERVER', 'lochnagar.abertay.ac.uk');
define('DB_USERNAME', 'sql1700863');
define('DB_PASSWORD', 'h7dwbGxW7bD6');
define('DB_NAME', 'sql1700863');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

/* Create Tables if not there */
/* Users table */
$pdo->query("CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
/* Vote table */
$pdo->query("CREATE TABLE IF NOT EXISTS trackvote (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL UNIQUE,
        track VARCHAR(22) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
?>