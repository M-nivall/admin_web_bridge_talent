<?php
session_start();
include('include/connections.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Woodways</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/coolinglogo.png" />
</head>

<body>
  <div class="container-scroller">
    <?php include 'partials/navbar.php' ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'partials/sidebar.php' ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Approved payments</h4>
                  <div class="">
                    <button class="btn btn-primary mb-3" onclick="printTable()">Print</button>
                    <div class="table-responsive">
                      <table id="zero_config" class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Action</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Amount KES</th>
                            <th>Mpesa code</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $select = "SELECT * FROM clients c 
                            INNER JOIN bookings o ON c.client_id = o.client_id
                            INNER JOIN order_items oi ON oi.order_id = o.order_id
                            INNER JOIN services s ON oi.stock_id = s.stock_id
                            RIGHT JOIN service_payment p ON o.order_id = p.order_id 
                            WHERE p.status = '1' AND oi.type = 'service'";
                          $query = mysqli_query($con, $select);
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                            <tr class="odd gradeX">
                              <td><a href="service_details.php?get=<?php echo $row['order_id'] ?>">View</a></td>
                              <td><?php echo $row['order_id'] ?></td>
                              <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                              <td><?php echo $row['product_name'] ?></td>
                              <td><?php echo $row['total_cost'] ?></td>
                              <td><?php echo $row['mpesa_code'] ?></td>
                              <td><?php echo $row['order_date'] ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div> <!-- table-responsive -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include 'partials/footer.php' ?>
      </div>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
  <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
  <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
  <script>
    $('#zero_config').DataTable();
  </script>
  <script>
    function printTable() {
      var printContents = document.querySelector(".table").outerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContents + "</body></html>";
      window.print();
      document.body.innerHTML = originalContents;
      location.reload(); // Reload to restore original page
    }
  </script>
</body>

</html>
