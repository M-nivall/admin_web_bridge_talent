<?php

include '../include/connections.php';

$orderID = $_POST['orderID'];

// Creating a query
$select = "SELECT * FROM bookings WHERE order_id='$orderID'";
$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $rowp = mysqli_fetch_array($query);
    $item = array();
    $item['status'] = "1";

    // Set order status message
    if ($rowp['order_status'] == 1) {
        $item['orderStatus'] = "Pending Assignment";
    } elseif ($rowp['order_status'] == 2) {
        $item['orderStatus'] = "Confirmed";
    } elseif ($rowp['order_status'] == 3) {
        $item['orderStatus'] = "Delivered";
    } elseif ($rowp['order_status'] == 5) {
        $item['orderStatus'] = "Pending approval";
    }
    
    $item['message'] = "Order items";
    $item['details'] = array();

    // Fetch only the first item in the order
    $select = "SELECT s.product_name, s.stock_id, s.price, oi.item_id, oi.quantity 
               FROM services s 
               INNER JOIN order_items oi ON s.stock_id = oi.stock_id  
               WHERE oi.order_id = '$orderID' 
               LIMIT 1";
    $query = mysqli_query($con, $select);

    if ($row = mysqli_fetch_array($query)) {
        $temp = array();
        $temp['quantity'] = $row['quantity'];
        $temp['itemPrice'] = $row['price'];
        $temp['itemName'] = $row['product_name'];
        $temp['subTotal'] = $row['price'] * $row['quantity'];
        array_push($item['details'], $temp);
    }

    // Calculate cart total
    $select = "SELECT SUM(s.price * oi.quantity) AS cartTotal 
               FROM order_items oi 
               INNER JOIN services s ON oi.stock_id = s.stock_id
               WHERE order_id = '$orderID'";
    $response = mysqli_query($con, $select);

    if ($row = mysqli_fetch_array($response)) {
        $item['cartTotal'] = $row['cartTotal'];
    } else {
        $item['cartTotal'] = 0;
    }
} else {
    $item = array();
    $item['status'] = "0";
    $item['message'] = "No record found";
}

// Output the result in JSON format
echo json_encode($item);

?>
