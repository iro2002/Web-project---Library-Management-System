<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form for Library Staff</title>
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
        .register-container {
            margin-top: 10px;
            margin-bottom: 50px;
            max-width: 600px;
        }
        .register-card {
            padding: 20px;
            border-radius: 30px;
        }
        .register-btn {
            background-color: #6677BC;
            border: none;
        }
        .register-btn:hover {
            background-color: #0056b3;
        }
        .card-header {
            text-align: center;
            font-size: 1.5rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card register-card shadow">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
                            foreach($_SESSION['errors'] as $error){
                                echo "<div class='alert alert-warning'>{$error}</div>";
                            }
                            unset($_SESSION['errors']);
                        }

                        if(isset($_SESSION['message'])){
                            echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                            unset($_SESSION['message']);
                        }
                        ?>
                        <form id="registerForm" action="register-code.php" method="POST" onsubmit="return validateForm()">
                            <div id="errorMessages" class="mb-3"></div>
                            <div class="mb-3">
                                <label>User ID</label>
                                <input type="text" name="userID" id="userID" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="registerBtn" class="btn btn-primary register-btn w-100">Register</button>
                            </div>
                            <div class="text-center">
                                <h6>Already Have An Account?<a href="login.php">Login</a></h6> 
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            let userID = document.getElementById("userID").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;
            let username = document.getElementById("username").value;
            let errors = [];

            // Validate User ID format
            const userIDPattern = /^U\d{3}$/;
            if (!userIDPattern.test(userID)) {
                errors.push("User ID must be in the format (e.g., U001).");
            }

            // Validate password length
            if (password.length < 8) {
                errors.push("Password must be more than 8 characters.");
            }

            // Validate email format
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                errors.push("Invalid email format.");
            }

            // Display errors in the form
            let errorMessagesDiv = document.getElementById("errorMessages");
            errorMessagesDiv.innerHTML = "";
            if (errors.length > 0) {
                errors.forEach(error => {
                    let errorDiv = document.createElement("div");
                    errorDiv.className = "alert alert-warning";
                    errorDiv.innerText = error;
                    errorMessagesDiv.appendChild(errorDiv);
                });
                return false;
            }

            return true;
        }
    </script>
    <?php

require 'footer.php';
?>
</body>
</html>
