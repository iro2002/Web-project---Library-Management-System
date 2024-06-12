<?php
require_once('dbcon.php');
session_start();

// Set the default timezone to Sri Lanka
date_default_timezone_set('Asia/Colombo');

// Initialize variables
$update = false;
$category_id = "";
$category_Name = "";
$date_modified = "";

// Function to check if Category ID or Name already exists
function checkExistence($database, $category_id, $category_Name) {
    $stmt = $database->prepare("SELECT * FROM bookcategory WHERE category_id = ? OR category_Name = ?");
    $stmt->bind_param("ss", $category_id, $category_Name);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Saving new category details
if (isset($_POST['save'])) {
    $category_id = $_POST['category_id'];
    $category_Name = $_POST['category_Name'];
    $date_modified = date("Y-m-d h:i:s a"); // Current timestamp with AM/PM

    if (checkExistence($database, $category_id, $category_Name)) {
        $_SESSION['message'] = "Category ID or Name already exists!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $database->prepare("INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $category_id, $category_Name, $date_modified);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
    }
    header("Location: book_cateogary_index.php");
    exit();
}

// Deleting a category
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];

    if ($category_id == 'C001') {
        $_SESSION['message'] = "The category with ID 'C001' cannot be deleted!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $database->prepare("DELETE FROM bookcategory WHERE category_id = ?");
        $stmt->bind_param("s", $category_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
    }
    header("Location: book_cateogary_index.php");
    exit();
}

// Editing a category
if (isset($_GET['edit'])) {
    $category_id = $_GET['edit'];
    $update = true;

    $stmt = $database->prepare("SELECT * FROM bookcategory WHERE category_id = ?");
    $stmt->bind_param("s", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $category_id = $row['category_id'];
        $category_Name = $row['category_Name'];
        $date_modified = $row['date_modified'];
    }

    $stmt->close();
}

// Updating a category
if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $category_Name = $_POST['category_Name'];
    $date_modified = date("Y-m-d h:i:s a"); // Current timestamp with AM/PM

    // Check for existence but allow current category_id and category_Name to pass
    $stmt = $database->prepare("SELECT * FROM bookcategory WHERE (category_id = ? OR category_Name = ?) AND category_id != ?");
    $stmt->bind_param("sss", $category_id, $category_Name, $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Category ID or Name already exists!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $database->prepare("UPDATE bookcategory SET category_Name = ?, date_modified = ? WHERE category_id = ?");
        $stmt->bind_param("sss", $category_Name, $date_modified, $category_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "success";
    }
    header("Location: book_cateogary_index.php");
    exit();
}
?>
