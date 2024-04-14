<?php
session_start();
include("../api/connect.php");

// Get user's role
$role = $_SESSION['userdata']['role'];
$userId = $_SESSION['userdata']['id'];

// Define table based on role
if ($role == 1) {
    $table = 'voters';
} elseif ($role == 2) {
    $table = 'groups';
}

// Delete user from appropriate table
$deleteQuery = "DELETE FROM $table WHERE id = $userId";

if(mysqli_query($connect, $deleteQuery)) {
    // After successful deletion, unset the session and redirect
    unset($_SESSION['userdata']);
    header("location: ../");
} else {
    echo "Error deleting Account: " . mysqli_error($connect);
}
?>
