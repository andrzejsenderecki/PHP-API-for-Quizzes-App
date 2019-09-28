<?php
  class Quizzes {
    private $pdo;
    private $tableName = 'quizzes';

    public $id;
    public $name;

    public function __construct($pdo) {
      $this->pdo = $pdo;
    }

    function read() {
      $query = 'SELECT * FROM ' . $this->tableName;

      $stmt = $this->pdo->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    function create(){
      $query = "INSERT INTO " . $this->tableName . " SET name=:name";
      
      $stmt = $this->pdo->prepare($query);
      $stmt->bindParam(":name", $this->name);
   
      if($stmt->execute()) {
        return true;
      }

      return false;  
    }
  }
?>