<?php
session_start();
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $recaptchaSecret = '6LdZvmwrAAAAAGF8NLiCBHwuAY-P1sdetqGwpSJZ';
$recaptchaResponse = $_POST['g-recaptcha-response'];

$verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
$responseData = json_decode($verifyResponse);

if (!$responseData->success) {
    echo "<script>alert('reCAPTCHA verification failed. Please try again.'); window.history.back();</script>";
    exit;
}

    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (empty($phone) || empty($password)) {
        echo "<script>alert('Phone number and password are required.'); window.history.back();</script>";
        exit;
    }

    $query = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if ($user['status'] === 'Unlocked') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            $name = $user['name'];
            $phone = $user['phone'];
            $role = $user['role'];

            // Log the login
            $logQuery = "INSERT INTO log_details (username, phone) VALUES ('$name', '$phone')";
            mysqli_query($conn, $logQuery);

            // Prepare HTML Email with actual message
            $to = "parmar369369@gmail.com";
            $subject = "User Login Alert - Lucky Exports";

            $message = '
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="UTF-8">
              <title>User Login Alert</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px; margin: 0;">
              <div style="max-width: 400px; margin: auto; border: 1px solid #ccc; padding: 20px; text-align: center;">
                <div style="margin-bottom: 20px;">
                  <img src="D:\xampp\htdocs\traders\assets\images\lucklogopng.png" alt="Lucky Exports Logo" style="width: 300px;">
                </div>
                <div style="background-color: #caa2a2; padding: 20px; border-radius: 12px;">
                  <p style="font-size: 16px; color: #000; margin: 10px 0;"><strong>User Login Alert</strong></p>
                  <p style="font-size: 16px; color: #000; margin: 10px 0;">
                    User <strong>' . htmlspecialchars($name) . '</strong> with phone number <strong>' . htmlspecialchars($phone) . '</strong><br>
                    and role <strong>' . htmlspecialchars($role) . '</strong> has just logged in.
                  </p>
                  <p style="font-size: 16px; color: #000; margin: 10px 0;">
                    Regards,<br>Admin Team
                  </p>
                </div>
              </div>
            </body>
            </html>
            ';

            // Email headers for HTML email
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= "From: Lucky Exports <no-reply@yourdomain.com>\r\n";

            // Send email
            mail($to, $subject, $message, $headers);

            // Redirect based on role
            if ($user['role'] === 'sub_admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['role'] === 'member') {
                header("Location: member_dashboard.php");
            } else {
                header("Location: login_form.php");
            }
            exit;
        } else {
            echo "<script>alert('Your account is locked. Please contact admin.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Invalid phone number or password.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
