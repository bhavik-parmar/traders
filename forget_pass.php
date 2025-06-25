<?php
session_start();
include 'dbconn.php'; // Assumes $conn is defined

// Google reCAPTCHA secret key (replace with your own secret key)
$secretKey = "6LdZvmwrAAAAAGF8NLiCBHwuAY-P1sdetqGwpSJZ";

// Step 1: Validate reCAPTCHA
if (empty($_POST['g-recaptcha-response'])) {
    die("<script>alert('reCAPTCHA verification failed.'); window.history.back();</script>");
}

$recaptchaResponse = $_POST['g-recaptcha-response'];
$verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse;

$responseData = json_decode(file_get_contents($verifyURL));
if (!$responseData->success) {
    die("<script>alert('reCAPTCHA verification failed.'); window.history.back();</script>");
}

// Step 2: Get and sanitize inputs
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Step 3: Validate inputs
if (empty($phone) || empty($password) || empty($confirmPassword)) {
    die("<script>alert('All fields are required.'); window.history.back();</script>");
}

if ($password !== $confirmPassword) {
    die("<script>alert('Passwords do not match.'); window.history.back();</script>");
}

// Step 4: Check if user exists
$query = "SELECT * FROM users WHERE phone = '$phone' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    die("<script>alert('Phone number not found.'); window.history.back();</script>");
}

$user = mysqli_fetch_assoc($result);

// Step 5: Hash and update password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE phone = '$phone'";

if (mysqli_query($conn, $updateQuery)) {
    echo "<script>alert('Password changed successfully. You can now login.'); window.location.href = 'login_form.php';</script>";
} else {
    echo "<script>alert('Something went wrong. Try again later.'); window.history.back();</script>";
}
?>
