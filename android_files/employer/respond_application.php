<?php

include "../../include/connections.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $application_id = $_POST['application_id'];
    $status = $_POST['status'];          // shortlisted | rejected
    $note = $_POST['employer_note'];     // optional

    // Basic sanitization (recommended)
    $application_id = mysqli_real_escape_string($con, $application_id);
    $status = mysqli_real_escape_string($con, $status);
    $note = mysqli_real_escape_string($con, $note);

    $update = "
        UPDATE applications 
        SET status = '$status',
            employer_feedback = '$note'
        WHERE application_id = '$application_id'
    ";

    if (mysqli_query($con, $update)) {

        $response['status'] = 1;
        $response['message'] = 'Application updated successfully';

    } else {

        $response['status'] = 0;
        $response['message'] = 'Please try again';
    }

    echo json_encode($response);
}
?>
