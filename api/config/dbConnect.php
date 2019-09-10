<?php
  class dbConnect {
    private $host = 'localhost';
    private $dbName = '31294380_quizzes_db';
    private $userName = 'root';
    private $password = '';
    public $connect;
    
    public function getConnection() {
      try {
        $this->connect = new PDO(
          'mysql:host=' . $this->host . '; dbname=' . $this->dbName,
          $this->userName, $this->password
        );
        
        $this->connect->exec('set names utf8');
      } catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
      }

      return $this->connect;
    }
  }
?>