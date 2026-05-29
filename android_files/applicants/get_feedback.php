<?php

include '../../include/connections.php';

$clientID = $_POST['userID'];
$userType = $_POST['userType'];

// Build query based on userType
if ($userType == 'Applicant') {

    $select = "SELECT * FROM feedback f 
               INNER JOIN applicants a ON f.client_id = a.applicant_id
               WHERE a.applicant_id = '$clientID' AND user_type = '$userType'";

} elseif ($userType == 'Employer') {

    $select = "SELECT * FROM feedback f 
               INNER JOIN employers e ON f.client_id = e.employer_id
               WHERE e.employer_id = '$clientID' AND user_type = '$userType'";

} else {
    echo json_encode(['status' => '0', 'message' => 'Invalid user type']);
    exit();
}

$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {

    $results = array();
    $results['status'] = "1";
    $results['details'] = array();
    $results['message'] = "Feedback";

    while ($row = mysqli_fetch_array($query)) {

        $temp = array();
        $temp['comment']   = $row['comment'];
        $temp['recipient'] = $row['staff_id'];
        $temp['sender']    = $row['username'];
        $temp['reply']     = ($row['fb'] == "") ? 0 : $row['fb'];

        array_push($results['details'], $temp);
    }

} else {
    $results['status']  = "0";
    $results['message'] = "Nothing found";
}

echo json_encode($results);

?>