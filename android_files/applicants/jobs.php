<?php

include '../../include/connections.php';

// Select all approved jobs with their employer details
$select = "SELECT 
            j.job_id, 
            j.title, 
            j.description, 
            j.location, 
            j.job_type, 
            j.salary_range, 
            j.date_posted, 
            j.deadline, 
            j.job_status,
            e.employer_id,
            e.company_name, 
            e.contacts, 
            e.email, 
            e.industry, 
            e.description AS employer_description
        FROM jobs j
        INNER JOIN employers e ON j.employer_id = e.employer_id 
        WHERE e.status = 'Approved'";

$records = mysqli_query($con, $select);

$results = array();
$results['status'] = "1";
$results['jobs'] = array();

if ($records && mysqli_num_rows($records) > 0) {
    while ($row = mysqli_fetch_assoc($records)) {

        $temp = array();

        // Job details
        $temp['job_id'] = $row['job_id'];
        $temp['title'] = $row['title'];
        $temp['description'] = $row['description'];
        $temp['location'] = $row['location'];
        $temp['job_type'] = $row['job_type'];
        $temp['salary_range'] = $row['salary_range'];
        $temp['date_posted'] = $row['date_posted'];
        $temp['deadline'] = $row['deadline'];
        $temp['job_status'] = $row['job_status'];

        // Employer details
        $temp['employer_id'] = $row['employer_id'];
        $temp['company_name'] = $row['company_name'];
        $temp['contacts'] = $row['contacts'];
        $temp['email'] = $row['email'];
        $temp['industry'] = $row['industry'];
        $temp['employer_description'] = $row['employer_description'];

        array_push($results['jobs'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No approved jobs found.";
}

// Output JSON response
header('Content-Type: application/json');
echo json_encode($results);

?>
