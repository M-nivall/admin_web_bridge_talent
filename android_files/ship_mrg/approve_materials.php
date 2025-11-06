<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['requestID'];
    $item = $_POST['item'];

    // Update the request state in tools_requests table
    $update = "UPDATE tools_requests SET request_state='Approved' WHERE id='$id'";

    if (mysqli_query($con, $update)) {
        
        // Handle the item string: split based on commas, ensuring spaces are preserved for multi-word names.
        // For example, use trim and ensure "Feeler Gauge" is kept as a whole
        $tools = array_map('trim', explode(',', $item));

        // Loop through each tool name and update the quantity in the tools table
        foreach ($tools as $tool) {
            // Here, you can use the tool name directly, ensuring it's trimmed of extra spaces
            $decrementQuery = "UPDATE tools SET quantity = quantity - 1 WHERE tool_name = '$tool'";

            if (!mysqli_query($con, $decrementQuery)) {
                // If there's an error with any of the updates, you can return an error message
                $response['status'] = 0;
                $response['message'] = 'Error updating quantity for ' . $tool;
                echo json_encode($response);
                exit;
            }
        }

        // If everything goes fine, send a success response
        $response['status'] = 1;
        $response['message'] = 'Item Request Approved and quantities updated';

    } else {
        $response['status'] = 0;
        $response['message'] = 'Please try again';
    }

    echo json_encode($response);
}
?>
