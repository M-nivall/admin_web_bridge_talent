<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$jobID=$_POST['jobID'];

$update=" UPDATE jobs SET job_status = 'Active' WHERE job_id = '$jobID'";
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Job posted successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>