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
  padding: 5px 10px;
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
      <a class="nav-link"  href="about_portal.php" >
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
    $sql = "SELECT * FROM members WHERE status='Pending'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
  ?>
  <div class="form-container" id="member-<?php echo $row['id']; ?>">
    <div class="row mb-3">
      <div class="col-md-3 bordered d-flex align-items-center justify-content-center">
        <img src="<?php echo $row['company_logo'] ?? 'https://via.placeholder.com/150x100?text=company+logo'; ?>" alt="Company Logo" class="logo-img">
      </div>
      <div class="col-md-9">
        <div class="bordered"><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></div>
        <div class="bordered"><strong>Company Name:</strong> <?php echo htmlspecialchars($row['cname']); ?></div>
        <div class="bordered"><strong>Mobile Number:</strong> <?php echo htmlspecialchars($row['phone']); ?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 bordered"><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></div>
      <div class="col-6 bordered"><strong>City:</strong> <?php echo htmlspecialchars($row['city']); ?></div>
      <div class="col-6 bordered"><strong>State:</strong> <?php echo htmlspecialchars($row['state']); ?></div>
      <div class="col-12 bordered">
        <strong>MSG:</strong>
        <div>
          <span class="short-msg">
            <?php echo nl2br(htmlspecialchars(substr($row['message'], 0, 50))); ?>
            <?php if(strlen($row['message']) > 50) echo '...'; ?>
          </span>
          <span class="full-msg" style="display: none;">
            <?php echo nl2br(htmlspecialchars($row['message'])); ?>
          </span>
          <?php if(strlen($row['message']) > 50): ?>
            <a href="javascript:void(0);" class="read-more-toggle" style="color: blue; display: inline-block; margin-top: 5px;">Read More</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-12 bordered d-flex justify-content-start">
      <button class="btn btn-custom approve-btn" 
  data-id="<?php echo $row['id']; ?>" 
  data-name="<?php echo htmlspecialchars($row['name']); ?>" 
  data-cname="<?php echo htmlspecialchars($row['cname']); ?>" 
  data-catagory="<?php echo htmlspecialchars($row['catagory']); ?>" 
  data-email="<?php echo htmlspecialchars($row['email']); ?>" 
  data-phone="<?php echo htmlspecialchars($row['phone']); ?>">Approve</button>
  <button class="btn btn-custom disapprove-btn" data-id="<?php echo $row['id']; ?>" data-status="Disapprove">Disapprove</button>
</div>
    </div>
  </div>
  <?php
        }
      } else {
        echo "<p>No member data found.</p>";
      }
      $conn->close();
  ?>
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
    <!-- Approve User Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="approveForm" method="POST" action="approve_user.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approveModalLabel">Convert Member to User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="member_id" id="member_id">
          <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" id="form_name" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Company Name</label>
            <input type="text" name="cname" id="form_cname" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" id="form_email" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Phone</label>
            <input type="text" name="phone" id="form_phone" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Catagory</label>
            <input type="text" name="catagory" id="form_catagory" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Password</label>
            <input type="password" name="password" id="form_password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
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
    <!-- End custom js for this page-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
  // Read More toggle
  document.querySelectorAll('.read-more-toggle').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const container = this.closest('.bordered');
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
  
  // Approve User
  document.querySelectorAll('.approve-btn').forEach(function(button) {
    button.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const cname = this.getAttribute('data-cname');
      const email = this.getAttribute('data-email');
      const phone = this.getAttribute('data-phone');
      const catagory = this.getAttribute('data-catagory');
      
      document.getElementById('member_id').value = id;
      document.getElementById('form_name').value = name;
      document.getElementById('form_cname').value = cname;
      document.getElementById('form_email').value = email;
      document.getElementById('form_phone').value = phone;
      document.getElementById('form_catagory').value = catagory;
      document.getElementById('form_password').value = '';
      
      new bootstrap.Modal(document.getElementById('approveModal')).show();
    });
  });

  // Disapprove User
  document.querySelectorAll('.disapprove-btn').forEach(function (button) {
    button.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const status = this.getAttribute('data-status');
      
      if (confirm(`Are you sure you want to disapprove this member?`)) {
        fetch('disapprove.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id=${id}&status=${status}`
        })
        .then(response => response.text())
        .then(data => {
          if (data === 'success') {
            // Remove the member's form from the page
            const memberElement = document.getElementById(`member-${id}`);
            if (memberElement) {
              memberElement.remove();
            }
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'alert alert-success alert-dismissible fade show mt-3';
            successMessage.innerHTML = `
              Member has been disapproved successfully.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.querySelector('.container').appendChild(successMessage);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          // Optionally log the error or handle it silently
        });
      }
    });
  });
  
  // Handle approve form submission
  document.getElementById('approveForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const memberId = formData.get('member_id');
    
    // Show loading state
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'Processing...';
    
    fetch('approve_user.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      // Reset button
      submitButton.disabled = false;
      submitButton.textContent = originalText;
      
      if (data === 'success') {
        // Remove the member's form from the page
        const memberElement = document.getElementById(`member-${memberId}`);
        if (memberElement) {
          memberElement.remove();
        }
        
        // Show success message
        const successMessage = document.createElement('div');
        successMessage.className = 'alert alert-success alert-dismissible fade show mt-3';
        successMessage.innerHTML = `
          Member has been approved and converted to user successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.querySelector('.container').appendChild(successMessage);
        
        // Close the modal
        bootstrap.Modal.getInstance(document.getElementById('approveModal')).hide();
      }
    })
    .catch(error => {
      console.error('Error:', error);
      // Optionally log the error or handle it silently
    });
  });
});

</script>
  </body>
</html>