<?php
require_once('dbcon.php');
session_start();

// Initialize variables
$update = false;
$member_id = "";
$first_name = "";
$last_name = "";
$birthday = "";
$email = "";

// Function to check if Member ID or Email already exists
function checkExistence($database, $member_id, $email) {
    $stmt = $database->prepare("SELECT * FROM member WHERE member_id = ? OR email = ?");
    $stmt->bind_param("ss", $member_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}
// Saving new member details
if (isset($_POST['save'])) {
    $member_id = $_POST['member_id'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    if (checkExistence($database, $member_id, $email)) {
        $_SESSION['message'] = "Member ID or Email already exists!";
        $_SESSION['msg_type'] = "danger";
        header("Location: member_req_index.php");
    } else {
        $stmt = $database->prepare("INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $member_id, $first_name, $last_name, $birthday, $email);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("Location: member_req_index.php");
    }
}

// Deleting a member
if (isset($_GET['delete'])) {
    $member_id = $_GET['delete'];

    $stmt = $database->prepare("DELETE FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("Location: member_req_index.php");
}
// Editing a member
if (isset($_GET['edit'])) {
    $member_id = $_GET['edit'];
    $update = true;

    $stmt = $database->prepare("SELECT * FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $member_id = $row['member_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $birthday = $row['birthday'];
        $email = $row['email'];
    }

    $stmt->close();
}

// Updating a member
if (isset($_POST['update'])) {
    $member_id = $_POST['member_id'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    // Check for existence but allow current member_id and email to pass
    $stmt = $database->prepare("SELECT * FROM member WHERE (member_id = ? OR email = ?) AND member_id != ?");
    $stmt->bind_param("sss", $member_id, $email, $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Member ID or Email already exists!";
        $_SESSION['msg_type'] = "danger";
        header("Location: member_req_index.php");
    } else {
        $stmt = $database->prepare("UPDATE member SET first_name = ?, last_name = ?, birthday = ?, email = ? WHERE member_id = ?");
        $stmt->bind_param("sssss", $first_name, $last_name, $birthday, $email, $member_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
        header("Location: member_req_index.php");
    }
    $stmt->close();
}
?>
