<?php
session_start();
include('include/connections.php');

// Check if job ID is provided
if (!isset($_GET['get']) || empty($_GET['get'])) {
    die("Invalid Job ID");
}

$job_id = intval($_GET['get']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bridge Talent | Applicants</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/extra-libs/DataTables/datatables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/citizenlogo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <?php include 'partials/sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Job Applicants</h4>
                  <p class="card-description text-muted">
                    Showing all applicants for Job ID: <strong><?php echo $job_id; ?></strong>
                  </p>

                  <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Applicant Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Job Title</th>
                          <th>Date Applied</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $select = "
                          SELECT a.*, p.first_name, p.last_name, p.email, p.phone, j.title 
                          FROM applications a
                          INNER JOIN applicants p ON p.applicant_id = a.applicant_id
                          INNER JOIN jobs j ON j.job_id = a.job_id
                          WHERE a.job_id = $job_id
                        ";
                        $query = mysqli_query($con, $select);
                        $count = 1;

                        if (mysqli_num_rows($query) > 0) {
                          while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                              <td><?php echo $count++; ?></td>
                              <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['date_applied']; ?></td>
                              <td>
                                <a href="view_applicant_profile.php?id=<?php echo $row['applicant_id']; ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                  View Profile
                                </a>
                              </td>
                            </tr>
                            <?php
                          }
                        } else {
                          echo "<tr><td colspan='7' class='text-center text-muted'>No applicants found for this job.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->

        <!-- Footer -->
        <?php include 'partials/footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
  <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
  <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    /****************************************
     *       Basic Table (same as Active Jobs)
     ****************************************/
    $('#zero_config').DataTable();
  </script>
  <!-- End custom js for this page-->
</body>

</html>
