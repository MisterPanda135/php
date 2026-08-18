<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = [];
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
      $errors[] = "Password must contain an special character.";

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Please enter a valid email address.";
    }

    if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
      $errors[] = "Password must contain an uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $password)) {
      $errors[] = "Password must contain an lowercase letter.";
    }

    if (!preg_match('/[0-9]/', $password)) {
      $errors[] = "Password must contain a number.";
    }

    if (count($errors) === 0) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    

      require "database.php";


      $sql = "INSERT INTO users (Username, Email, Password)
          VALUES (?, ?, ?)";

      $data = $conn->prepare($sql);

      if (!$data) {
        die("Prepare failed: " . $conn->error);
      }

      $data->bind_param("sss", $username, $email, $passwordHash);

      if (!$data->execute()) {
        die("Registration failed: " . $stmt->error);
      }

      header("Location: inloggen.php");
      exit;

    }
    

  }
  
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
  <form method="post">
    Username: <input type="text" name="username"><br>
    E-mail: <input type="text" name="email"><br>
    Password: <input type="text" name="password"><br>
    <input type="submit" name="register" value="Registreren">
  </form>


<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (count($errors) > 0) {
    foreach ($errors as $error) {
      echo "<p>" . htmlspecialchars($error) . "</p>";
    }
  }
}
date_default_timezone_set("Europe/Amsterdam");
echo "The current date and time is " . date("Y-m-d H:i:s");
?>

</body>

</html>