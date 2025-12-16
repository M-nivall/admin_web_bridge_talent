<?php
include '../../include/connections.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jobID = $_POST['jobID'];

// Creating the query
$select = "SELECT a.application_id,a.applicant_id,a.cv_url,a.cover_later,a.salary,a.notice_period,a.date_applied,a.status as application_status
        p.first_name,p.last_name,p.email,p.phone,p.bio,p.skills,p.education,p.profile_url,
        FROM applications a
        INNER JOIN applicants p ON a.applicant_id = p.applicant_id
        WHERE j.job_id = '$jobID' 
        ORDER BY a.application_id DESC";

$query = mysqli_query($con, $select);

$results = array();

if (mysqli_num_rows($query) > 0) {
    $results['status'] = "1";
    $results['message'] = "Job Applicants";
    $results['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['application_id'] = $row['application_id'];
        $temp['applicant_id'] = $row['applicant_id'];
        $temp['cv_url'] = $row['cv_url'];
        $temp['cover_later'] = $row['cover_later'];
        $temp['salary'] = $row['salary'];
        $temp['notice_period'] = $row['notice_period'];
        $temp['date_applied'] = $row['date_applied'];
        $temp['first_name'] = $row['first_name'];
        $temp['last_name'] = $row['last_name'];
        $temp['email'] = $row['email'];
        $temp['phone'] = $row['phone'];
        $temp['bio'] = $row['bio'];
        $temp['skills'] = $row['skills'];
        $temp['education'] = $row['education'];
        $temp['profile_url'] = $row['profile_url'];
        $temp['application_status'] = $row['application_status'];

        array_push($results['details'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No Applicant found";
}

echo json_encode($results);
}
?>
