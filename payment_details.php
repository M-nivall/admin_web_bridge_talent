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
  <title>Woodways</title>
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
                  <h4 class="card-title">Payment Details </h4>
                 
                 
                 
                                            
                                            <?php
                    $select="SELECT * FROM clients c INNER JOIN orders o on c.client_id = o.client_id
                       RIGHT JOIN payment p on o.order_id = p.order_id WHERE  o.order_id=".$_GET['get'];
        $query=mysqli_query($con,$select);
       $row=mysqli_fetch_array($query);
                    ?>
                          
                            <table class="table">
                                  <tbody>
                                    <tr><td><b>Paid By </b></td><td><?php print $row['first_name']." ".$row['last_name']?></td></tr>
                        <tr><td><b> Phone number</b></td><td><?php print $row['phone_no']?></td></tr>
                        <tr><td><b> Amount</b></td><td> Kes <?php print number_format($row['order_cost'])?></td></tr>
                        <tr><td><b> Reference code</b></td><td><?php print $row['mpesa_code']?></td></tr>
                        <tr><td><b> Payment Date</b></td><td><?php print $row['order_date']?></td></tr>
                        <tr><td><b> Payment Method</b></td><td>Mpesa</td></tr>

                        <tr><td><b>Order  Status</b></td><td>
                                <?php
                                if($row['order_status']==1){
                                   print "Pending Finance approval";
                                }
                                if($row['order_status']==2){
                                    print "Approved By Finance";
                                }
                                if($row['order_status']==3){
                                    print "Items in Shippment";
                                }
                                if($row['order_status']==4){
                                    print "Delivery Complete";
                                }
                                if($row['order_status']==5){
                                    print "Delivery Complete";
                                }
                                 if($row['order_status']==7){
                                    print "Payment Rejected";
                                }
                                if($row['order_status']==8){
                                    print "Order Rejected By Customer";
                                }
                                ?>  
                                </td></tr>                                  
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
      
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
