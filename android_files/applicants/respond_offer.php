<?php

include "../../include/connections.php";

header("Content-Type: application/json");

$response = array();

if($_SERVER['REQUEST_METHOD']=="POST"){

    if(!isset($_POST['application_id']) || !isset($_POST['offer_response'])){

        echo json_encode([
            "status"=>0,
            "message"=>"Missing parameters"
        ]);
        exit;
    }

    $application_id = intval($_POST['application_id']);
    $offer_response = mysqli_real_escape_string($con,$_POST['offer_response']);

    $update = "
        UPDATE applications 
        SET offer_response = '$offer_response',
            status = '$offer_response'
        WHERE application_id = '$application_id'
    ";

    if(mysqli_query($con,$update)){

        if(mysqli_affected_rows($con)>0){

            $response['status']=1;
            $response['message']="Response submitted successfully";

        }else{

            $response['status']=0;
            $response['message']="Application not found";
        }

    }else{

        $response['status']=0;
        $response['message']="Database error";
    }

}else{

    $response['status']=0;
    $response['message']="Invalid request method";
}

echo json_encode($response);

?>