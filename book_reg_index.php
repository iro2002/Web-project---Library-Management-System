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
            height: 130vh;
        
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
        .custom-alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .custom-alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .custom-alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
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
            padding: 20px 30px;
            font-weight: bold;
            margin-bottom: 20px;
            background-color: #343a40;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            font-size: 12px;
            border: none;
            border-radius:6px;
            }

            .dropdown {
            position: relative;
            display: inline-block;
            }

            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .dropdown-content a {
            color: black;
            padding: 5px 16px;
            text-decoration: none;
            display: block;
            }

            .dropdown-content a:hover {background-color: #ddd;}

            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropbtn {background-color: #3e8e41;}

            .form-dropdown {
                margin-bottom: 1em;
                display: flex;
                flex-direction: column;
            }

            .form-dropdown label {
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .form-dropdown select {
                padding: 0.5em;
                font-size: 1em;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #fff;
                transition: border-color 0.3s;
            }

            .form-dropdown select:focus {
                border-color: #007bff;
                outline: none;
            }

            .form-dropdown select option {
                padding: 0.5em;
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
                
                
            </header>
           
            <div class="errormassage">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="
            custom-alert 
            <?php 
                echo ($_SESSION['msg_type'] == 'success') ? 'custom-alert-success' : 'custom-alert-danger'; 
            ?> 
            alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
</div>
            <br>
            <section class="content">
                
                <div class="card1">
                <h1>Book Details</h1>
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
                                <h3 style="color:; background-color:#257FBE;">Edit Book</h3>
                            <?php else: ?>
                                <h3 style="color:; background-color:#257FBE;">Add Book</h3>
                            <?php endif; ?>
                        </div>
                        

    <div class="container">
        <section>
            <div class="form-container">
                <div id="error-message" class="error-message" style="color: red;"></div>
                <div id="success-message" class="success-message" style="color: green;"></div>
                
                <form action="book_req_pros.php" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label>Book ID</label>
                        <input type="text" id="book_id" name="book_id" value="<?php echo $book_id; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Book Name</label>
                        <input type="text" name="book_name" value="<?php echo $book_name; ?>" required>
                    </div>
                    <div class="form-dropdown">
                        <label>Category</label>
                        <select name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>" <?php if ($category_id == $category['category_id']) echo 'selected'; ?>>
                                    <?php echo $category['category_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <?php if ($update == true): ?>
                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                        <?php else: ?>
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                        <?php endif; ?>
                    </div>
                </form

            </div>
            <script>
                function validateForm() {
                const bookID = document.getElementById('book_id').value;
                const errorMessage = document.getElementById('error-message');
                const successMessage = document.getElementById('success-message');

                const bookIDPattern = /^B\d{3}$/;

                errorMessage.innerHTML = '';
                successMessage.innerHTML = '';

                if (!bookIDPattern.test(bookID)) {
                    errorMessage.innerHTML = 'Book ID B001';
                    return false;
                }

              return true;
            }
                </script>

        </section>
    </div>
    

  
</body>
</html>
