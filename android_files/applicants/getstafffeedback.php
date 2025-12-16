<?php

include '../../include/connections.php';

$clientID=$_POST['userID'];

//creating a query

$select = "SELECT f.comment,f.staff_id ,f.client_id,f.staff_id,f.fb_id ,f.fb,e.emp_id ,e.userlevel,e.emp_id, c2.client_id,c2.username FROM feedback f INNER JOIN employees e on f.staff_id = e.userlevel
          RIGHT JOIN clients c2 on f.client_id = c2.client_id WHERE e.emp_id= '$clientID'ORDER BY f.fb_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){

      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Feedback";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['comment'] = $row['comment'];
          $temp['recipient'] = $row['staff_id'];
          $temp['sender'] = $row['username'];

          if($row['fb']==""){
              $temp['reply'] = 0;
          }else{
              $temp['reply'] = $row['fb'];
          }


          array_push($results['details'], $temp);

      }


  }else{
    $results['status'] = "0";
      $results['message'] = "Nothing found";

}
//displaying the result in json format
echo json_encode($results);

?>