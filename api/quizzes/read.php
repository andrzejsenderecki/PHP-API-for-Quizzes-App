<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require '../config/dbConnect.php';
  require '../objects/quizzes.php';

  $dbConnect = new dbConnect();
  $pdo = $dbConnect->getConnection();

  $quiz = new Quizzes($pdo);

  $stmt = $quiz->read();

  $recordsCount = $stmt->rowCount();
  echo('cześć');
  if($recordsCount > 0){
      $quizzesArray = array();
      $quizzesArray["quizzes"] = array();

      while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($record);
  
          $quiz=array(
              "id" => $id,
              "name" => $name,
          );
  
          array_push($quizzesArray["quizzes"], $quiz);
      }
  
      http_response_code(200);
      echo('cześć');
      // echo json_encode($quizzesArray);
  }

  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>