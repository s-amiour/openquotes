<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

// Check quote ID
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

// Get quote ID from the URL
$quote_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete quote from the database
$sql = "DELETE FROM quotes WHERE id = '$quote_id'";
$prepared = $conn->prepare($sql);
if($prepared->execute()) {
    $_SESSION['message'] = "Quote deleted successfully!";
    $_SESSION['msg_type'] = "success";
} else {
    $_SESSION['message'] = "Error deleting quote. Please try again.";
    $_SESSION['msg_type'] = "error";
}

header("Location: deck.php");
?>