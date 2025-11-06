<?php

include "../../include/connections.php";

 if($_SERVER['REQUEST_METHOD']=='POST'){

    $requestID=$_POST['requestID'];
    $amount = $_POST['amount'];

   $select="SELECT * FROM request WHERE id='$requestID'";
                $record=mysqli_query($con,$select);
                $rowC=mysqli_fetch_assoc($record);
                $supplierId=$rowC['client_id'];
                $paymentDescription=$rowC['items'];
                $quantity=$rowC['quantity'];

                 // insert 

                $insert= "INSERT INTO supply_payment (supplier_id, amount, payment_description,quantity,request_id)
                  VALUES ('$supplierId', '$amount', '$paymentDescription', '$quantity','$requestID')";
                  mysqli_query($con,$insert);

    $update="UPDATE request SET request_status='Invoice Sent' WHERE id='$requestID'";
    if(mysqli_query($con,$update)){

         $update2="UPDATE request SET amount='$amount' WHERE id='$requestID'";
         mysqli_query($con,$update2);

      

        $response['status']=1;
        $response['message']='Invoice Sent, Please Await Payment';

    }else{
        $response['status']=0;
        $response['message']='Please try again';

    }
    echo json_encode($response);
}
?>