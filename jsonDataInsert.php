<?php

require_once("db.php");
require_once("config.php");
header("Content-Type:application/json");




// Message------------------------
$response = array(
        "error" =>  true, 
        "message"=> "Error Occured"
        );  


$action = $_GET['action'];

function santized($data)  {
        global $mysqli;
        return $mysqli->real_escape_string($data);
        
}

// Message------------------------
$response = array(
        "error" =>  false, 
        "message"=> "Error Occured"
        );  


if($action=="create-user"){
        // Receive JSON data
$json = file_get_contents('php://input');

// Decode JSON
$jsondata = json_decode($json, true);

// Check if JSON decoding was successful
if ($jsondata === null) {
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "Invalid JSON data"));
    exit;
}
        $faceid=santized($jsondata['faceid']);
        $name=santized($jsondata['name']); 
        $email=santized($jsondata['email']);
        $password=santized($jsondata['password']); 
        $qery="INSERT INTO `users` (`SrNo`, `signuptime`, `name`, `DOB`, `email`, `password`, `userid`, `image`, `frameimg`, `description`) VALUES (NULL, current_timestamp(), '$name', NULL, '$email', '$password', '$faceid', NULL, NULL, NULL);";
        $result=$mysqli->query($qery);
        if($result){
           $response['error'] = false;
           $response['message'] = 'user Added Suceesfully';
           $response['data'] = $jsondata;
                        
        }else{
                $response['error'] = true;
                $response['message'] = 'user Cannot be Added';  
        }
        echo json_encode($response);
        die();
}elseif($action=='login-user'){
                // Receive JSON data
$json = file_get_contents('php://input');

// Decode JSON
$jsondata = json_decode($json, true);

// Check if JSON decoding was successful
if ($jsondata === null) {
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "Invalid JSON data"));
    exit;
}
                $email=santized($jsondata['email']);
                $password=santized($jsondata['password']); 
        $qery= "SELECT * FROM `users` WHERE email='$email' and password='$password'";
        $result=$mysqli->query($qery);
        if($result->num_rows> 0){
                $userRow=$result->fetch_assoc();
                $response["error"] = true;
                $response["message"] = "User logged suceesfully";

               
        }else{
                header("HTTP/1.1 401 Unauthorized");
                $response["error"] = false;
                $response["message"] = "         email-id and Password";
       }
       echo json_encode($response);
       die();
}elseif($action== "get-user-details"){
        $email=santized($jsondata['email']); 
        $qery= "SELECT * FROM `users` WHERE email='$email'";
        $result=$mysqli->query($qery);
        if($result->num_rows> 0){
                $userRow=$result->fetch_assoc();
                $response["error"] = false;
                $response["message"] = "User found";
                $response["data"]=$userRow;
        }else{
                header("HTTP/1.1 401 Not Found");
                $response["error"] = true;
                $response["message"] = "User not found";
       }
       echo json_encode($response);
       die();
}elseif($action== "delete-user"){
        $email=santized($_POST['email']);
        $qery="DELETE FROM users WHERE `users`.`email` = '$email'";
        $result=$mysqli->query($qery);
        echo $result;
        if($result){
                $response["error"] = false;
                $response["message"] = "User Delete";
        
        }else{
                header("HTTP/1.1 400 Not Found");
                $response["error"] = true;
                $response["message"] = "User not found";
       }
       echo json_encode($response);
       die();
}elseif($action== "get-users"){
        $qery= "SELECT * FROM `users`";
        $result=$mysqli->query($qery);
        if( $result->num_rows> 0){
                $response["error"] = false;
                $response["message"] = $result->num_rows."-User found";
                while($row=$result->fetch_assoc()){
                        $User[]= $row;
                }
                $response['data']= $User;

        }else{
                header("HTTP/1.1 400 Not Found");
                $response["error"] = true;
                $response["message"] = "User not found";
        }

        echo json_encode($response);
}


exit();

