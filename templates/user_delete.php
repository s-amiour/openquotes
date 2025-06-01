<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('../includes/db.php');

$user_id = $_SESSION['user_id'];

// Delete user's registered quotes
$sql_1 = "DELETE FROM quotes WHERE user_id = '$user_id'";
$prepared_1 = $conn->prepare($sql_1);
$quotes_delete = $prepared_1->execute();

// Delete user account
$sql_2 = "DELETE FROM users WHERE id = '$user_id'";
$prepared_2= $conn->prepare($sql_2);
$user_delete = $prepared_2->execute();

// Verification
if ($user_delete && $quotes_delete){
    $_SESSION['message'] = "Account deleted successfuly.";
    $_SESSION['msg_type'] = "success";
    header("Location: logout.php");
}
else {
    echo "<p class='alert alert-danger'>Failed account deletion.</p>";
}

