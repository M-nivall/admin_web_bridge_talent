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
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Product Details </h4>
                 
                 
                 
                                            
                                           <?php
                    $select="SELECT * FROM clients c INNER JOIN orders o on c.client_id = o.client_id
                       RIGHT JOIN payment p on o.order_id = p.order_id 
                       INNER JOIN order_items oi ON o.order_id = oi.order_id
                       WHERE oi.type ='order' AND o.order_id=".$_GET['get'];
        $query=mysqli_query($con,$select);
       $row=mysqli_fetch_array($query);
                    ?>
                           
                            <table class="table">
                                  <tbody>
                                    <th><b>Item</b></th>
                                    <th><b>Quantity</b> </th>
                                    <?php
                $select="SELECT * FROM orders o INNER JOIN  order_items oi on o.order_id = oi.order_id
            RIGHT JOIN stock s on oi.stock_id = s.stock_id WHERE oi.type = 'order' AND o.order_id=".$_GET['get'];
                $query=mysqli_query($con,$select);
                while($row3=mysqli_fetch_array($query)){
                    ?>
                   <tr>
                       <td><?php print $row3['product_name']?></td>
                       <td><?php print $row3['quantity']?></td>
                   </tr>
                <?php
                }
                ?>
                                  
                                  </tbody>
                                  </table>                     
                   
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Details </h4>
                 
                 
                 
                                            
                                           <?php
                    $select="SELECT * FROM clients c 
                    INNER JOIN orders o on c.client_id = o.client_id
                    INNER JOIN order_items oi ON o.order_id = oi.order_id
                       RIGHT JOIN payment p on o.order_id = p.order_id WHERE oi.type = 'order' AND o.order_id=".$_GET['get'];
        $query=mysqli_query($con,$select);
       $row=mysqli_fetch_array($query);
                    ?>
                           
                            <table class="table">
                                  <tbody>
                                    <tr><td><b>Client Name</b></td><td><?php print $row['first_name']." ".$row['last_name']?></td></tr>
                        <tr><td><b> Phone number</b></td><td><?php print $row['phone_no']?></td></tr>
                        <tr><td><b> Total cost KES</b></td><td><?php print number_format($row['total_cost'])?></td></tr>
                        <tr><td><b> Mpesa code</b></td><td><?php print $row['mpesa_code']?></td></tr>
                        <tr><td><b> Status</b></td><td>
                                <?php
                                if($row['order_status']==1){
                                   print "Pending approval";
                                }
                                if($row['order_status']==2){
                                    print "Approved";
                                }
                                if($row['order_status']==3){
                                    print "Shipping";
                                }
                                if($row['order_status']==5){
                                    print "Delivered";
                                }
                                ?>
                            </td></tr>
                                  </tbody>  
                                  </table>                    
                   
                  </div>
                </div>
              </div>

              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Shipping Details </h4>
                 
                 
                 
                                            
                                           <?php
                    $select="SELECT * FROM clients c INNER JOIN orders o on c.client_id = o.client_id
                       RIGHT JOIN payment p on o.order_id = p.order_id WHERE  o.order_id=".$_GET['get'];
        $query=mysqli_query($con,$select);
       $row=mysqli_fetch_array($query);
                    ?>
                           
                           <?php
                    $select="SELECT * FROM clients c INNER JOIN delivery d on c.client_id = d.client_id
                      RIGHT JOIN counties c2 on d.county_id = c2.county_id RIGHT JOIN towns t on c2.county_id = t.county_id
                      WHERE c.client_id=".$row['client_id'];
                    $qly=mysqli_query($con,$select);
                    $row2=mysqli_fetch_array($qly);
                    ?>
                            </div>
                            <table class="table">
                                  
                                    
                                  <tbody>
                                    <tr><td><b> County</b></td><td><?php print $row2['county_name']?></td></tr>
                    <tr><td><b> Town</b></td><td><?php print $row2['town_name']?></td></tr>
                    <tr><td><b> Client Address</b></td><td><?php print $row2['address']?></td></tr>
                                  </tbody>
                            </table>                
                   
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
