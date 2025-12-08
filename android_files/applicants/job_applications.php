<?php
include '../../include/connections.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userID = $_POST['userID'];

// Creating the query
$select = "SELECT a.application_id,a.job_id,a.date_applied,a.status,a.employer_feedback,j.title,j.job_description,j.job_location,j.job_type,j.salary_range,
        e.company_name,e.email_address,e.industry
        FROM applications a
        INNER JOIN jobs j ON a.job_id = j.job_id
        INNER JOIN employers e ON j.employer_id = e.employer_id
        WHERE a.applicant_id = '$userID' 
        ORDER BY a.application_id DESC";

$query = mysqli_query($con, $select);

$results = array();

if (mysqli_num_rows($query) > 0) {
    $results['status'] = "1";
    $results['message'] = "Job Applications";
    $results['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['application_id'] = $row['application_id'];
         $temp['job_id'] = $row['job_id'];
        $temp['date_applied'] = $row['date_applied'];
        $temp['application_status'] = $row['status'];
        $temp['title'] = $row['title'];
        $temp['description'] = $row['job_description'];
        $temp['location'] = $row['job_location'];
        $temp['job_type'] = $row['job_type'];
        $temp['salary_range'] = $row['salary_range'];
        //Company Details
        $temp['company_name'] = $row['company_name'];
        $temp['email'] = $row['email_address'];
        $temp['industry'] = $row['industry'];
        $temp['employer_feedback'] = $row['employer_feedback'];

        array_push($results['details'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No job application found";
}

echo json_encode($results);
}
?>
