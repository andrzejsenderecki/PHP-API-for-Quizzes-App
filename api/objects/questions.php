<?php
  class Questions {
    private $pdo;
    private $tableName = 'questions';
    private $hej = 'quizzes';
    private $idParam;

    public $question;
    public $answer_a;
    public $answer_b;
    public $answer_c;
    public $answer_d;
    public $correct_answer;
    public $quiz_name;
    
    public function __construct($pdo, $idParam) {
      $this->pdo = $pdo;
      $this->idParam = $idParam;
    }

    function read() {
      $query = 'SELECT * FROM ' . $this->hej . ' LEFT JOIN ' . $this->tableName . ' ON quizzes.name = questions.quiz_name WHERE quizzes.id = ' . $this->idParam;
      
      $stmt = $this->pdo->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    function create() {
      $query = "INSERT INTO " . $this->tableName . " (`question`,`answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `quiz_name`) VALUES (:question,:answer_a,:answer_b,:answer_c,:answer_d,:correct_answer,:quiz_name)";

      $stmt = $this->pdo->prepare($query);
      $stmt->bindParam(":question", $this->question);
      $stmt->bindParam(":answer_a", $this->answer_a);
      $stmt->bindParam(":answer_b", $this->answer_b);
      $stmt->bindParam(":answer_c", $this->answer_c);
      $stmt->bindParam(":answer_d", $this->answer_d);
      $stmt->bindParam(":correct_answer", $this->correct_answer);
      $stmt->bindParam(":quiz_name", $this->quiz_name);
      
      if($stmt->execute()) {
        return true;
      }

      return false;
    }
  }