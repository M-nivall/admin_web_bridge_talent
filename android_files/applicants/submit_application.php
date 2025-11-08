<?php

include '../../include/connections.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve POST data
    $userID = $_POST['userID'];
    $salary = $_POST['salary'];
    $notice_period = $_POST['notice_period'];
    $jobID = $_POST['jobID'];

    // Validate required fields
    if (empty($userID) || empty($salary) || empty($notice_period) || empty($jobID)) {
        echo json_encode(["status" => 0, "message" => "Required fields are missing"]);
        exit;
    }


    // File upload handling
    $uploadDir = 'uploads/';
    $cvPdfName = null;
    $coverLetterPdfName = null;

    // Function to save file and return its name
    function saveUploadedFile($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($_FILES[$fileKey]['name']);
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFilePath)) {
                return $fileName; // Only return the file name
            }
        }
        return null;
    }

    // Save files and get their names
    $cvPdfName = saveUploadedFile('cvPdf', $uploadDir);
    $coverLetterPdfName = saveUploadedFile('coverLetterPdf', $uploadDir);

    $query = "INSERT INTO applications (job_id, applicant_id, cv_url, cover_letter, salary, notice_period) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $stmt = $con->prepare($query);
    $stmt->bind_param(
        "ssssss", 
        $jobID, 
        $userID, 
        $cvPdfName, 
        $coverLetterPdfName, 
        $salary, 
        $notice_period
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => 1, "message" => "Application submitted successfully"]);
    } else {
        echo json_encode(["status" => 0, "message" => "Failed to submit application: " . $con->error]);
    }

    $stmt->close();
}

$con->close();

?>
