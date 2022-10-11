<?php
include "model.php";

class User extends Model {
    private $first_name;
    private $last_name;
    private $email;

    public function __construct($attributes = null, $allowed = false, $table = null, $first_name = null, $last_name = false, $email = null) {
        parent::__construct($attributes = null, $allowed = false, $table = null);
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    public function save() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO " . get_class($this) . " (first_name, last_name, email) 
            VALUES ('". $this->first_name ."', '". $this->last_name ."', '". $this->email ."');";
            $db->connection->exec($sql);
            $this->id = $db->connection->lastInsertId();
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

class Product extends Model {
    protected $title;
    protected $description;
    protected $price;

    public function save() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO " . get_class($this) . " (title, description, price) 
            VALUES ('". $this->title ."', '". $this->description ."', '". $this->price ."');";
            $db->connection->exec($sql);
            $this->id = $db->connection->lastInsertId();
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

?>