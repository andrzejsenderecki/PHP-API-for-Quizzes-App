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
  }
?>