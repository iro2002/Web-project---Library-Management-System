<?php
require 'dbcon.php';
require 'book_req_pros.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Updated Admin Panel CSS */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            width: : 110vh;
            background: linear-gradient(135deg, #6677BC, #8ca0e0);
            transition: background 0.3s;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: #495057;
            border-bottom: 1px solid #495057;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .nav-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-list li {
            width: 100%;
        }

        .nav-list a {
            display: block;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid #495057;
            transition: background 0.3s;
        }

        .nav-list a:hover {
            background: #1d2124;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background: #f4f4f4;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 36px 20px;
            font-weight: bold;
            margin-bottom: 20px;
            background-color: #495057;
            font-size: 80px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 5px 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        .dark-mode-toggle {
            background: #343a40;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
      

      

        .dark-mode-toggle:hover {
            background: #1d2124;
        }

        .dark-mode {
            background: #121212;
            color: #ffffff;
        }

        .dark-mode .main-content {
            background: #1e1e1e;
            color: #ffffff;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card1 {
            background: #EBEDEF;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
            flex: 1 1 calc(25% - 20px);
            display: flex;
            border :3px;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
            padding-bottom :0px;
        }
        .cards {
            background: #EBEDEF ;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
            flex: 1 1 calc(50% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
            padding-bottom :20px;
        }
                    .form-container {
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #333;
            }

            .form-group input {
                width: calc(100% - 20px);
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 8px;
                transition: border-color 0.3s ease-in-out;
            }

            .form-group input:focus {
                border-color: #6c757d;
                outline: none;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
            }

                            .btn:hover {
                    background-color: #0056b3;
                }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
            }

            .btn:hover {
                background-color: #0056b3;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
            }

            .btn:hover {
                background-color: #0056b3;
            }

                    .dark-mode .card {
                        background: #333333;
                        color: #ffffff;
                    }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }

            .card {
                flex: 1 1 100%;
            }

            .sidebar {
                width: 100px;
            }

            .nav-list a {
                padding: 10px;
                font-size: 14px;
            }

            .main-content {
                padding: 10px;
            }
        }

        /* CSS for table and form */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 5px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }

        table th {
            background-color: #257FBE;
            color: white;
            
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
            border-radius: 5px;
            
        }

        table tr:hover {
            background-color: #ddd;
            border-radius: 5px;
        }

        

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

        .btn:hover {
            opacity: 0.8;
        }
        h3 {
            padding: 8px;
            border-radius: 5px;

        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="nav-list">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href=""><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href=""><i class="fas fa-book"></i> Add Books</a></li>
                <li><a href=""><i class="fas fa-list"></i> Add Book Category</a></li>
                <li><a href="member_req_index.php"><i class="fas fa-cog"></i> Member registration</a></li>
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
                <button class="dark-mode-toggle" onclick="toggleDarkMode()">Dark Mode</button>
            </header>
            <section class="content">
                <div class="card1">
                    <div class="container" style="margin-bottom:5em;">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                    <th>Book Category</th>
                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $database->query("SELECT * FROM book");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['book_id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['category_id']; ?></td>
                                           
                                            <td>
                                                <a href="book_reg_index.php?edit=<?php echo $row['book_id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="book_req_pros.php?delete=<?php echo $row['book_id']; ?>" class="btn btn-danger">Delete</a>
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
           
            const memberID = document.getElementById('book_id').value;
            const errorMessage = document.getElementById('error-message');
            const successMessage = document.getElementById('success-message');

          
            const bookIDPattern = /^B\d{3}$/;

            errorMessage.innerHTML = '';
            successMessage.innerHTML = '';

            if (!memberIDPattern.test(book_id)) {
                errorMessage.innerHTML = 'ID format B001.';
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
                
             <form action="book_req_pros.php" method="post" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="memberid">Book ID</label>
                        <input type="text" id="book_id" name="book_id" value="<?php echo $book_id; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="book_name">Book Name</label>
                        <input type="text" id="book_name" name="book_name" value="<?php echo $book_name; ?>" class="form-control" required>
                    </div>
                    <<div class="form-group">
         
                    
                    <?php if ($update == true): ?>
                        <button type="submit" name="update" class="btn btn-warning">Update</button>
                    <?php else: ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php endif; ?>
                </form>
            </div>
        </section>
    </div>
    

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
