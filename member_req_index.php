<?php
require 'dbcon.php';
require 'member_reg_pros.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="nav-list">
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="manageuser_index.php"><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href="book_reg_index.php"><i class="fas fa-book"></i> Add Books</a></li>
                <li><a href="book_cateogary_index.php"><i class="fas fa-list"></i> Add Book Category</a></li>
                <li><a href="member_req_index.php"><i class="fas fa-user-circle"></i> Member registration</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <header class="header">
                <h1 style="font-size:35px">Library Management System</h1>
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button type="button">Search</button>
                </div>
                
            </header>
            <div class = "errormassage">
            <?php if (isset($_SESSION['message'])): ?>
                    <div>
                        <?php 
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
            <br>
            <section class="content">
                
                <div class="card1">
                <h1>Member Details</h1>
             
                    <div class="container" style="margin-bottom:5em;">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                           
                                <tr>
                                    <th>Member ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Birth Day</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $database->query("SELECT * FROM member");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['member_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['birthday']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td>
                                                <a href="member_req_index.php?edit=<?php echo $row['member_id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="member_reg_pros.php?delete=<?php echo $row['member_id']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card2">
                    <div>
                        <div>
                            <?php if ($update == true): ?>
                                <h3 style="color:; background-color:#257FBE;">Edit Member</h3>
                            <?php else: ?>
                                <h3 style="color:; background-color:#257FBE;">Add Member</h3>
                            <?php endif; ?>
                        </div>
                        <script>
        function validateForm() {
            const email = document.getElementById('email').value;
            const memberID = document.getElementById('memberid').value;
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const memberIDPattern = /^M\d{3}$/;

            errorMessage.innerHTML = '';
            successMessage.innerHTML = '';

            if (!emailPattern.test(email)) {
                errorMessage.innerHTML = 'Enter valid email';
                return false;
            }

            if (!memberIDPattern.test(memberID)) {
                errorMessage.innerHTML = 'ID format M001.';
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <section>
            <div class="form-container">
                <div id="error-message" class="error-message" style="color: red;"></div>
                <div id="success-message" class="success-message" style="color: green;"></div>
                <form action="member_reg_pros.php" method="post" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="memberid">Member ID</label>
                        <input type="text" id="memberid" name="member_id" value="<?php echo $member_id; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo $first_name; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo $last_name; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birth Day</label>
                        <input type="date" id="birthday" name="birthday" value="<?php echo $birthday; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
                    </div>
                    <?php if ($update == true): ?>
                        <button type="submit" name="update" class="btn btn-warning">Update</button>
                    <?php else: ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php endif; ?>
                </form>
            </div>
        </section>
    </div>
    

    
</body>
</html>
