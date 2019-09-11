<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require '../config/dbConnect.php';
  require '../objects/quizzes.php';

  $dbConnect = new dbConnect();
  $database = $dbConnect->getConnection();

  $quiz = new Quizzes($database);

  $data = json_decode(file_get_contents("php://input"));

  if(!empty($data->name)) {
    $quiz->name = $data->name;

    if($quiz->create()){
      http_response_code(201);
      echo json_encode(array("Code 201 - success"));
    }
    else {
      http_response_code(503);
      echo json_encode(array("Code 503 - error"));
    }
  } else {
    http_response_code(400);
    echo json_encode(array("Code 400 - no data"));
  }
?>