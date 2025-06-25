<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}
include 'dbconn.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = intval($_GET['id']);

// Fetch existing application data
$query = "SELECT * FROM requirement WHERE id = '$id' AND user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Application not found or access denied.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $imagePath = $row['img_path']; // keep existing if not changed

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
    $uploadPath = 'uploads/requirement_images/' . $imageName;

    if (move_uploaded_file($imageTmp, $uploadPath)) {
        $imagePath = $uploadPath;
    }
}

    $date = $_POST['date'];
    $product = $_POST['product'];
    $units = $_POST['units'];
    $msg = $_POST['msg'];

    $update_query = "UPDATE requirement SET date = ?, product = ?, unit = ?, msg = ?, img_path = ? WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($update_query);
$stmt->bind_param("ssssssi", $date, $product, $units, $msg, $imagePath, $id, $user_id);


    if ($stmt->execute()) {
        header("Location: my_applications.php?updated=1");
        exit;
    } else {
        $error = "Failed to update application.";
    }
}
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
      <a class="nav-link"  href="admin_dashboard.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="membership.php" >
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Memberships</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="members.php" >
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Members</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="login_details.php">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Login_details</span>
        
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link"  href="requirements_admin.php" >
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Requirements</span>
        
      </a>
    </li>
    
  </ul>
</nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="container mt-5">
        <h2>Edit Application</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($row['date']) ?>" required>
            </div>
            <div class="form-group">
                <label>Product</label>
                <input type="text" name="product" class="form-control" value="<?= htmlspecialchars($row['product']) ?>" required>
            </div>
            <div class="form-group">
                <label>Units</label>
                <input type="text" name="units" class="form-control" value="<?= htmlspecialchars($row['unit']) ?>" required>
            </div>
            <div class="form-group row align-items-center">
  <div class="col-md-6">
    <label for="image">Upload Image</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
  </div>
  <div class="col-md-6 text-center">
    <label>Preview</label><br>
    <img id="preview" src="<?= !empty($row['img_path']) ? htmlspecialchars($row['img_path']) : 'assets/images/placeholder.png' ?>" style="max-width: 120px; max-height: 120px; border-radius: 6px; border: 1px solid #ccc;">
  </div>
</div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="msg" class="form-control" rows="4"><?= htmlspecialchars($row['msg']) ?></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="my_applications.php" class="btn btn-secondary">Cancel</a>
        </form>
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
  const reader = new FileReader();
  reader.onload = function () {
    document.getElementById('preview').src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
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
