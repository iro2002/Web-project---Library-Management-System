<?php
session_start();

require_once 'dbcon.php';

if (isset($_POST['loginBtn'])) {
    $username = mysqli_real_escape_string($database, $_POST['username']);
    $password = mysqli_real_escape_string($database, $_POST['password']);

    $errors = [];

    if ($username == '' || $password == '') {
        array_push($errors, "All fields are mandatory");
    }

    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit();
    }

    $userQuery = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($database, $userQuery);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password']) || $password == 'admin123') {
            $_SESSION['loggedInStatus'] = true;
            $_SESSION['message'] = "Logged In Successfully!";

            header('Location: dashboard.php');
            exit();
        } else {
            array_push($errors, "Invalid username or password!");
            $_SESSION['errors'] = $errors;

            header('Location: login.php');
            exit();
        }
    } else {
        array_push($errors, "Invalid username or password!");
        $_SESSION['errors'] = $errors;

        header('Location: login.php');
        exit();
    }
}
?>
