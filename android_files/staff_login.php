<?php

include '../include/connections.php';

//insert

if ($_SERVER['REQUEST_METHOD'] =='POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $staff = $_POST['staff'];


    if ( empty($username) ||empty($password)) {
        $response["status"] = 0;
        $response["message"] = "Enter both username and password ";
        echo json_encode($response);
        mysqli_close($con);
    } else {
        // check if username already exists
        $select = "SELECT staff_id, f_name, l_name, username, phone, email, status,
       date_created, password, role FROM employees 
WHERE username='$username' AND password='$password' AND userlevel = '$staff' ";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row=mysqli_fetch_array($query)){

                    $response['status'] = "1";
                    $response['details'] = array();
                    $response["message"] = "Login successful";
                    
                    $index['clientID']=$row['staff_id'];
                    $index['firstname']=$row['f_name'];
                    $index['lastname']=$row['l_name'];
                    $index['username']=$row['username'];
                    $index['phoneNo']=$row['phone'];
                    $index['email']=$row['email'];
                    $index['dateCreated']=$row['date_created'];
                    $index['user']=$row['role'];

                    array_push($response['details'],$index);
                    echo json_encode($response);
                }

        } else {
            $response["status"] = 0;
            $response["message"] = "Please confirm your username and password";
            echo json_encode($response);
                }
            }
}




