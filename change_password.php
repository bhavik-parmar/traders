<?php
session_start();
include 'dbconn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $query = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<script>alert('User not found.'); window.location.href='profile.php';</script>";
        exit;
    }

    // Match plain text password (you should hash passwords in real apps!)
    if ($user['password'] !== $current_password) {
        echo "<script>alert('Current password is incorrect.'); window.location.href='profile.php';</script>";
        exit;
    }

    // Update to new password
    $update_query = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Password changed successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Failed to change password.'); window.location.href='profile.php';</script>";
    }
}
?>
