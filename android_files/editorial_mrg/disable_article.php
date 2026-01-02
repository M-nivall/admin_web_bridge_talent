<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$articleID=$_POST['articleID'];

$update=" UPDATE article SET article_status = 'Disabled' WHERE article_id = '$articleID'";
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Article disabled successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>