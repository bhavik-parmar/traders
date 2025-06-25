<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Process multiple email addresses
    $emails = array_map('trim', explode(',', $to));

    $from_email = "your-email@example.com"; // Replace with your email
    $boundary = md5(time());
    $headers = "From: $from_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // Check if a file is uploaded
    if (!empty($_FILES['attachment']['tmp_name'][0])) {
        foreach ($_FILES['attachment']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['attachment']['name'][$key];
            $file_type = $_FILES['attachment']['type'][$key];
            $file_size = $_FILES['attachment']['size'][$key];
            $file_data = file_get_contents($tmp_name);
            $file_data_base64 = chunk_split(base64_encode($file_data));

            $body .= "--{$boundary}\r\n";
            $body .= "Content-Type: {$file_type}; name=\"{$file_name}\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"{$file_name}\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= $file_data_base64 . "\r\n";
        }
    }

    $body .= "--{$boundary}--";

    $successCount = 0;
    foreach ($emails as $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (mail($email, $subject, $body, $headers)) {
                $successCount++;
            }
        }
    }

    echo "<script>alert('Email sent to {$successCount} recipient(s).');</script>";
}
?>
