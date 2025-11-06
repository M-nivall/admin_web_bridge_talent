<?php
include("dbconnect.php");

$id=$_GET['updateid'];
$sql="update `applicants` set status='Rejected' where $id=$id";
$result=mysqli_query($db,$sql);
if($result){
        //echo "Data updated successfully";
        header('location:rejectedcustomers.php');
}else{
        die(mysqli_error($con));
    }
    

?>
