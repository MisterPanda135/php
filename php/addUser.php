<?php 
session_start();

require_once "auth.php";

requireLogin();

require_once "userFunctions.php";    
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $errors = validateUser($username, $email, $password);

    if (empty($errors)) {
        createUser($conn, $username, $email, $password);

        echo $username . " has been added.";

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add User</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="navbar">

    <a href="dashboard.php" class="logo">MyApp</a>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

</header>


<main class="container">

    <div class="page-header">
        <div>
            <h1>Add User</h1>
            <p>Create a new user account.</p>
        </div>

        <a href="users.php" class="button secondary">
            Back to Users
        </a>
    </div>


    <div class="form-container">

        <form method="POST">

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                >
            </div>


            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >
            </div>


            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>


            <button type="submit" class="button">
                Add User
            </button>

        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($errors)): ?>
            <br>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>

</main>

</body>
</html>

