<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bridge Talent</title>

  <!-- Bootstrap & Vendor CSS -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/coolinglogo.png" />

  <style>
    body {
      background-color: #f8f9fc;
    }

    .card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border-radius: 1rem;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .card-body p {
      letter-spacing: 0.5px;
    }

    footer {
      border-top: 1px solid #e0e0e0;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container-scroller">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/coolinglogo.png" alt="logo" width="45" class="me-2">
          <span class="fw-bold text-primary">Bridge Talent Management</span>
        </a>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              <img src="images/faces/face28.jpg" alt="profile" class="rounded-circle" width="35" height="35">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="index.php?logout='1'">
                  <i class="ti-power-off text-danger me-2"></i> Logout
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid page-body-wrapper mt-5 pt-4">
      <?php include 'partials/sidebar.php' ?>

      <main class="main-panel">
        <div class="content-wrapper container py-5">
          <div class="text-center mb-5">
            <h3 class="fw-bold text-dark">Welcome, Admin</h3>
            <p class="text-muted">Quick access to system modules</p>
          </div>

          <!-- Cards Grid -->
          <div class="row justify-content-center">

            <!-- Customers -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#e3f2fd;">
                <div class="card-body">
                  <p class="fw-bold text-primary text-uppercase mb-2">Applicants</p>
                  <a href="approvedcustomers.php" class="btn btn-outline-primary btn-sm px-4">View</a>
                </div>
              </div>
            </div>

            <!-- Staff -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#e8f5e9;">
                <div class="card-body">
                  <p class="fw-bold text-success text-uppercase mb-2">Staff</p>
                  <a href="allstaff.php" class="btn btn-outline-success btn-sm px-4">View</a>
                </div>
              </div>
            </div>

            <!-- Suppliers -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#fff3e0;">
                <div class="card-body">
                  <p class="fw-bold text-warning text-uppercase mb-2">Active Jobs</p>
                  <a href="activejobs.php" class="btn btn-outline-warning btn-sm px-4">View</a>
                </div>
              </div>
            </div>

            <!-- Orders -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#fce4ec;">
                <div class="card-body">
                  <p class="fw-bold text-danger text-uppercase mb-2">Aproved Employers</p>
                  <a href="approvedemployers.php" class="btn btn-outline-danger btn-sm px-4">View</a>
                </div>
              </div>
            </div>

            <!-- Received Supply -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#ede7f6;">
                <div class="card-body">
                  <p class="fw-bold text-secondary text-uppercase mb-2">Received Payments</p>
                  <a href="approvedpayments.php" class="btn btn-outline-secondary btn-sm px-4">View</a>
                </div>
              </div>
            </div>

            <!-- Service Bookings -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="card text-center h-100 border-0 shadow-sm" style="background-color:#e0f7fa;">
                <div class="card-body">
                  <p class="fw-bold text-info text-uppercase mb-2">Active Applications</p>
                  <a href="activeapplications.php" class="btn btn-outline-info btn-sm px-4">View</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white text-center py-3 mt-4 small text-muted">
          © 2025 Bridge Talent Management. All rights reserved.
        </footer>
      </main>
    </div>
  </div>

  <!-- Vendor JS -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>
