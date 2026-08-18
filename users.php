<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: inloggen.php");
    exit;
}

require "database.php";

$sql = "SELECT Id, Username, Email FROM users";

$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

while ($user = $result->fetch_assoc()) {

    echo "<div>";

    echo htmlspecialchars($user["Username"]);
    echo " - ";
    echo htmlspecialchars($user["Email"]);

    echo " <a href='edit-user.php?id=" . $user["Id"] . "'>Edit</a>";

    echo " <a href='delete-user.php?id=" . $user["Id"] . "'>Delete</a>";

    echo "</div>";
}
?>