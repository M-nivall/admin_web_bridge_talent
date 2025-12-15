<?php

include("dbconnect.php");

$id=$_GET['updateid'];
$sql="update `applicants` set status='Approved' where $id=$id";
$result=mysqli_query($db,$sql);
if($result){
        //echo "Data updated successfully";
        header('location:approvedcustomers.php');
}else{
        die(mysqli_error($con));
    }
?>
