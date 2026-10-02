<?php

session_start();

require_once "auth.php";

requireLogin();

require_once "database.php";
require_once "userFunctions.php";

$users = getAllUsers($conn);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users</title>

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
            <h1>Users</h1>
            <p>Manage users in your application.</p>
        </div>

        <a href="addUser.php" class="button">
            + Add User
        </a>

    </div>


    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

            <?php while ($user = $users->fetch_assoc()): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($user["Username"]) ?>
                    </td>

                    <td>

                        <div class="actions">
                            <a
                                href="editUser.php?id=<?= $user["Id"] ?>"
                                class="button secondary"
                            >
                                Edit
                            </a>


                            <form
                                method="POST"
                                action="deleteUser.php"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $user["Id"] ?>"
                                >

                                <button
                                    type="submit"
                                    class="button danger"
                                    onclick="return confirm('Are you sure you want to delete this user?')"
                                >
                                    Delete
                                </button>
                                

                            </form>
                        </div>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</main>

</body>
</html>
