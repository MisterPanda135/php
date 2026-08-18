<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require "database.php";

        $sql = "SELECT Id, Username, Password, Email FROM users WHERE Email = ?";

        $data = $conn->prepare($sql);

        $data->bind_param("s", $email);

        $data->execute();

        $result = $data->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
        
        

            if (password_verify($password, $user["Password"])){
                

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
  <title>inloggen</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body> 
  <form method="post">
    E-mail: <input type="text" name="email"><br>
    Password: <input type="text" name="password"><br>
    <input type="submit" name="login" value="Inloggen">
  </form>

<?php

if (isset($error)) {
    echo "<p>" . $error . "</p>";
}

?>
</body>

</html>