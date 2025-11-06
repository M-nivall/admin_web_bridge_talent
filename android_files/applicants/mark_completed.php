<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $rating=$_POST['rating'];
     $review=$_POST['review'];


     $update="UPDATE bookings SET order_status='8', order_remark = '$review', rating = '$rating' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $update="UPDATE assign SET assign_status='Delivered'WHERE order_id='$orderID'";
         mysqli_query($con,$update);

         $response['status']=1;
         $response['message']='Thank you for choosing Citizen Cooling Solution';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>