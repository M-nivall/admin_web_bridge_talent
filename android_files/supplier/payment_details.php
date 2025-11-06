<?php


include '../../include/connections.php';

$requestID=$_POST["requestID"];
$select = "SELECT * FROM supply_payment WHERE request_id='$requestID' AND payment_status = 'Paid'";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["items"]=$row["payment_description"];
    $index["requestStatus"]=$row["payment_status"];
    $index["requestDate"]=$row["payment_date"];
    $index["quantity"]=$row["quantity"];
    $index["amount"]=$row["amount"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
}
echo json_encode($response);
