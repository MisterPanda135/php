<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "database.php";
        require_once "userFunctions.php";

        $user = getUserByEmail($conn, $email);

        if ($user) {
        
            if (password_verify($password, $user["Password"])){
                
                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["Id"];

                header("Location: dashboard.php");
                exit;

            }
            
        }
     $error = "Incorrect password or email.";
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-container">

    <div class="auth-box">

        <h1>Login</h1>

        <p>Sign in to your account.</p>


        <?php if (isset($error)): ?>

            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form method="POST">

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
                Login
            </button>

        </form>


        <a href="register.php" class="auth-link">
            Don't have an account? Register
        </a>

    </div>

</div>

</body>
</html>