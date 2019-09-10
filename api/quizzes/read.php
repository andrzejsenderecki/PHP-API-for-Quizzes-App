<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require '../config/dbConnect.php';
  require '../objects/quizzes.php';

  $dbConnect = new dbConnect();
  $database = $dbConnect->getConnection();

  $quiz = new Quizzes($database);

  $statement = $quiz->read();

  $recordsCount = $statement->rowCount();
 
  if($recordsCount > 0){
      $quizzesArray = array();
      $quizzesArray["quizzes"] = array();

      while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
          extract($record);
  
          $quiz=array(
              "id" => $id,
              "name" => $name,
          );
  
          array_push($quizzesArray["quizzes"], $quiz);
      }
  
      http_response_code(200);
      echo json_encode($quizzesArray);
  }
?>