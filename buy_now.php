<?php
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requirement_id'])) {
    $requirement_id = $_POST['requirement_id'];
    $buyer_id = $_SESSION['user_id'];

    // Example insert to a `purchases` table
    $stmt = $conn->prepare("INSERT INTO purchases (buyer_id, requirement_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $buyer_id, $requirement_id);

    if ($stmt->execute()) {
        echo "<script>alert('Buy request sent successfully.'); window.location.href='requirement.php';</script>";
    } else {
        echo "<script>alert('Error processing request.'); window.history.back();</script>";
    }
}
?>
