<?php

include '../../include/connections.php';




//creating a query
$select = "SELECT p.id,p.request_id,p.supplier_id,p.amount,p.payment_description,p.payment_status,p.payment_date ,c.first_name,c.last_name FROM supply_payment p INNER JOIN  clients c on c.client_id = p.supplier_id WHERE p.payment_status='unpaid'ORDER BY p.id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Order history";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['id'] = $row['id'];
          $temp['requestID'] = $row['request_id'];
          $temp['supplierName'] = $row['first_name'].' '.$row['last_name'];
          $temp['supplierID'] = $row['supplier_id'];
          $temp['amount'] = $row['amount'];
          $temp['payment_description'] = $row['payment_description'];
          $temp['payment_status'] = $row['payment_status'];
          $temp['payment_date'] = $row['payment_date'];
          

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No More Pending Payments Found";

}
//displaying the result in json format
echo json_encode($results);



//$today = date('Ymd');
//$startDate = date('Ymd', strtotime('-100 days'));
//$range = $today - $startDate;
//$rand = rand(100, 999);
//echo $rand;
//echo "</br>";
//$random = substr(md5(mt_rand()), 0, 2);
//echo $random;

?>