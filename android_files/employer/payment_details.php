<?php


include '../../include/connections.php';

$jobID=$_POST["jobID"];

$select = "SELECT p.payment_id, p.amount, p.transaction_code, e.company_name 
        FROM payments p INNER JOIN employers e ON p.employer_id = e.employer_id
        WHERE job_id='$jobID' 
        AND p.payment_status = 'Approved'";

$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){

    $index["payment_id"]=$row["payment_id"];
     $index["company_name"]=$row["company_name"];
    $index["amount"]=$row["amount"];
    $index["transaction_code"]=$row["transaction_code"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
}
echo json_encode($response);
