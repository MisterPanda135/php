<?php

session_start();

require_once "auth.php";

requireLogin();

require_once "database.php";
require_once "userFunctions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: users.php");
    exit;
    
}

$id = $_POST["id"];

if (deleteUser($conn, $id)) {
    header("Location: users.php");
    exit;
}

$error = "Something went wrong.";
?>