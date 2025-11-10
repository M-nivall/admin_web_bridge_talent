<?php

include('dbconnect.php')

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
                  <h4 class="card-title">Rejected Employers</h4>
                 
                  <div class="table-responsive">
                    <table id="zero_config" class="table">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Company Name </th>
                          <th> Contacts </th>
                          <th> Email </th>
                          <th> industry </th>
                          <th> Location </th>
                          <th> Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql="select * from `employers` where status = 'Rejected'";
                        $result = mysqli_query($db,$sql);
                        if($result){
                            while($row=mysqli_fetch_assoc($result)){
                                $id=$row['employer_id'];
                                $name=$row['company_name'];
                                $contacts=$row['contacts'];
                                $email=$row['email_address'];
                                $industry=$row['industry'];
                                $location=$row['location'];
                                $Approval=$row['status'];
                                echo '<tr>
                            <td>'.$id.'</td>
                            <td>'.$name.'</td>
                            <td>'.$contacts.'</td>
                            <td>'.$email.'</td>
                            <td>'.$industry.'</td>
                            <td>'.$location.'</td>
                            <td><label class="badge badge-warning">'.$Approval.'</label></td>
                        </tr>';
                            }

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
