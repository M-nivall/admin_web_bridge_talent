<?php

include '../../include/connections.php';



//creating a query
$select = "SELECT b.order_id,b.order_date,b.order_remark,b.rating,b.order_status,s.product_name,s.price,c.first_name,c.last_name
         FROM bookings b
         INNER JOIN clients c ON b.client_id = c.client_id
         INNER JOIN order_items oi ON b.order_id = oi.order_id AND oi.type = 'service'
         INNER JOIN services s ON oi.stock_id = s.stock_id
         WHERE  b.order_status = '8' ORDER BY b.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['orders'] = array();
      $results['message']="Order history";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['servName'] = $row['product_name'];
          $temp['totalFee'] = $row['price'];
          $temp['orderDate'] = $row['order_date'];
          $temp['orderRemark'] = $row['order_remark'];
          $temp['rating'] = $row['rating'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];

               if($row['order_status']==1){
              $temp['orderStatus'] = "Pending";
          }elseif ($row['order_status']==2){
              $temp['orderStatus'] = "Approved";
          }elseif ( $row['order_status']==3){
              $temp['orderStatus'] = "Shipping";
          }elseif ($row['order_status']==4){
              $temp['orderStatus'] = "Pay Invoiced Amount";
          }elseif ($row['order_status']==5){
              $temp['orderStatus'] = "Invoice Paid";
          }
          elseif ($row['order_status']==6){
              $temp['orderStatus'] = "Invoice Paid";

          }elseif ($row['order_status']==7){
              $temp['orderStatus'] = "Confirm Completion";

          }elseif ($row['order_status']==8){
              $temp['orderStatus'] = "Service Completed";
          }
          array_push($results['orders'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No Invoice Found";

}
//displaying the result in json format
echo json_encode($results);


?>