<?php
include '../../include/connections.php';

header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => 0,
        "message" => "Invalid request method"
    ]);
    exit;
}

// Validate jobID
if (!isset($_POST['jobID']) || empty($_POST['jobID'])) {
    echo json_encode([
        "status" => 0,
        "message" => "jobID is required"
    ]);
    exit;
}

$jobID = intval($_POST['jobID']); // sanitize input

// Prepare SQL (prevents SQL injection)
$sql = "
    SELECT 
        a.application_id,
        a.applicant_id,
        a.cv_url,
        a.cover_letter,
        a.salary,
        a.notice_period,
        a.date_applied,
        a.status AS application_status,
        p.first_name,
        p.last_name,
        p.email,
        p.phone,
        p.bio,
        p.skills,
        p.education,
        p.profile_url
    FROM applications a
    INNER JOIN applicants p ON a.applicant_id = p.applicant_id
    WHERE a.job_id = ?
    ORDER BY a.application_id DESC
";

$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "status" => 0,
        "message" => "Database prepare failed"
    ]);
    exit;
}

$stmt->bind_param("i", $jobID);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {

    $response['status'] = 1;
    $response['message'] = "Job Applicants";
    $response['details'] = [];

    while ($row = $result->fetch_assoc()) {

        $response['details'][] = [
            "application_id"      => $row['application_id'],
            "applicant_id"        => $row['applicant_id'],
            "cv_url"              => $row['cv_url'],
            "cover_letter"        => $row['cover_letter'],
            "salary"              => $row['salary'],
            "notice_period"       => $row['notice_period'],
            "date_applied"        => $row['date_applied'],
            "application_status"  => $row['application_status'],
            "full_name"           => $row['first_name'] . ' ' . $row['last_name'],
            "email"               => $row['email'],
            "phone"               => $row['phone'],
            "bio"                 => $row['bio'],
            "skills"              => $row['skills'],
            "education"           => $row['education'],
            "profile_url"         => $row['profile_url']
        ];
    }

} else {
    $response['status'] = 0;
    $response['message'] = "No applicants found";
}

$stmt->close();
$con->close();

echo json_encode($response);
?>
