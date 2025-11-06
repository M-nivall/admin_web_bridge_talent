<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../include/connections.php';

    $userID = $_POST['userID'];
    $bio = $_POST['bio'];
    $skills = $_POST['skills'];
    $education = $_POST['education'];
    $originalImgName = $_FILES['filename']['name'];
    $tempName = $_FILES['filename']['tmp_name'];
    $folder = "../profiles/";

    $response = array(); // Initialize response array

    // Check if file was uploaded successfully
    if (move_uploaded_file($tempName, $folder . $originalImgName)) {
        // Start transaction
        mysqli_autocommit($con, false);

        
        $query1 = "UPDATE applicants
                  SET bio = '$bio', skills = '$skills', education = '$education', profile_url = '$originalImgName' 
                  WHERE applicant_id = '$userID'";

        // Execute both queries
        $result1 = mysqli_query($con, $query1);

        if ($result1) {
            mysqli_commit($con); // Commit transaction if both queries succeed
            $response['status'] = '1';
            $response['message'] = 'Profile set successfully';
        } else {
            mysqli_rollback($con); // Rollback transaction if any query fails
            $response['status'] = '0';
            $response['message'] = 'Failed to set profile';
        }
    } else {
        $response['status'] = '0';
        $response['message'] = 'something went wrong';
    }

    // Close connection
    mysqli_close($con);

    // Return JSON response
    echo json_encode($response);
}
?>
