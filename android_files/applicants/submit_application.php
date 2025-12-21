<?php

include '../../include/connections.php';

header('Content-Type: application/json');

if ($con->connect_error) {
    die(json_encode(["status" => 0, "message" => "Connection failed: " . $con->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => 0, "message" => "Invalid request method"]);
    exit;
}

// Retrieve POST data
$userID        = $_POST['userID'] ?? '';
$salary        = $_POST['salary'] ?? '';
$notice_period = $_POST['notice_period'] ?? '';
$jobID         = $_POST['jobID'] ?? '';

// Validate required fields
if (empty($userID) || empty($salary) || empty($notice_period) || empty($jobID)) {
    echo json_encode(["status" => 0, "message" => "Required fields are missing"]);
    exit;
}

// Sanitize IDs
$userID = intval($userID);
$jobID  = intval($jobID);

// Check for duplicate application
$checkQuery = "SELECT application_id FROM applications WHERE job_id = ? AND applicant_id = ?";
$checkStmt  = $con->prepare($checkQuery);
$checkStmt->bind_param("ii", $jobID, $userID);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo json_encode(["status" => 0, "message" => "You have already applied for this job"]);
    $checkStmt->close();
    $con->close();
    exit;
}
$checkStmt->close();

// File upload handling
$uploadDir = 'uploads/';
$cvPdfName = null;
$coverLetterPdfName = null;

function saveUploadedFile($fileKey, $uploadDir) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $fileName = uniqid() . '_' . basename($_FILES[$fileKey]['name']);
        $targetFilePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFilePath)) {
            return $fileName;
        }
    }
    return null;
}

// Save files
$cvPdfName = saveUploadedFile('cvPdf', $uploadDir);
$coverLetterPdfName = saveUploadedFile('coverLetterPdf', $uploadDir);

// Insert application
$insertQuery = "INSERT INTO applications (job_id, applicant_id, cv_url, cover_letter, salary, notice_period, date_applied) 
                VALUES (?, ?, ?, ?, ?, ?, CURDATE())";
$stmt = $con->prepare($insertQuery);
$stmt->bind_param("ssssss", $jobID, $userID, $cvPdfName, $coverLetterPdfName, $salary, $notice_period);

if ($stmt->execute()) {
    echo json_encode(["status" => 1, "message" => "Application submitted successfully"]);
} else {
    echo json_encode(["status" => 0, "message" => "Failed to submit application: " . $con->error]);
}

$stmt->close();
$con->close();

?>
