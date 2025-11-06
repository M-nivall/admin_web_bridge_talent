<?php

include '../../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

   
    $email = $_POST['email'];
  


    if (empty($email)) {
        $response["status"] = 0;
        $response["message"] = "Some details are missing ";
        echo json_encode($response);
        mysqli_close($con);

    } else {

                $select = "SELECT email FROM clients WHERE email='$email'";
                $query = mysqli_query($con, $select);
                if (mysqli_num_rows($query) > 0) {

                        $response["status"] = 1;
                        $response["message"] = "Email Found Proceed to password Reset";

                        echo json_encode($response);
//                    mysqli_close($con);

                } else {

                        $response["status"] = 0;
                        $response["message"] = "Email Not Found";

                        echo json_encode($response);
                    
                } 
            }
        }




