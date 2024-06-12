<?php
require_once('dbcon.php');
session_start();

// Initialize variables
$update = false;
$user_id = "";
$first_name = "";
$last_name = "";
$password = "";
$username = "";
$email = "";

// Function to check if User ID, Email, or Username already exists
function checkExistence($database, $user_id, $email, $username) {
    $stmt = $database->prepare("SELECT * FROM user WHERE user_id = ? OR email = ? OR username = ?");
    $stmt->bind_param("sss", $user_id, $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Saving new user details
if (isset($_POST['save'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (checkExistence($database, $user_id, $email, $username)) {
        $_SESSION['message'] = "User ID, Email, or Username already exists!";
        $_SESSION['msg_type'] = "danger";
        header("Location: manageuser_index.php");
        exit();
    } else {
        $stmt = $database->prepare("INSERT INTO user (user_id, first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $user_id, $first_name, $last_name, $email, $username, $hashedPassword);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("Location: manageuser_index.php");
        exit();
    }
}

// Deleting a user
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    $stmt = $database->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("Location: manageuser_index.php");
    exit();
}

// Editing a user
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $update = true;

    $stmt = $database->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $password = $row['password'];
        $username = $row['username'];
        $email = $row['email'];
    }

    $stmt->close();
}

// Updating a user
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Check for existence but allow current user_id, email, and username to pass
    $stmt = $database->prepare("SELECT * FROM user WHERE (user_id = ? OR email = ? OR username = ?) AND user_id != ?");
    $stmt->bind_param("ssss", $user_id, $email, $username, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "User ID, Email, or Username already exists!";
        $_SESSION['msg_type'] = "danger";
        header("Location: manageuser_index.php");
        exit();
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $database->prepare("UPDATE user SET first_name = ?, last_name = ?, password = ?, username = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("ssssss", $first_name, $last_name, $hashedPassword, $username, $email, $user_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "success";
        header("Location: manageuser_index.php");
        exit();
    }
}
?>
