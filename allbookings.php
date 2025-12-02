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
  <title>Citizencooling</title>
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
  <link rel="shortcut icon" href="images/citizenlogo.png" />
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
                  <h4 class="card-title">All Service  Bookings</h4>


                 
                  <div class="">
                    <table id="zero_config" class="table  table-bordered">


                      <thead>
                         <input value='Print' type='button' onclick='handlePrint()' />
      <script type="text/javascript">
         const handlePrint = () => {
            var actContents = document.body.innerHTML;
            document.body.innerHTML = actContents;
            window.print();
         }
      </script>
                                            <tr>
                                               <th>Action</th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Amount KES</th>
                                                    <th>Mpesa code</th>
                                                    <th>Date</th>
                                                   
                                             </tr>
                                        </thead>
                                        <tbody>
                                           
                                            
                                            <?php
                                            $select="SELECT * FROM clients c INNER JOIN orders o on c.client_id = o.client_id
                                       RIGHT JOIN payment p on o.order_id = p.order_id WHERE  o.order_status='2' ||  o.order_status='3'||  o.order_status='4'||  o.order_status='5' AND p.total_cost !=0";
                                            $query=mysqli_query($con,$select);
                                            while($row=mysqli_fetch_array($query)){
                                                ?>
                                                <tr class="odd gradeX">

                                                    <td><a href="payment_details.php?get=<?php echo $row['order_id']?>">View Details</a> </td>
                                                    <td><?php echo $row['order_id']?> </td>
                                                    <td><?php echo $row['first_name']. ' '. $row['last_name']?> </td>
                                                    <td><?php echo $row['total_cost']?> </td>
                                                    <td> <?php echo $row['mpesa_code']?></td>
                                                    <td><?php echo $row['order_date']?> </td>
                                                   
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
