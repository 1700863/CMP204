
<?php


    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    // if (!$conn){
    //     die("Connection failed: " . mysqli_connect_error());
    // }

    // mysqli_close($conn);
?>

<?php
include_once './config.php';

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE " . $dbname;
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>