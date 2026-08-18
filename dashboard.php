<?php 
    session_start();

    if (!isset($_SESSION["user_id"])){
        header("Location: inloggen.php");
        exit;
    }
    require "database.php";

    $userId = $_SESSION["user_id"];

    $sql = "SELECT Username, Email FROM users WHERE Id = ?";

    $data = $conn->prepare($sql);
    $data->bind_param("i", $userId);
    $data->execute();

    $result = $data->get_result();
    $user = $result->fetch_assoc();

    $username = $user["Username"];
    $email = $user["Email"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>registreren</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Dashboard</h1>

<a href="users.php">Manage users</a>
<a href="logout.php">Logout</a>
<form method="POST">
    <button type="submit" name="users">Go to users overview</button>
</form>
<?php 
    echo "---User info--- <br>";
    echo "Username: " . $username . "<br>";
    echo "E-mail: " . $email;
    

?>

</body>

</html>