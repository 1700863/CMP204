
<?php
    $servername = "lochnagar.abertay.ac.uk";
    $username = "sql1700863";
    $password = "h7dwbGxW7bD6";
    $dbname = "sql1700863";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_close($conn);
?>

<!-- 
Form
User input >> Username;
        >> Password;

Send details to Database;
    if Match(log in function)
        if (admin = true)
            go to admin page
        else (go to vote)
    else(return to login form) 
    


    -->

<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE myDB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
