<?php

include '../../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];


    if ( empty($username) ||empty($password)) {
        $response["status"] = 0;
        $response["message"] = "Enter both username and password ";
        echo json_encode($response);
        mysqli_close($con);

    } else {

        // check if username already exists

        $select = "SELECT applicant_id, first_name, last_name, username, phone, email, status,
       date_created, user, bio, skills, education, profile_url FROM applicants WHERE username='$username' AND password='$password'";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row=mysqli_fetch_array($query)){
                if($row['status']=='Pending Approval'){
                    $response["status"] = 2;
                    $response["message"] = "Please wait for your account to be approved";
                    echo json_encode($response);
                }elseif ($row['status']=='Rejected'){
                    $response["status"] = 2;
                    //$response["message"] = "Account rejected. you can not access your account \n".$row['remarks'];
                    echo json_encode($response);
                }elseif($row['status']=='Approved') {
                    $response['status'] = "1";
                    $response['details'] = array();
                    $response["message"] = "Login successful";
                    $index['clientID']=$row['applicant_id'];
                    $index['firstname']=$row['first_name'];
                    $index['lastname']=$row['last_name'];
                    $index['username']=$row['username'];
                    $index['phoneNo']=$row['phone'];
                    $index['email']=$row['email'];
                    $index['dateCreated']=$row['date_created'];
                    $index['user']=$row['user'];
                    $index['bio']=$row['bio'];
                    $index['skills']=$row['skills'];
                    $index['education']=$row['education'];
                    $index['profileUrl']=$row['profile_url'];
                    array_push($response['details'],$index);
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




