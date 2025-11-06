<?php

   include '../../include/connections.php';


   $select="SELECT * FROM employees WHERE userlevel='Technician'";
   $record=mysqli_query($con,$select);

   if(mysqli_num_rows($record)>0){

       $response['status']=1;
       $response['message']="Technicians";

       $response['details']=array();
       while($row=mysqli_fetch_array($record)){

           $index['username']=$row['username'];

           array_push($response['details'],$index);
       }
   }else{
       $response['status']=0;
       $response['message']="No record found";
   }

   echo json_encode($response);

?>