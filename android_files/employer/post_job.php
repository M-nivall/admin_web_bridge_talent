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
        $response["status"] = 1;
        $response["message"] = "Job posted successfully.";
        echo json_encode($response);
    } else {
        $response["status"] = 0;
        $response["message"] = "Failed to post job. Please try again.";
        echo json_encode($response);
    }

    mysqli_close($con);
}
?>
