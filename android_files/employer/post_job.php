<?php

include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $job_title = $_POST['job_title'];
    $job_category = $_POST['job_category'];
    $employer_type = $_POST['employer_type'];
    $entry_level = $_POST['entry_level'];
    $salary_range = $_POST['salary_range'];
    $location = $_POST['job_location'];
    $deadline = $_POST['deadline'];
    $job_description = $_POST['job_description'];
    $job_responsibilities = $_POST['job_responsibilities'];
    $qualifications = $_POST['qualifications'];
    $employerID = $_POST['employerID']; 
    $payment_code = $_POST['payment_code']; 
    $job_fee = $_POST['job_fee']; 

    // Validate required fields
    if (
        empty($job_title) || empty($job_category) || empty($employer_type) ||
        empty($entry_level) || empty($location) || empty($salary_range) || empty($deadline)
    ) {
        $response["status"] = 0;
        $response["message"] = "Some required fields are missing.";
        echo json_encode($response);
        mysqli_close($con);
        exit();
    }

    // Insert into jobs table
    $insert = "INSERT INTO jobs (
                employer_id, title, job_category, job_type,
                job_level, job_location, salary_range, deadline,
                job_description, job_responsibilities, qualifications
              ) VALUES (
                '$employerID', '$job_title', '$job_category', '$employer_type',
                '$entry_level', '$location', '$salary_range', '$deadline',
                '$job_description', '$job_responsibilities', '$qualifications'
              )";

    if (mysqli_query($con, $insert)) {
        $job_id = mysqli_insert_id($con); // get the last inserted job_id

        // Insert into payments table
        $payment_insert = "INSERT INTO payments (
                                job_id, employer_id, amount, transaction_code, payment_date
                           ) VALUES (
                                '$job_id', '$employerID', '$job_fee', '$payment_code', CURDATE()
                           )";

        if (mysqli_query($con, $payment_insert)) {
            $response["status"] = 1;
            $response["message"] = "Job details submited successfully.";
        } else {
            $response["status"] = 0;
            $response["message"] = "Job posted but failed to record payment.";
        }
    } else {
        $response["status"] = 0;
        $response["message"] = "Failed to post job. Please try again.";
    }

    echo json_encode($response);
    mysqli_close($con);
}

?>
