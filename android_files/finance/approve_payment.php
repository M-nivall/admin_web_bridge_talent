<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$jobID=$_POST['jobID'];

$update=" UPDATE jobs SET job_status = 'Payment Approved' WHERE job_id = '$jobID'";
if(mysqli_query($con,$update)){

    $update1=" UPDATE payments SET payment_status = 'Approved' WHERE job_id = '$jobID'";
    mysqli_query($con,$update1);

    $response['status']=1;
    $response['message']='Approved successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>