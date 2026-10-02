<?php
  require_once "userFunctions.php";
  require_once "database.php";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $errors = validateUser($username, $email, $password);

    if (empty($errors)) {
      createUser($conn, $username, $email, $password);

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
        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($errors)): ?>
            
            <div class="error">

                <?php foreach ($errors as $error): ?>

                    <p><?= htmlspecialchars($error) ?></p>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

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