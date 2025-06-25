<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'sub_admin') {
    header("Location: login_form.php");
    exit;
}
include 'dbconn.php';
?>

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
   body {
  background-color: #f9f9f9;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
}

.form-container {
  border: 1px solid #ccc;
  background-color: #fff;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

/* Bordered Sections */
.bordered {
  border: 1px solid #ddd;
  padding: 12px 16px;
  margin-bottom: 8px;
  border-radius: 6px;
  background-color: #fdfdfd;
}

/* Images */
.logo-img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  border: 1px solid #ccc;
}

/* Buttons */
.btn-custom {
  background-color: #343a40;
  color: #fff;
  border: none;
  border-radius: 20px;
  padding: 8px 24px;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.btn-custom:hover {
  background-color: #495057;
}

/* Table Styling */
.fixed-table {
  table-layout: fixed;
  width: 100%;
}

.fixed-table td,
.fixed-table th {
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-word;
  white-space: normal;
  vertical-align: top;
}

/* Read More Toggle */
.read-more-toggle {
  color: #007bff;
  cursor: pointer;
  font-weight: 500;
  margin-top: 5px;
  display: inline-block;
}

.read-more-toggle:hover {
  text-decoration: underline;
}

/* Modal Styling (basic improvement, use Bootstrap overrides if needed) */
.modal-content {
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.modal-header {
  background-color: #f1f1f1;
  border-bottom: 1px solid #ddd;
}

.modal-footer {
  background-color: #f9f9f9;
  border-top: 1px solid #ddd;
}

/* Input Styling */
input.form-control {
  border-radius: 8px;
  border: 1px solid #ccc;
}

/* Footer Customization */
footer.footer {
  background-color: #fff;
  border-top: 1px solid #ddd;
  padding: 15px;
  font-size: 14px;
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
      <a class="nav-link"  href="admin_dashboard.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="membership.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Add New Member</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="members.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Member Directory</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="list_members.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">List of Member</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="login_details.php">
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Login_details</span>
        
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link"  href="requirements_admin.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Approve Buying/selling</span>
        
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link"  href="User_status.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Member Profile Status</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="email.php" >
      <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Email Management</span>
        
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="admin_about_portal.php" >
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">About Portal</span>
        
      </a>
    </li>
    
  </ul>
</nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="container mt-4">
  <?php
    $sql = "SELECT * FROM members WHERE status='Approved'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
  ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-responsive fixed-table">
      <thead class="table-dark">
        <tr>
          <th>Logo</th>
          <th>Name</th>
          <th>Company Name</th>
          <th>Mobile Number</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Message</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
          while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <td>
  <img src="<?php echo $row['company_logo'] ?? 'https://via.placeholder.com/500x100?text=Logo'; ?>" 
       alt="Company Logo" 
       class="logo-img" 
       style="width: 300px; height: 100px; object-fit: contain; border: 1px; border-radius: 8px;">
</td>


          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['cname']); ?></td>
          <td><?php echo htmlspecialchars($row['phone']); ?></td>
          <td><?php echo htmlspecialchars($row['address']); ?></td>
          <td><?php echo htmlspecialchars($row['city']); ?></td>
          <td><?php echo htmlspecialchars($row['state']); ?></td>
          <td>
            <div>
              <span class="short-msg"><?php echo nl2br(htmlspecialchars(substr($row['message'], 0, 50))); ?><?php if(strlen($row['message']) > 50) echo '...'; ?></span>
              <span class="full-msg" style="display:none;"><?php echo nl2br(htmlspecialchars($row['message'])); ?></span>
              <?php if(strlen($row['message']) > 50): ?>
                <a href="javascript:void(0);" class="read-more-toggle text-primary">Read More</a>
              <?php endif; ?>
            </div>
          </td>
         
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php
    } else {
      echo "<p>No member data found.</p>";
    }
    $conn->close();
  ?>
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
  // Read More toggle
  document.querySelectorAll('.read-more-toggle').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const container = this.closest('td');
      const shortMsg = container.querySelector('.short-msg');
      const fullMsg = container.querySelector('.full-msg');

      if (fullMsg.style.display === 'none') {
        shortMsg.style.display = 'none';
        fullMsg.style.display = 'inline';
        this.textContent = 'Read Less';
      } else {
        shortMsg.style.display = 'inline';
        fullMsg.style.display = 'none';
        this.textContent = 'Read More';
      }
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