<?php
  class Quizzes {
    private $dbConnect;
    private $tableName = 'quizzes';

    public $id;
    public $name;

    public function __construct($database) {
      $this->dbConnect = $database;
    }

    function read() {
      $query = 'SELECT * FROM ' . $this->tableName;

      $statement = $this->dbConnect->prepare($query);
      $statement->execute();

      return $statement;
    }

    function create(){
      $query = $query = "INSERT INTO " . $this->tableName . " SET name=:name";
      
      $statement = $this->dbConnect->prepare($query);
      $statement->bindParam(":name", $this->name);
   
      if($statement->execute()) {
        return true;
      }

      return false;  
    }
  }
?>