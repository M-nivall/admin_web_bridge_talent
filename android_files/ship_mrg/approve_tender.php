<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$id=$_POST['requestID'];

$update="UPDATE  request SET request_status='Supply Confirmed' WHERE id = '$id' ";

$sel="SELECT quantity,payment_description FROM supply_payment  WHERE request_id='$id' ";
          $qury=mysqli_query($con,$sel);
          $rowC=mysqli_fetch_array($qury);
           $quantity= $rowC['quantity'];
           $payment_description= $rowC['payment_description'];

$sel2="SELECT stock FROM stock  WHERE product_name='$payment_description'";
          $qury2=mysqli_query($con,$sel2);
          $rowD=mysqli_fetch_array($qury2);
         $quantity2= $rowD['stock'];

         $totalstock = $quantity +  $quantity2;
           

$update1="UPDATE stock SET stock =$totalstock WHERE product_name='$payment_description'";
    mysqli_query($con,$update1);

//$update2="UPDATE request SET request_status='Paid' WHERE id='$id'";
 //   mysqli_query($con,$update2);
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Confirmed Stock Has Been Recieved and Updated SuccessFully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>