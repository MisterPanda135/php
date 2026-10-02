<?php 
    session_start();

    require_once "auth.php";
    requireLogin();

    require_once "database.php";
    require_once "userFunctions.php";

    $userId = $_SESSION["user_id"];

    $user = getUserById($conn, $userId);

    $username = $user["Username"];
    $email = $user["Email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="navbar">

        <a href="dashboard.php" class="logo">
            MyApp
        </a>

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
                <h1>Dashboard</h1>
                <p>Welcome back, <?= htmlspecialchars($username) ?>!</p>
            </div>
        </div>

        <div class="dashboard-grid">

            <div class="dashboard-card">
                <h2>Users</h2>

                <p>
                    Manage the users in your application.
                </p>

                <a href="users.php" class="button">
                    Manage Users
                </a>
            </div>


            <div class="dashboard-card">
                <h2>My Profile</h2>

                <p>
                    View and manage your account information.
                </p>

                <a href="profile.php" class="button secondary">
                    View Profile
                </a>
            </div>


            <div class="dashboard-card">
                <h2>Account</h2>

                <p>
                    <strong>Username:</strong>
                    <?= htmlspecialchars($username) ?>
                </p>

                <p>
                    <strong>Email:</strong>
                    <?= htmlspecialchars($email) ?>
                </p>
            </div>

        </div>

    </main>

</body>

</html>