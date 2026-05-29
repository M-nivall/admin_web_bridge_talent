<?php

include "../../include/connections.php";

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['application_id']) || !isset($_POST['status'])) {
        echo json_encode([
            "status" => 0,
            "message" => "Missing parameters"
        ]);
        exit;
    }

    $application_id = mysqli_real_escape_string($con, $_POST['application_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $note = mysqli_real_escape_string($con, $_POST['employer_note']);

    $update = "
        UPDATE applications 
        SET verification = '$status'
           
        WHERE application_id = '$application_id'
    ";

    if (mysqli_query($con, $update)) {

        if(mysqli_affected_rows($con) > 0){

            $response['status'] = 1;
            $response['message'] = 'Verification updated successfully';

        } else {

            $response['status'] = 0;
            $response['message'] = 'Application not found or already updated';
        }

    } else {

        $response['status'] = 0;
        $response['message'] = 'Database error: ' . mysqli_error($con);
    }

} else {

    $response['status'] = 0;
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);

?>