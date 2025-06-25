
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
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
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
        }
        .btn-primary {
            background-color: #6c63ff;
            border-color: #6c63ff;
            padding: 12px 20px;
            font-weight: 500;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #5a52d5;
            border-color: #5a52d5;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            color: #6c757d;
        }
        .input-group .form-control {
            border-right: none;
        }
        .input-group-text {
            background-color: transparent;
            border-left: none;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider span {
            padding: 0 10px;
            color: #6c757d;
        }
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            text-decoration: none;
        }
        .social-btn.google {
            background-color: #DB4437;
        }
        .social-btn.facebook {
            background-color: #4267B2;
        }
        .social-btn.apple {
            background-color: #000000;
        }
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            
            <!-- Form Title -->
            <h2 class="form-title">Login</h2>
            
            <!-- Login Form -->
            <form id="loginForm" action="login.php" method="post" >
                <!-- Phone Number Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
                    <div class="invalid-feedback">
                        Please enter your phone number.
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        
                    </div>

                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                </div>

                <!-- Google reCAPTCHA -->
                <div class="mb-3 text-center">
                    <div class="g-recaptcha" data-sitekey="6LdZvmwrAAAAABvyqbAfaE6OYwfx7ZaqrjVRPerk"></div>
                </div>

                
                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                   
                    <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-4">
                    <button class="btn btn-primary" type="submit">Log In</button>
                </div>
                
                <!-- Sign Up Link -->
                <div class="text-center">
                    <span>Your Are Not Our Member ?</span>
                    <a href="membership.php" class="text-decoration-none">Get Membership</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>

