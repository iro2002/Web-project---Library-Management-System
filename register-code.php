<?php
session_start();
require 'dbcon.php'; // Make sure you have a database connection file

if(isset($_POST['registerBtn'])){
    $errors = [];

    $userID = trim($_POST['userID']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for existing email, username, and user_id
    $stmt = $database->prepare("SELECT * FROM user WHERE email = ? OR username = ? OR user_id = ?");
    $stmt->bind_param("sss", $email, $username, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($existingUser = $result->fetch_assoc()) {
        if($existingUser['email'] == $email){
            $errors[] = "Email already registered.";
        }
        if($existingUser['username'] == $username){
            $errors[] = "Username already taken.";
        }
        if($existingUser['user_id'] == $userID){
            $errors[] = "User ID already exists.";
        }
    }

    if(empty($errors)){
        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $database->prepare("INSERT INTO user (user_id, first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $userID, $firstname, $lastname, $username, $email, $hashedPassword);

        if($stmt->execute()){
            // Clear previous errors and set success message
            unset($_SESSION['errors']);
            $_SESSION['message'] = "Registration successful! Login now";
            header('Location: login.php'); // Redirect to login page upon successful registration
            exit();
        } else {
            $errors[] = "Something went wrong. Please try again.";
        }
    }

    // Set errors in session and redirect back to registration page
    $_SESSION['errors'] = $errors;
    header('Location: register.php');
    exit();
}
?>
