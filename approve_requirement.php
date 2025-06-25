<?php
session_start();
include 'dbconn.php'; // your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requirement_id'])) {
    $requirement_id = $_POST['requirement_id'];

    // Step 1: Update status to 'Approve'
    $stmt = $conn->prepare("UPDATE requirement SET status = 'Approve' WHERE id = ?");
    $stmt->bind_param("i", $requirement_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Step 2: Fetch requirement details
        $req_stmt = $conn->prepare("SELECT product, unit , msg FROM requirement WHERE id = ?");
        $req_stmt->bind_param("i", $requirement_id);
        $req_stmt->execute();
        $result = $req_stmt->get_result();
        $requirement = $result->fetch_assoc();

        // Step 3: Fetch all users' emails
        $email_result = $conn->query("SELECT email FROM users");
        $emails = [];
        while ($row = $email_result->fetch_assoc()) {
            $emails[] = $row['email'];
        }

        // Step 4: Send email to each user
        $subject = "New Requirement Added: " . $requirement['product'];
        $message = "A new requirement has been added:\n\n";
        $message .= "Product: " . $requirement['product'] . "\n";
        $message .= "unit: " . $requirement['unit'] . "\n";
        $message .= "Message: " . $requirement['msg'] . "\n";
        $message .= "Check it out on the portal.";

        $headers = "From: no-reply@yourdomain.com";

        foreach ($emails as $email) {
            mail($email, $subject, $message, $headers);
        }

        // Redirect back with success message
        header("Location: requirements_admin.php");
        exit;
    } else {
        echo "Failed to approve requirement.";
    }
} else {
    echo "Invalid request.";
}
?>
