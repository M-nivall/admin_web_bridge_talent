<?php

include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $response["status"] = 0;
        $response["message"] = "Enter both username and password";
        echo json_encode($response);
        mysqli_close($con);
    } else {

        $select = "SELECT employer_id, company_name, username, contacts, email_address, industry, location, website, status, user FROM employers 
                   WHERE username='$username' AND password='$password'";
        $query = mysqli_query($con, $select);

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {

                if ($row['status'] == 'Pending approval') {
                    $response["status"] = 2;
                    $response["message"] = "Please wait for your account to be approved";
                    echo json_encode($response);

                } elseif ($row['status'] == 'Rejected') {
                    $response["status"] = 2;
                    $response["message"] = "Account rejected. You cannot access your account.\n" . $row['remarks'];
                    echo json_encode($response);

                } elseif ($row['status'] == 'Approved') {
                    $response['status'] = "1";
                    $response['details'] = array();
                    $response["message"] = "Login successful";

                    $index['employerID'] = $row['employer_id'];
                    $index['companyName'] = $row['company_name'];
                    $index['username'] = $row['username'];
                    $index['contacts'] = $row['contacts'];
                    $index['emailAddress'] = $row['email_address'];
                    $index['industry'] = $row['industry'];
                    $index['website'] = $row['website'];
                    $index['user'] = $row['user'];

                    array_push($response['details'], $index);
                    echo json_encode($response);
                }
            }
        } else {
            $response["status"] = 0;
            $response["message"] = "Please confirm your username and password";
            echo json_encode($response);
        }
    }
}
