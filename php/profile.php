<?php
session_start();

require_once "auth.php";
requireLogin();

require_once "database.php";
require_once "userFunctions.php";

$userId = $_SESSION["user_id"];

$user = getUserById($conn, $userId);

if (!$user) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST["action"];

    if ($action === "profile") {

        $username = $_POST["username"];
        $email = $_POST["email"];

        $errors = validateUser($username, $email, null);

        if (empty($errors)) {

            if (updateUserProfile($conn, $userId, $username, $email)) {
                $success = "Profile updated successfully.";

                $user = getUserById($conn, $userId);
            } else {
                $error = "Something went wrong.";
            }
        }

    } elseif ($action === "password") {

        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        if (!password_verify($currentPassword, $user["Password"])) {

            $error = "Your current password is incorrect.";

        } elseif ($newPassword !== $confirmPassword) {

            $error = "The new passwords do not match.";

        } else {

            $errors = validatePassword($newPassword);

            if (empty($errors)) {

                if (updatePassword($conn, $userId, $newPassword)) {
                    $success = "Password changed successfully.";

                    $user = getUserById($conn, $userId);
                } else {
                    $error = "Something went wrong.";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

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
            <h1>Profile</h1>
            <p>Manage your account information.</p>
        </div>
    </div>


    <?php if (isset($success)): ?>

        <div class="success">
            <?= htmlspecialchars($success) ?>
        </div>

    <?php endif; ?>


    <?php if (isset($error)): ?>

        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>
        <?php if (!empty($errors)): ?>
            
        <div class="error">

            <?php foreach ($errors as $error): ?>

                <p><?= htmlspecialchars($error) ?></p>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


    <div class="profile-grid">


        <div class="form-container">

            <h2>Profile information</h2>

            <form method="POST">

                <input type="hidden" name="action" value="profile">

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= htmlspecialchars($user["Username"]) ?>"
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
                        value="<?= htmlspecialchars($user["Email"]) ?>"
                        required
                    >

                </div>


                <button type="submit" class="button">
                    Save changes
                </button>

            </form>

        </div>

        <div class="form-container">

            <h2>Change password</h2>

            <form method="POST">

                <input type="hidden" name="action" value="password">


                <div class="form-group">

                    <label for="current_password">
                        Current password
                    </label>

                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="new_password">
                        New password
                    </label>

                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="confirm_password">
                        Confirm new password
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        required
                    >

                </div>


                <button type="submit" class="button">
                    Change password
                </button>

            </form>

        </div>

    </div>

</main>

</body>

</html>