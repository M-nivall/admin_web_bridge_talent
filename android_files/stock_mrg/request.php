<?php


include '../../include/connections.php';


$select="SELECT * FROM request r INNER JOIN clients c on r.client_id = c.client_id
    WHERE r.request_status IN ('Pending approval', 'Invoice sent')
    ORDER BY r.id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["name"]=$row["first_name"]." ".$row["last_name"];
    $index["phoneNo"]=$row["phone_no"];
    $index["items"]=$row["items"];
    $index["requestStatus"]=$row["request_status"];
    $index["requestDate"]=$row["request_date"];
    $index["amount"]=$row["amount"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='';
}
echo json_encode($response);
