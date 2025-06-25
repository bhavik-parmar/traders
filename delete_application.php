<?php
session_start();
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM requirement WHERE id = '$id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: my_applications.php"); // or your main page
        exit;
    } else {
        echo "Error deleting record.";
    }
}
?>
