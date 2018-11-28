<?php

include './../config.php';
include './../lib/DButils.php';
$dbname = $GLOBALS['dbname'];

print_r( queryDB("CREATE DATABASE ". $dbname));

?>