<?php

function validateUser($username, $email, $password)
{
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if (strlen($username) > 50) {
        $errors[] = "Username cannot be longer than 50 characters.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($password === null) {
        $errors[] = "Password is required.";
    } else {
        $passwordErrors = validatePassword($password);

        $errors = array_merge($errors, $passwordErrors);
    }

    return $errors;
}

function validatePassword($password)
{
    $errors = [];
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
      $errors[] = "Password must contain a special character.";
    }

    if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
      $errors[] = "Password must contain a uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $password)) {
      $errors[] = "Password must contain a lowercase letter.";
    }

    if (!preg_match('/[0-9]/', $password)) {
      $errors[] = "Password must contain a number.";
    }

    return $errors;
}

function createUser($conn, $username, $email, $password) {

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (Username, Email, Password)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("sss", $username, $email, $passwordHash);

    return $stmt->execute();
}

function getUserById($conn, $id) {
    $sql = "SELECT Id, Username, Email, Password
            FROM users
            WHERE Id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return false;
    }
    return $result->fetch_assoc();
    
}
function getUserByEmail($conn, $email){
    $sql = "SELECT Id, Username, Email, Password
            FROM users
            WHERE email = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        return false;
    }
    return $result->fetch_assoc();
}

function getAllUsers($conn) {
    $sql = "SELECT Id, Username, Email FROM users";

    $result = $conn->query($sql);

    return $result;
}
function updateUser($conn, $username, $email, $id){
    $sql = "UPDATE users
            SET Username = ?, Email = ?
            WHERE Id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ssi", $username, $email, $id);
    
    return $stmt->execute();

}
function updatePassword($conn, $id, $password)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users
            SET Password = ?
            WHERE Id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("si", $hashedPassword, $id);

    return $stmt->execute();
}
function updateUserProfile($conn, $id, $username, $email)
{
    $sql = "UPDATE users
            SET Username = ?, Email = ?
            WHERE Id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ssi", $username, $email, $id);

    return $stmt->execute();
}
function deleteUser($conn, $id){

    $sql = "DELETE FROM users WHERE Id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);

    return $stmt->execute();
}