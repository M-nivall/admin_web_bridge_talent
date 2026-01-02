<?php
include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $created_by = $_POST['created_by'];

    $insert = "INSERT INTO article 
        (title, content, date_created, created_by)
        VALUES 
        ('$title', '$content', CURDATE(), '$created_by')";

    if (mysqli_query($con, $insert)) {
        $response['status'] = 1;
        $response['message'] = 'Article posted successfully';
    } else {
        $response['status'] = 0;
        $response['message'] = 'Failed to add article';
    }

    echo json_encode($response);
}
?>
