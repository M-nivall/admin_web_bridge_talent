<?php

include '../../include/connections.php';

$clientID = $_POST['userID'];

$select = "
    SELECT f.comment, f.staff_id as staff, f.client_id, f.fb_id, f.fb,
           s.staff_id, s.role, c2.employer_id AS entity_id, c2.username
    FROM feedback f
    INNER JOIN staff s ON f.staff_id = s.role
    RIGHT JOIN employers c2 ON f.client_id = c2.employer_id
    WHERE s.staff_id = '$clientID'
    AND f.user_type = 'Employer'

    UNION

    SELECT f.comment, f.staff_id as staff, f.client_id, f.fb_id, f.fb,
           s.staff_id, s.role, a.applicant_id AS entity_id, a.username
    FROM feedback f
    INNER JOIN staff s ON f.staff_id = s.role
    RIGHT JOIN applicants a ON f.client_id = a.applicant_id
    WHERE s.staff_id = '$clientID'
    AND f.user_type = 'Applicant'

    ORDER BY fb_id DESC
";

$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {

    $results            = array();
    $results['status']  = "1";
    $results['details'] = array();
    $results['message'] = "Feedback";

    while ($row = mysqli_fetch_array($query)) {

        $temp              = array();
        $temp['comment']   = $row['comment'];
        $temp['recipient'] = $row['staff'];
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