<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}
include 'dbconn.php'; // Make sure this file contains your DB connection: $conn
?>
<!-- Continue with your admin dashboard HTML here -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Traders</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
  <a class="navbar-brand brand-logo me-5" href="index.html">
    <img src="assets/images/lucklogopng.png" class="me-2" alt="logo" style="height: 55px; width: 200;" />
  </a>
  <a class="navbar-brand brand-logo-mini" href="index.html">
    <img src="assets/images/miniluck.png" alt="logo" style="height: 55px; width: auto;" />
  </a>
</div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="assets/images/faces/face28.jpg" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
         <a class="dropdown-item" href="logout.php">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
     <li class="nav-item">
      <a class="nav-link"  href="member_dashboard.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="othermembers.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Member Directory</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="add_requirement.php" >
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Post Request</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="my_applications.php">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">My Post</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="about_portal.php">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">About Portal</span>
        
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link"  href="profile.php" >
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">My Profile</span>
        
      </a>
    </li>
    
  </ul>
</nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Send Requirement</h4>
        <form class="forms-sample" method="POST" action="add_requirement.php" enctype="multipart/form-data">

  <!-- Hidden User ID -->
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

  <!-- Type Dropdown -->
  <div class="form-group">
    <label for="type">Type</label>
    <select class="form-control" id="type" name="type" required>
      <option value="">Select</option>
      <option value="buyer">Buyer</option>
      <option value="seller">Seller</option>
    </select>
  </div>

  <!-- Product Input -->
  <div class="form-group">
    <label for="product">Product</label>
    <input type="text" class="form-control" id="product" name="product" placeholder="Enter product name" required>
  </div>

  <!-- Units Input -->
  <div class="form-group">
    <label for="units">Units</label>
    <input type="text" class="form-control" id="units" name="units" placeholder="Enter units" required>
  </div>
<!-- Image Upload with Preview Side-by-Side -->
<div class="form-group row align-items-center">
  <div class="col-md-6">
    <label for="image">Upload Image</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
  </div>
  <div class="col-md-6 text-center">
    
    <img id="preview" src="#" alt="Image Preview"
         style="display: none; width: 120px; height: 120px; object-fit: cover; border: 1px solid #ccc; border-radius: 4px;">
  </div>
</div>


  <!-- Message Input -->
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
  </div>

  <!-- Submit Button -->
  <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>
          
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
  </div>
</footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script>
  function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
  }
</script>


    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>
<?php

if (isset($_POST['submit'])) {
  $user_id = $_POST['user_id'];
  $type = $_POST['type'];
  $product = $_POST['product'];
  $units = $_POST['units'];
  $message = $_POST['message'];

  // Handle image upload
  $image = $_FILES['image'];
  $imageName = time() . "_" . basename($image['name']);
  $targetDir = "uploads/requirement_images/";
  $targetPath = $targetDir . $imageName;

  if (!file_exists($targetDir)) {
      mkdir($targetDir, 0777, true); // create folder if it doesn't exist
  }

  if (move_uploaded_file($image['tmp_name'], $targetPath)) {
      // Save record in DB
      $stmt = $conn->prepare("INSERT INTO requirement (user_id, catagory, product, unit, msg, img_path) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssss", $user_id, $type, $product, $units, $message, $targetPath);

      if ($stmt->execute()) {
          echo "<script>alert('Requirement submitted successfully!');</script>";
      } else {
          echo "<script>alert('Error: " . $stmt->error . "');</script>";
      }

      $stmt->close();
  } else {
      echo "<script>alert('Image upload failed.');</script>";
  }

  $conn->close();
}

?>

