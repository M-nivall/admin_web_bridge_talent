<?php


include '../../include/connections.php';


$select="SELECT * FROM tools_requests a INNER JOIN employees e on a.emp_id = e.emp_id
    WHERE a.request_state = 'Pending approval'
    ORDER BY a.id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["name"]=$row["f_name"]." ".$row["l_name"];
    $index["phoneNo"]=$row["contact"];
    $index["items"]=$row["materials"];
    $index["requestStatus"]=$row["request_state"];
    $index["requestDate"]=date('Y-m-d');
    $index["amount"]=$row["order_id"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing more found';
}
echo json_encode($response);
