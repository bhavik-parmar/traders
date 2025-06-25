<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 450px;
      margin: 80px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }
    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo {
      width: 120px;
      height: 120px;
      background-color: #6c63ff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      color: white;
      font-size: 48px;
    }
    .form-title {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }
    .btn-primary {
      background-color: #6c63ff;
      border-color: #6c63ff;
      padding: 12px 20px;
      font-weight: 500;
    }
    .btn-primary:hover {
      background-color: #5a52d5;
    }
    .progress {
      height: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-container">
      <div class="logo-container">
        <div class="logo">
          <i class="bi bi-shield-lock"></i>
        </div>
      </div>

      <h2 class="form-title">Forgot Password</h2>

      <form id="resetForm" action="forget_pass.php" method="post" onsubmit="return validatePasswords();">
        <!-- Phone Number -->
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
        </div>

        <!-- New Password -->
        <div class="mb-3">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" name="password" id="new_password" placeholder="Enter new password" onkeyup="checkStrength()" required>
          <small id="strengthText" class="form-text text-muted"></small>
          <div class="progress mt-1">
            <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
        </div>

        <!-- reCAPTCHA -->
        <div class="mb-3 text-center">
          <div class="g-recaptcha" data-sitekey="6LdZvmwrAAAAABvyqbAfaE6OYwfx7ZaqrjVRPerk"></div>
        </div>

        <!-- Submit -->
        <div class="d-grid gap-2 mb-4">
          <button class="btn btn-primary" type="submit">Change Password</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <!-- JS Password Validation -->
  <script>
    function validatePasswords() {
      const newPassword = document.getElementById("new_password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      if (newPassword !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }

      if (getPasswordStrength(newPassword) < 3) {
        alert("Password is too weak. Please choose a stronger password.");
        return false;
      }

      return true;
    }

    function getPasswordStrength(password) {
      let strength = 0;
      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[0-9]/.test(password)) strength++;
      if (/[^A-Za-z0-9]/.test(password)) strength++;
      return strength;
    }

    function checkStrength() {
      const password = document.getElementById("new_password").value;
      const strengthBar = document.getElementById("strengthBar");
      const strengthText = document.getElementById("strengthText");
      const strength = getPasswordStrength(password);

      const levels = [
        { text: "Weak", color: "bg-danger", width: "25%" },
        { text: "Fair", color: "bg-warning", width: "50%" },
        { text: "Good", color: "bg-info", width: "75%" },
        { text: "Strong", color: "bg-success", width: "100%" },
      ];

      const level = levels[strength - 1] || levels[0];
      strengthBar.style.width = level.width;
      strengthBar.className = "progress-bar " + level.color;
      strengthText.textContent = `Strength: ${level.text}`;
    }
  </script>
</body>
</html>
