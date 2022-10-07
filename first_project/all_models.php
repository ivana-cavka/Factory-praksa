<?php
include "model.php";

class User extends Model {
    private $first_name;
    private $last_name;
    private $email;
}

class Product extends Model {
    private $title;
    private $description;
    private $price;
 
    //$this->var;
    public function __get($name) {
        if($name == null)
            return $this;
        return $this->$name;
    }

    //$this->var = new_state;
    public function __set($name, $value) {
        $this->$name = $value;
    } 

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