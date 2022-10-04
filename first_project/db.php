<?php

class DatabaseConnection {
    private $servername = "localhost";
    private $dbname = "first_project";
    private $username = "root";
    private $password = "";
    private $connection;

    public function openConnection() {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

    public function closeConnection() {
       $this->connection = null;
    }

    public function __get($name) {
      if($name == null)
          return $this;
      return $this->$name;
    }

    public function __set($name, $value) {
      $this->$name = $value;
    }
}

?>