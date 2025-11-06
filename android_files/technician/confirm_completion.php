<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $amount=$_POST['amount'];


     $update="UPDATE bookings SET order_status='7'WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $update="UPDATE assign SET assign_status='Done'WHERE order_id='$orderID'";
         mysqli_query($con,$update);

         $response['status']=1;
         $response['message']='Task Completion Sucessfull, Awaiting Customer Confirmation';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>