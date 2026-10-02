<?php
session_start();

require_once "auth.php";

requireLogin();

require_once "database.php";
require_once "userFunctions.php";

$id = $_GET["id"];

$user = getUserById($conn, $id);

if (!$user) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];

    if (updateUser($conn, $username, $email, $id)) {

        header("Location: users.php");
        exit;
    }
    $error = "Something went wrong.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User</title>

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
            <h1>Edit User</h1>
            <p>Update this user's information.</p>
        </div>

        <a href="users.php" class="button secondary">
            Cancel
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
                    value="<?= htmlspecialchars($user["Username"]) ?>"
                    required
                >
            </div>


            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($user["Email"]) ?>"
                    required
                >
            </div>

            <button type="submit" class="button">
                Save Changes
            </button>

        </form>


        <?php if (isset($error)): ?>

            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

    </div>

</main>

</body>
</html>