<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require '../config/dbConnect.php';
  require '../objects/quizzes.php';

  $dbConnect = new dbConnect();
  $pdo = $dbConnect->getConnection();

  $quiz = new Quizzes($pdo);

  $data = $_POST;

  if(!empty($data['name'])) {
    $quiz->name = $data['name'];

    if($quiz->create()){
      http_response_code(201);
      echo ("Code 201 - success");
    }
    else {
      http_response_code(503);
      echo ("Code 503 - error");
    }
  } else {
    http_response_code(400);
    echo ("Code 400 - no data");
  }
?>