<?php
  require_once "database.php";

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


    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (Username, Email, Password)
            VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $username, $email, $passwordHash);

        $stmt->execute();

        header("Location: login.php");
        exit;
    }
  } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-container">

    <div class="auth-box">

        <h1>Create Account</h1>

        <p>Create your account to get started.</p>


        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($errors)): ?>

            <div class="error">

                <?php foreach ($errors as $error): ?>

                    <p><?= htmlspecialchars($error) ?></p>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>


        <form method="POST">

            <div class="form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >

            </div>


            <button type="submit" class="button">
                Create Account
            </button>

        </form>


        <a href="login.php" class="auth-link">
            Already have an account? Login
        </a>

    </div>

</div>

</body>
</html>
