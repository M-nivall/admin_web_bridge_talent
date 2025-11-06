<?php


require_once '../../include/connections.php';


// remove from cart

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $itemID=$_POST['itemID'];

    $update="DELETE FROM order_items WHERE item_id='$itemID'";
    if(mysqli_query($con,$update)){

        $response["status"] = 1;
        $response["message"] ='Your Booking has been canceled. You will need to make another booking to access this service ';

        echo json_encode($response);
        mysqli_close($con);

    }else{

        $response["status"] = 0;
        $response["message"] ='Failed to update cart';

        echo json_encode($response);
        mysqli_close($con);

    }
}
?>



