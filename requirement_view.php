<?php
include 'dbconn.php';
$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT r.*, u.name AS user_name FROM requirement r JOIN users u ON r.user_id = u.id WHERE r.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Requirement Details</title></head>
<body>
<h2>Requirement Details</h2>
<?php if ($data): ?>
  <p><strong>Product:</strong> <?= htmlspecialchars($data['product']) ?></p>
  <p><strong>Type:</strong> <?= htmlspecialchars($data['catagory']) ?></p>
  <p><strong>Units:</strong> <?= htmlspecialchars($data['unit']) ?></p>
  <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($data['msg'])) ?></p>
  <p><strong>Posted by:</strong> <?= htmlspecialchars($data['user_name']) ?></p>
<?php else: ?>
  <p>Requirement not found.</p>
<?php endif; ?>
<a href="requirement.php">Back</a>
</body>
</html>
