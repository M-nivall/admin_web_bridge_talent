<?php

include '../../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

    $company_name = $_POST['company_name'];
    $industry = $_POST['industry'];
    $username = $_POST['username'];
    $location = $_POST['location'];
    $website = $_POST['website'];
    $company_description = $_POST['company_description'];
    $username = $_POST['username'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($company_name) || empty($industry) || empty($username) || empty($location) || empty($phoneNo) || empty($password)) {
        $response["status"] = 0;
        $response["message"] = "Some details are missing ";
        echo json_encode($response);
        mysqli_close($con);

    } else {

        // check if username already exists

        $select = "SELECT username FROM employers WHERE username='$username'";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) > 0) {

            $response["status"] = 0;
            $response["message"] = "Username is registered with another company";
            echo json_encode($response);

        } else {

            $select = "SELECT contacts FROM employers WHERE contacts='$phoneNo'";
            $query = mysqli_query($con, $select);
            if (mysqli_num_rows($query) > 0) {

                $response["status"] = 0;
                $response["message"] = "Phone number is registered with another company";
                echo json_encode($response);

            } else {
                $select = "SELECT email_address FROM employers WHERE email_address='$email'";
                $query = mysqli_query($con, $select);
                if (mysqli_num_rows($query) > 0) {

                    $response["status"] = 0;
                    $response["message"] = "Email is registered with another company";
                    echo json_encode($response);

                } else {

                    $insert = "INSERT INTO employers(company_name, username, contacts, email_address, industry,location, website, description)
                VALUES ('$company_name','$username','$phoneNo','$email','$industry','$location', '$website','$company_description')";
                    if (mysqli_query($con, $insert)) {

                        $response["status"] = 1;
                        $response["message"] = "You have successfully registered";

                        echo json_encode($response);
//                   mysqli_close($con);

                    } else {

                        $response["status"] = 0;
                        $response["message"] = " Something went wong please try again";

                        echo json_encode($response);
//                    mysqli_close($con);
                    }

                }
            }
        }
    }
}




