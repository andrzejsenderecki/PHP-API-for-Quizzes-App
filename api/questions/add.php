<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require '../config/dbConnect.php';
  require '../objects/questions.php';

  $_POST['question'] = 'Ile masz lat?';
  $_POST['answer_a'] = 'aaa';
  $_POST['answer_b'] = 'bbb';
  $_POST['answer_c'] = 'ccc';
  $_POST['answer_d'] = 'ddd';
  $_POST['correct_answer'] = 'ddd';
  $_POST['quiz_name'] = 'dddeeee';

  $dbConnect = new dbConnect();
  $pdo = $dbConnect->getConnection();

  $question = new Questions($pdo, 4);

  $data = $_POST;

  if(!empty($data['question'])) {
    $question->question = $data['question'];
    $question->answer_a = $data['answer_a'];
    $question->answer_b = $data['answer_b'];
    $question->answer_c = $data['answer_c'];
    $question->answer_d = $data['answer_d'];
    $question->correct_answer = $data['correct_answer'];
    $question->quiz_name = $data['quiz_name'];

    var_dump($question->question);
    var_dump($question->answer_a);
    var_dump($question->answer_b);
    var_dump($question->answer_c);
    var_dump($question->answer_d);
    var_dump($question->correct_answer);
    var_dump($question->quiz_name);

    if($question->create()) {
      http_response_code(201);
      echo ("Code 201 - success");
    } else {
      http_response_code(503);
      echo ("Code 503 - error");
    }
  } else {
    http_response_code(400);
    echo ("Code 400 - no data");
  }