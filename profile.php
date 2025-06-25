<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}
include 'dbconn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- Navbar -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo me-5" href="index.html">
            <img src="assets/images/lucklogopng.png" class="me-2" alt="logo" style="height: 55px; width: 200px;" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="assets/images/miniluck.png" alt="logo" style="height: 55px;" />
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="assets/images/faces/face28.jpg" alt="profile" />
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="logout.php">
                  <i class="ti-power-off text-primary"></i> Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>

      <!-- Sidebar -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="member_dashboard.php"><i class="icon-layout menu-icon"></i><span class="menu-title">Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="othermembers.php"><i class="icon-layout menu-icon"></i><span class="menu-title">Member Directory</span></a></li>
            <li class="nav-item"><a class="nav-link" href="add_requirement.php"><i class="icon-grid menu-icon"></i><span class="menu-title">Post Request</span></a></li>
            <li class="nav-item"><a class="nav-link" href="my_applications.php"><i class="icon-columns menu-icon"></i><span class="menu-title">My Post</span></a></li>
            <li class="nav-item"><a class="nav-link" href="about_portal.php"><i class="icon-columns menu-icon"></i><span class="menu-title">About Portal</span></a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php"><i class="icon-head menu-icon"></i><span class="menu-title">My Profile</span></a></li>
          </ul>
        </nav>

        <!-- Main Panel -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">My Profile</h4>
                    <?php if ($user): ?>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <tr><th>Full Name</th><td><?= htmlspecialchars($user['name']) ?></td></tr>
                          <tr><th>Email</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
                          <tr><th>Phone</th><td><?= htmlspecialchars($user['phone']) ?></td></tr>
                         
                          <tr><th>Role</th><td><?= htmlspecialchars($user['role']) ?></td></tr>
                         
                        </table>
                      </div>
                    <?php else: ?>
                      <p>User data not found.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                Copyright © 2023. Premium 
                <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
              </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i>
              </span>
            </div>
          </footer>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
  </body>
</html>
