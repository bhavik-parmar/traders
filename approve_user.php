<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['member_id'];
    $name = $_POST['name'];
    $cname = $_POST['cname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $catagory = $_POST['catagory'];
    $password = $_POST['password'];

    $insert = "INSERT INTO users (name, cname, email, phone,catagory, password) 
               VALUES ('$name', '$cname', '$email', '$phone','$catagory', '$password')";
    $update = "UPDATE members SET status='Approved' WHERE id=$id";    

    if ($conn->query($insert) === TRUE && $conn->query($update) === TRUE) {
        // Send Email to Approved Member
        $subject = "Your membership has been approved";
        $message = "Hi $name,\n\nYour membership has been approved.\n\nLogin Details:\nPhone: $phone\nPassword: $password\n\nRegards,\nAdmin";
        $headers = "From: bhavikp12102@gmail.com";

        mail($email, $subject, $message, $headers);

        echo "<script>alert('User approved and email sent.');window.location.href='membership.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
