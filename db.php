<?php
  $dbHost="localhost";
  $dbuser="root";
  $dbpass="";
  $dbname="faceindia";
  $mysqli=new mysqli($dbHost,$dbuser,$dbpass,$dbname);

  if($mysqli->connect_errno){
          $response = array(
          "error" =>  true, 
          "message"=> "incorct database connectiomn"
          );
          echo json_encode($response);
          die();
  }
?>
