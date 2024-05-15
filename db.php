<?php
echo "Start";
  $dbHost="b0aptaymbxauak16hmrq-mysql.services.clever-cloud.com";
  $dbuser="ufdqwkv6egzbgmzk";
  $dbpass="aFRWF2otlXY6IrlurWfY";
  $dbname="b0aptaymbxauak16hmrq";
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
