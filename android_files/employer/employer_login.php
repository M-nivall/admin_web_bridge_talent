<?php

include '../../include/connections.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo json_encode(["status" => 0, "message" => "Enter both username and password"]);
        exit;
    }

    $select = "SELECT employer_id, company_name, username, contacts, email_address,
                      industry, location, website, status, user
               FROM employers 
               WHERE username = '$username' AND password = '$password'";

    $query = mysqli_query($con, $select);

    // Debug any SQL error
    if (!$query) {
        echo json_encode(["status" => 0, "message" => mysqli_error($con)]);
        exit;
    }

    if (mysqli_num_rows($query) > 0) {

        $row = mysqli_fetch_assoc($query);

        if ($row['status'] == 'Pending approval') {
            echo json_encode(["status" => 2, "message" => "Please wait for your account to be approved"]);
            exit;
        }

        if ($row['status'] == 'Rejected') {
            echo json_encode(["status" => 2, "message" => "Account rejected. You cannot access your account."]);
            exit;
        }

        if ($row['status'] == 'Approved') {

            $response['status'] = "1";
            $response["message"] = "Login successful";
            $response['details'][] = [
                "employerID" => $row['employer_id'],
                "companyName" => $row['company_name'],
                "username" => $row['username'],
                "contacts" => $row['contacts'],
                "emailAddress" => $row['email_address'],
                "industry" => $row['industry'],
                "website" => $row['website'],
                "user" => $row['user']
            ];

            echo json_encode($response);
            exit;
        }

    } else {
        echo json_encode(["status" => 0, "message" => "Please confirm your username and password"]);
    }
    
}
