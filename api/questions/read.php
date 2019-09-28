<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require '../config/dbConnect.php';
  require '../objects/questions.php';

  $dbConnect = new dbConnect();
  $pdo = $dbConnect->getConnection();
  $id = $_GET['id'];

  $questions = new Questions($pdo, $id);

  $stmt = $questions->read();

  $recordCount = $stmt->rowCount();

  if($recordCount > 0) {
    $questionsArray = array();

    $questionsArray['questions'] = array();

    while($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($record);

      $question=array(
        "id" => $id,
        "question" => $question,
        "answer_a" => $answer_a,
        "answer_b" => $answer_b,
        "answer_c" => $answer_c,
        "answer_d" => $answer_d,
        "correct_answer" => $correct_answer,
        "quiz_name" => $quiz_name
      );

      array_push($questionsArray['questions'], $question);
    }

    http_response_code(200);
    echo json_encode($questionsArray);
  }