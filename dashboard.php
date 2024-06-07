<?php

require 'dbcon.php';
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
        .time-display {
            font-size: 2em;
            font-family: Arial, sans-serif;
            margin: 20px;
            color: red;
            padding: 10px 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            border-color: green;
            background-color: #f9f9f9;
            display: inline-block;
            cursor: pointer;
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-top:0px;
            align-items: center;
            padding: 36px 20px;
            font-weight: bold;
            margin-bottom: 20px; 
            background-color:#495057;
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

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(25% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #343a40;
        }

        .card p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
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
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button type="button">Search</button>
                </div>
                <button class="dark-mode-toggle" onclick="toggleDarkMode()">Dark Mode</button>
            </header>
            <time>Time-:<time>
               
            <div class="time-display" id="timeDisplay"></div>
    <script>
        
        function updateTime() {
            const timeDisplay = document.getElementById('timeDisplay');
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            timeDisplay.textContent = currentTime;
        }

        // Update time every second
        setInterval(updateTime, 1000);

        // Initial call to display time immediately
        updateTime();
    </script>
            <section class="content">
                <div class="card">
                    <h3>Total Books</h3>
                         <h1><?php
                            $query = "SELECT * FROM book"; // Add a semicolon at the end of the statement
                            $result_set = mysqli_query($database, $query);
                            if ($result_set) {
                                echo mysqli_num_rows($result_set); // Change $result to $result_set
                            }
                         ?>
                </div>
                <div class="card">
                    <h3>Total Users</h3>
                    <h1>
                   <?php
                    $query = "SELECT * FROM user"; // Add a semicolon at the end of the statement
                    $result_set = mysqli_query($database, $query);
                    if ($result_set) {
                        echo mysqli_num_rows($result_set); // Change $result to $result_set
                    }
                    ?>
                    </h1>
                </div>
                <div class="card">
                    <h3>Total Users</h3>
                    <h1>
                   <?php
                    $query = "SELECT * FROM user"; // Add a semicolon at the end of the statement
                    $result_set = mysqli_query($database, $query);
                    if ($result_set) {
                        echo mysqli_num_rows($result_set); // Change $result to $result_set
                    }
                    ?>
                    </h1>
                </div>
                <div class="card">
                    <h3>Total Book Category</h3>
                    <h1>
                   <?php
                    $query = "SELECT * FROM bookcategory "; // Add a semicolon at the end of the statement
                    $result_set = mysqli_query($database, $query);
                    if ($result_set) {
                        echo mysqli_num_rows($result_set); // Change $result to $result_set
                    }
                    ?>
                    </h1>
                </div>
               
                
                </div>
            </section>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
