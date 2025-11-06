<?php


require_once '../../include/connections.php';



if ($_SERVER['REQUEST_METHOD'] =='POST'){


    $client_id = $_POST['clientID'];
    $order_id = $_POST['orderID'];
    $countyID = $_POST['countyID'];
    $townName = $_POST['townName'];
    $address = $_POST['address'];
    $deliveryCost = $_POST['shippingCost'];
    $totalCost = $_POST['totalCost'];
    $orderCost = $_POST['orderCost'];
    $mpesa_code = $_POST['mpesaCode'];

    $insert = "INSERT INTO service_payment (order_id, mpesa_code, client_id, order_cost, delivery_cost, total_cost, status)
                          VALUES ('$order_id','$mpesa_code','$client_id','$orderCost','$deliveryCost','$totalCost','1')";
    if(mysqli_query($con,$insert)){

        $update=" UPDATE bookings SET order_status ='5' where order_id = '$order_id'";
        mysqli_query($con,$update);

        $response["status"] = 1;
        $response["message"] ='Payment Successful';

        echo json_encode($response);
        mysqli_close($con);

    }else{

        $response["status"] = 0;
        $response["message"] ='Failed';

        echo json_encode($response);
        mysqli_close($con);

    }
}
?>



