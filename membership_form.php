<?php
include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Company Info Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-label {
      font-weight: 500;
    }
    .logo-preview {
      max-width: 150px;
      max-height: 150px;
      margin-left: 20px;
      border: 1px solid #ddd;
      padding: 5px;
      border-radius: 5px;
      object-fit: contain;
    }
    .logo-upload-section {
      display: flex;
      align-items: center;
      gap: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Company Information Form</h2>
  <form method="POST"  action="membership_form.php" enctype="multipart/form-data">

    <!-- Personal Name -->
    <div class="mb-3">
      <label for="Name" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="Name" placeholder="Enter your name"  name="name"required>
    </div>

    <!-- Dropdown -->
    <div class="mb-3" >
      <label for="type" class="form-label">Select Type</label>
      <select class="form-select" id="type" name="type" required>
        <option value="">-- Select Buyer or Seller --</option>
        <option value="buyer">Buyer</option>
        <option value="seller">Seller</option>
      </select>
    </div>

    <!-- Company Name -->
    <div class="mb-3">
      <label for="companyName" class="form-label">Company Name</label>
      <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Enter company name" required>
    </div>
    <!-- Company Name -->
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <!-- Phone Number -->
    <div class="mb-3">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
    </div>

    <!-- Address -->
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea class="form-control" id="address" rows="2" placeholder="Enter address" name="address" required></textarea>
    </div>

    <!-- City -->
    <div class="mb-3">
      <label for="city" class="form-label">City</label>
      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" required>
    </div>

    <!-- State -->
    <div class="mb-3">
      <label for="state" class="form-label">State</label>
      <input type="text" class="form-control" id="state" placeholder="Enter state"  name="state"required>
    </div>

    <!-- Message -->
    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control" id="message" rows="3" name="message" placeholder="Your message"></textarea>
    </div>

    <!-- Company Website -->
    <div class="mb-3">
      <label for="website" class="form-label">Company Website</label>
      <input type="url" class="form-control" id="website" name="website" placeholder="https://example.com">
    </div>

    <!-- Company Logo Upload + Preview -->
    <div class="mb-3 logo-upload-section">
      <div style="flex-grow:1;">
        <label for="logo" class="form-label">Upload Company Logo</label>
        <input type="file" class="form-control"  name="logo" id="logo" accept="image/*" onchange="previewLogo(event)">
      </div>
      <img id="logoPreview" class="logo-preview" src="https://via.placeholder.com/150?text=Logo+Preview" alt="Logo Preview">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Logo Preview Script -->
<script>
  function previewLogo(event) {
    const reader = new FileReader();
    reader.onload = function(){
      const output = document.getElementById('logoPreview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = $conn->real_escape_string($_POST['name']);
    $type = $conn->real_escape_string($_POST['type']);
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $message = $conn->real_escape_string($_POST['message']);
    $website = $conn->real_escape_string($_POST['website']);

    // Handle logo upload
    $logo_name = '';
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $logo_name = basename($_FILES['logo']['name']);
        $target_file = $target_dir . time() . "_" . $logo_name;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
            $logo_name = $target_file;
        } else {
            echo "<script>alert('Logo upload failed.');</script>";
        }
    }

    // Insert query
    $sql = "INSERT INTO members 
    (`name`, `cname`, `email`, `phone`, `address`, `city`, `state`, `message`, `company_site`, `company_logo`, `catagory`) 
    VALUES 
    ('$name', '$company_name','$email', '$phone', '$address', '$city', '$state', '$message', '$website', '$logo_name', '$type')";
    

    if ($conn->query($sql) === TRUE) {
      // Email admin
      $adminEmail = "parmar369369@gmail.com"; // Replace with your admin email
      $subject = "New Membership Form Submission";
      $headers = "From: noreply@yourdomain.com\r\n";
      $headers .= "Reply-To: bhavikp12102@gmail.com\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
      $emailBody = '
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="UTF-8">
        <title>New Company Form Submission</title>
      </head>
      <body style="font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px; margin: 0;">
        <div style="max-width: 450px; margin: auto; border: 1px solid #ddd; padding: 20px; text-align: center;">
          
          <!-- Logo -->
          <div style="margin-bottom: 10px;">
            <img src="https://yourdomain.com/assets/images/lucklogopng.png" alt="Lucky Exports Logo" style="width: 200px;">
          </div>
      
          <!-- Card Box -->
          <div style="background-color:rgb(6, 15, 95); padding: 20px; border-radius: 12px;">
            <h3 style="color: #fff; margin-top: 0;">New Company Form Submission</h3>
      
            <table cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse; background-color: #caa2a2; color: #fff;">
              <tr>
                <td style="border: 1px solid #fff;"><strong>Name</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($name) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Type</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($type) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Company Name</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($company_name) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Email</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($email) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Phone</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($phone) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Address</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($address) . ', ' . htmlspecialchars($city) . ', ' . htmlspecialchars($state) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Website</strong></td>
                <td style="border: 1px solid #fff;">' . htmlspecialchars($website) . '</td>
              </tr>
              <tr>
                <td style="border: 1px solid #fff;"><strong>Message</strong></td>
                <td style="border: 1px solid #fff;">' . nl2br(htmlspecialchars($message)) . '</td>
              </tr>';
      
      if (!empty($logo_name)) {
          $fullLogoURL = "https://yourdomain.com/" . $logo_name;
          $emailBody .= '
              <tr>
                <td style="border: 1px solid #fff;"><strong>Logo</strong></td>
                <td style="border: 1px solid #fff;">
                  <img src="' . $fullLogoURL . '" alt="Company Logo" style="width: 100px; height: auto; border: 1px solid #ccc;">
                </td>
              </tr>';
      }
      
      $emailBody .= '
            </table>
          </div>
        </div>
      </body>
      </html>';
        
      mail($adminEmail, $subject, $emailBody, $headers);

      echo "<script>alert('Form submitted successfully.'); window.location.href='index.php';</script>";
  } else {
      echo "<script>alert('Error: " . $conn->error . "');</script>";
  }

  $conn->close();
}
?>
