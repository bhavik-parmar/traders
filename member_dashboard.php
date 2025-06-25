<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login_form.php");
    exit;
}
include 'dbconn.php';
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
    <style>
      .card-light-yellow {
  background-color: #fff9c4; /* light yellow */
  color: #000;
}

.card-light-orange {
  background-color: #ffe0b2; /* light orange */
  color: #000;
}
      </style>
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
            
          <?php


// Fetch requirement data
$sql = "SELECT r.*, 
               u.name AS user_name, 
               u.email AS user_email,
               u.phone AS user_phone
        FROM requirement r
        JOIN users u ON r.user_id = u.id
        WHERE r.status = 'Approve'
        ORDER BY r.id DESC";




$result = $conn->query($sql);
?>
<?php
$cardClasses = ['card-tale','card-light-danger','card-light-yellow','card-light-blue','card-light-orange'];
$index = 0;
?>

<div class="row">
  <h4 class="mb-4">Latest Requirements</h4>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <?php
        $cardClass = $cardClasses[$index % count($cardClasses)];
        $index++;
      ?>
    <div class="col-md-6 mb-4" style="padding-bottom: 2px;">

      <div class="card <?= $cardClass ?> shadow-sm">
  <div class="card-body">
    <div class="row align-items-center">
      
      <!-- Left: Fixed-size Image -->
      <div class="col-4 text-center">
        <div style="width: 150px; height: 150px; border-radius: 6px; overflow: hidden; border: 1px solid #ccc; margin: auto;">
          <img src="<?= htmlspecialchars($row['img_path'] ?? 'uploads/requirement_images/default.jpg') ?>"
               alt="Requirement Image"
               style="width: 100%; height: 100%; object-fit: cover;">
        </div>
      </div>

      <!-- Right: Content -->
      <div class="col-8">
        <h5 class="card-title"><?= htmlspecialchars($row['product']) ?> (<?= htmlspecialchars($row['catagory']) ?>)</h5>
        <p class="card-text"><strong>By:</strong> <?= htmlspecialchars($row['user_name']) ?></p>
        <p class="card-text"><strong>Units:</strong> <?= htmlspecialchars($row['unit']) ?></p>
        <p class="card-text"><strong>Contact:</strong> <?= htmlspecialchars($row['user_phone']) ?></p>
        <?php
          $fullMsg = nl2br(htmlspecialchars($row['msg']));
          $shortMsg = htmlspecialchars(substr($row['msg'], 0, 30)) . '...';
          $isLong = strlen($row['msg']) > 30;
        ?>
        <p class="card-text text-muted" style="font-size: 14px;">
          <?php if ($isLong): ?>
            <span class="short-message"><?= $shortMsg ?></span><span class="d-none full-message"><?= $fullMsg ?></span>
            <a href="javascript:void(0);" class="read-more-toggle text-primary" style="font-size:13px; margin-left: 5px;">Read More</a>
          <?php else: ?>
            <?= $fullMsg ?>
          <?php endif; ?>
        </p>
      </div>

    </div>
  </div>
</div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="requestModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="requestModalLabel<?= $row['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
          <form method="POST" action="send_request.php">
            <input type="hidden" name="requirement_id" value="<?= $row['id'] ?>">
            <input type="hidden" name="to_email" value="<?= $row['user_email'] ?>">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel<?= $row['id'] ?>">Send Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="message<?= $row['id'] ?>" class="form-label">Your Message</label>
                  <textarea class="form-control" name="message" id="message<?= $row['id'] ?>" rows="4" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Send</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="col-12"><p>No requirements available.</p></div>
  <?php endif; ?>
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
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.read-more-toggle').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const shortMsg = this.parentElement.querySelector('.short-message');
        const fullMsg = this.parentElement.querySelector('.full-message');

        shortMsg.classList.toggle('d-none');
        fullMsg.classList.toggle('d-none');

        this.textContent = shortMsg.classList.contains('d-none') ? 'Show Less' : 'Read More';
      });
    });
  });
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