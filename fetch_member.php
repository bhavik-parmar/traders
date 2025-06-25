<?php
include 'dbconn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    echo json_encode($result);
}
?>
