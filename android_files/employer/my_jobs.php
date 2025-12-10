<?php
include '../../include/connections.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userID = $_POST['userID'];

// Creating the query
$select = "SELECT j.job_id,j.title,j.job_category,j.job_level,j.job_description,j.qualifications,j.job_responsibilities,
        j.job_location,j.job_type,j.salary_range,j.date_posted, j.deadline,j.job_status
        FROM jobs j
        INNER JOIN employers e ON j.employer_id = e.employer_id
        WHERE j.employer_id = '$userID' 
        ORDER BY j.job_id DESC";

$query = mysqli_query($con, $select);

$results = array();

if (mysqli_num_rows($query) > 0) {
    $results['status'] = "1";
    $results['message'] = "My Jobs";
    $results['details'] = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $temp = array();
        $temp['job_id'] = $row['job_id'];
        $temp['title'] = $row['title'];
        $temp['job_category'] = $row['job_category'];
        $temp['job_level'] = $row['job_level'];
        $temp['description'] = $row['job_description'];
        $temp['qualifications'] = $row['qualifications'];
        $temp['job_responsibilities'] = $row['job_responsibilities'];
        $temp['job_location'] = $row['job_location'];
        $temp['job_type'] = $row['job_type'];
        $temp['salary_range'] = $row['salary_range'];
        $temp['date_posted'] = $row['date_posted'];
        $temp['deadline'] = $row['deadline'];
        $temp['job_status'] = $row['job_status'];

        array_push($results['details'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No jobs found";
}

echo json_encode($results);
}
?>
