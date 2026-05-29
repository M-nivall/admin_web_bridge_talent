<?php

include '../../include/connections.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => 0, "message" => "Invalid request method"]);
    exit;
}

$userID = $_POST['userID'] ?? '';
$salary = $_POST['salary'] ?? '';
$notice_period = $_POST['notice_period'] ?? '';
$jobID = $_POST['jobID'] ?? '';

if (empty($userID) || empty($salary) || empty($notice_period) || empty($jobID)) {
    echo json_encode(["status" => 0, "message" => "Required fields missing"]);
    exit;
}

$userID = intval($userID);
$jobID = intval($jobID);

$checkQuery = "SELECT application_id FROM applications WHERE job_id=? AND applicant_id=?";
$stmt = $con->prepare($checkQuery);
$stmt->bind_param("ii", $jobID, $userID);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => 0, "message" => "You already applied"]);
    exit;
}

$stmt->close();

$uploadDir = "uploads/";

function saveUploadedFile($fileKey,$uploadDir){

    if(isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error']==0){

        $fileName = uniqid()."_".basename($_FILES[$fileKey]['name']);

        $targetPath = $uploadDir.$fileName;

        if(move_uploaded_file($_FILES[$fileKey]['tmp_name'],$targetPath)){
            return $fileName;
        }
    }

    return null;
}

$cvPdfName = saveUploadedFile('cvPdf',$uploadDir);
$coverLetterPdfName = saveUploadedFile('coverLetterPdf',$uploadDir);
$certificatePdfName = saveUploadedFile('certificatePdf',$uploadDir);

$insertQuery = "INSERT INTO applications 
(job_id, applicant_id, cv_url, cover_letter, certificate_url, salary, notice_period, date_applied) 
VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE())";

$stmt = $con->prepare($insertQuery);

$stmt->bind_param(
"iisssss",
$jobID,
$userID,
$cvPdfName,
$coverLetterPdfName,
$certificatePdfName,
$salary,
$notice_period
);

if($stmt->execute()){

    echo json_encode([
        "status"=>1,
        "message"=>"Application submitted successfully"
    ]);

}else{

    echo json_encode([
        "status"=>0,
        "message"=>"Failed to submit application"
    ]);
}

$stmt->close();
$con->close();

?>