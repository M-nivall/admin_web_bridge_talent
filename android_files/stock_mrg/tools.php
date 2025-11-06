<?php


include '../../include/connections.php';

$select="SELECT * FROM tools";
$query=mysqli_query($con,$select);


  if(mysqli_num_rows($query)>0){
      $response['status']=1;
      $response['message']="Stock";
      $response['details']=array();

      while ($row=mysqli_fetch_array($query)){
          $index['toolID']=$row['tool_id'];
          $index['toolName']=$row['tool_name'];
          $index['quantity']=$row['quantity'];

          array_push($response['details'],$index);
      }
      echo json_encode($response);
  }
  ?>