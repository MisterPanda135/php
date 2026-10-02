<?php

$dbhost = "mysql";
$dbusername = "root";
$dbpassword = "password";
$dbdatabase = "php";

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbdatabase);

if ($conn->connect_error) {
    die("Database verbinding mislukt: " . $conn->connect_error);
}

?>