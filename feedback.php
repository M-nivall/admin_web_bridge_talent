<?php
session_start();
//error_reporting(E_ERROR);
include('include/connections.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bridge Talent</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/coolinglogo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'partials/navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'partials/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Fedback History</h4>
                 
                  <div class="">
                    <table id="zero_config" class="table  table-bordered">
                      <thead>
                                            <tr>
                                               <th>#</th>
                                                    <th>Client</th>
                                                    <th>Phone No</th>
                                                    <th>Comment</th>
                                                    <th>Reply</th>
                                                    <th>Staff Replied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                       <?php
                                               $select="SELECT * FROM applicants a 
                                               INNER JOIN feedback f on a.applicant_id = f.sender_id   
                                               WHERE NOT f.message!=''";
                                               $query=mysqli_query($con,$select);
                                            while($row=mysqli_fetch_array($query)){
                                                ?>
                                                <tr class="odd gradeX">

                                                <td><?php echo $row['fb_id']?> </td>
                <td><?php echo $row['first_name']. ' '. $row['last_name']?> </td>
                <td> <?php echo $row['phone']?></td>
                <td><?php echo $row['message']?> </td>
                <td><?php echo $row['reply']?> </td>
                <td><?php echo $row['receiver_id']?> </td>
                                                    
                                                </tr>
                                                <?php

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
        <!-- partial:../../partials/_footer.html -->
        <?php include 'partials/footer.php' ?>
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
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
   <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
  <!-- End custom js for this page-->
</body>

</html>
