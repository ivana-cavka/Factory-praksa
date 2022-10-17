<?php

class DatabaseConnection {
    private static $servername = "localhost";
    private static $dbname = "first_project";
    private static $username = "root";
    private static $password = "";
    private $connection;
    private static $instance = null;

    private function __construct()
    {
      try {
        $this->connection = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }

    public function closeConnection() {
      $this->connection = null;
    }

    public static function getInstance() {
      if (self::$instance == null) {
        self::$instance = new DatabaseConnection();
      }
      return self::$instance;
    }

    public function getConnection(){
      return $this->connection;
    }

}