<?php
session_start();
include 'dbconn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'sub_admin') {
    header("Location: login_form.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = 'unlocked';

    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $userQuery = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
        $userQuery->bind_param("i", $id);
        $userQuery->execute();
        $userResult = $userQuery->get_result();

        if ($userResult && $userResult->num_rows === 1) {
            $user = $userResult->fetch_assoc();
            $to = $user['email'];
            $subject = "Account Unlocked Notification";

            // HTML message with light styling
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>Account Unlocked</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px; margin: 0;">
              <div style="max-width: 400px; margin: auto; border: 1px solid #eee; padding: 20px; text-align: center;">
                <div style="margin-bottom: 20px;">
                  <img src="https://yourdomain.com/assets/images/lucklogopng.png" alt="Lucky Exports Logo" style="width: 300px;">
                </div>
                <div style="background-color:rgb(149, 255, 113); padding: 20px; border-radius: 12px;">
                  <p style="font-size: 16px; color: #000; margin: 10px 0;"><strong>Dear ' . htmlspecialchars($user['name']) . ',</strong></p>
                  <p style="font-size: 16px; color: #000; margin: 10px 0;">
                    Your account has been unlocked<br>
                    by the administrator. You can<br>
                    now login.
                  </p>
                  <p style="font-size: 16px; color: #000; margin: 10px 0;">
                    Regards,<br>Admin Team
                  </p>
                </div>
              </div>
            </body>
            </html>
            ';

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: no-reply@yourdomain.com\r\n";

            mail($to, $subject, $message, $headers);
        }

        $userQuery->close();
        header("Location: User_status.php");
        exit;
    } else {
        echo "Failed to unlock user.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
