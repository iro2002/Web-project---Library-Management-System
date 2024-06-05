<?php
session_start();

if(isset($_SESSION['loggedInStatus'])){
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form in PHP MySQL with Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('picture.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            margin-bottom: 100px;
            width:950px;
        }
        .login-card {
            padding: 30px;
            border-radius: 30px;
        }
        .login-btn {
            background-color: #6677BC ;
            border: none;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
        .card-header {
           
            text-align: center;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card shadow">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
                            foreach($_SESSION['errors'] as $error){
                                ?>
                                <div class="alert alert-warning"><?= $error; ?></div>
                                <?php
                            }
                            unset($_SESSION['errors']);
                        }

                        if(isset($_SESSION['message'])){
                            echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                            unset($_SESSION['message']);
                        }
                        ?>

                        <form action="login-code.php" method="POST">

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="loginBtn" class="btn btn-primary login-btn w-100">Login</button>
                            </div>
                            <div class="text-center">
                               <h6>Don't Have An Account</h6> 
                                <a href="register.php">Register</a>
                            </div>

                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php

require 'footer.php';
?>
</body>
</html>

