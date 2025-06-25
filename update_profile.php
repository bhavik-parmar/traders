<?php
session_start();
include 'dbconn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profile updated successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Failed to update profile.'); window.location.href='profile.php';</script>";
    }
}
?>
