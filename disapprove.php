<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($status == 'Disapprove') {
        $update = "UPDATE members SET status='Disapproved' WHERE id=$id";

        if ($conn->query($update) === TRUE) {
            // Get email
            $result = $conn->query("SELECT email, name FROM members WHERE id=$id");
            $row = $result->fetch_assoc();

            $email = $row['email'];
            $name = $row['name'];

            $subject = "Membership Disapproval Notice";

            // HTML message with sad emoji and light style
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>Disapproval</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px; margin: 0;">
              <div style="max-width: 400px; margin: auto; border: 1px solid #eee; padding: 20px; text-align: center;">
                <div style="font-size: 60px; margin-bottom: 10px;">😢</div>
                <div style="background-color:rgb(225, 134, 134); padding: 20px; border-radius: 12px;">
                  <p style="font-size: 16px; color: #000;"><strong>Hi ' . htmlspecialchars($name) . ',</strong></p>
                  <p style="font-size: 16px; color: #000;">
                    We regret to inform you that your membership has been disapproved.
                  </p>
                  <p style="font-size: 16px; color: #000;">Regards,<br>Admin</p>
                </div>
              </div>
            </body>
            </html>
            ';

            // Email headers for HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: no-reply@yourdomain.com\r\n";

            mail($email, $subject, $message, $headers);

            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'invalid request';
    }
}
?>
