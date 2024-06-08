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
?>