<?php 
    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    require_once "database.php";

    $userId = $_SESSION["user_id"];

    $sql = "SELECT Id, Username, Email
            FROM users
            WHERE Id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "hey";
    }
    $user = $result->fetch_assoc();

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

    <!-- Navigation -->
    <header class="navbar">

        <a href="dashboard.php" class="logo">
            Logo
        </a>

        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>

    </header>


    <!-- Main content -->
    <main class="container">

        <div class="page-header">
            <div>
                <h1>Dashboard</h1>
                <p>Welcome back, <?= htmlspecialchars($username) ?>!</p>
            </div>
        </div>


        <!-- Dashboard cards -->
        <div class="dashboard-grid">

            <div class="dashboard-card">
                <h2>Account info</h2>

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