<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Form in PHP MySQL with Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('picture.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 130vh;
            margin: 0;

        .container {
            max-width: 401px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 19px;
        }
        h4 {
            font-size: 24px;
            margin-bottom: 20px;
            font-family: 'georgia';
        }
        .btn {
            margin: 5px;
        }
        h6 {
            font-size: 18px;
            font-family: 'georgia';
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="card card-body shadow">

            <?php
                if(isset($_SESSION['message'])){
                    echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);
                }
            ?>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Library Management System</h6>
                    <h4>Login and Registration</h4>
                   
                    <br/>

                    <?php if(isset($_SESSION['loggedInStatus'])) : ?>

                        <a href="dashboard.php" class="btn btn-secondary">Dashboard</a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>

                    <?php else: ?>

                        <a href="login.php" class="btn btn-primary">Login</a>
                        <a href="register.php" class="btn btn-info">Register</a>

                    <?php endif; ?>

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
