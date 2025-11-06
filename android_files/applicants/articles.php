<?php

include '../../include/connections.php';

$select="SELECT * FROM article WHERE article_status = 'Active'";

$records=mysqli_query($con,$select);

       $results['status'] = "1";

       $results['articles'] = array();

       while ($row=mysqli_fetch_array($records)){


    $temp['articleID'] = $row['article_id'];
    $temp['title'] = $row['title'];
    $temp['content'] = $row['content'];
    $temp['dateCreated'] = $row['date_created'];


    array_push($results['articles'], $temp);

}


//displaying the result in json format
echo json_encode($results);







?>