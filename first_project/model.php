<?php 
include "attribute.php";
include "db.php";

abstract class Model {
    use Attribute;

    private $attributes = []; 
    private $allowed;
    private $table;
    private $id;

    public function __construct($attributes = null, $allowed = false, $table = null) {
        $this->attributes = $attributes;
        $this->allowed = $allowed;
        $this->table = $table;
    }

    public function toArray() {
        return array($this->attributes, $this->allowed);
    }

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

    //echo $obj
    public function __toString() {
        return "\tattributes: " . $this->attributesToString($this->attributes) . "\tallowed: " . $this->allowed . "\ttable: " . $this->table;
    }

    //koristi se više za private i protected metode?
    public function __call($method, $args) {
        if ( !method_exists( $this, $method ) ) throw new Error("This method does not exist in this class.");
    }

    public function __isset($property) {
        return isset($this->$property);
    }

    public function __unset($property) {
        unset($this->$property);
    }

    //__wakeup() after you unserialize() the object - sesija se otvara, otvori konekciju s bazom
    public function __wakeup() {
        $db = new DatabaseConnection;
        $db->openConnection();
        //TO_DO: izvuci podatke?
    }

    //__sleep() is called when you serialize() an object - sesija gotova, konekcija s bazom se zatvara
    public function __sleep() {
        global $db;
        $db->closeConnection();
        return $this->toArray();
    }

    public function save() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO model (attributes, allowed, table_name) 
            VALUES ('". $this->attributesToString($this->attributes) ."', ". $this->allowed .", '". $this->table ."');";
            $db->connection->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getAll() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO model (attributes, allowed, table_name) 
            VALUES ('". $this->attributesToString($this->attributes) ."', ". $this->allowed .", '". $this->table ."');";
            $db->connection->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getById() {
        global $db;
        try {
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $db->connection->query("SELECT * FROM model WHERE id = '$this->id';");
            return $result->fetchAll();
        } catch(PDOException $e) {
            echo $result . "<br>" . $e->getMessage();
        }
    }

    public function getByProperty($name, $value) {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $db->connection->prepare("SELECT * FROM model WHERE ". $name ." = ". $value);
            $sql->execute();
            return $sql->fetchColumn();
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function delete() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM model WHERE id =". $this->id .";";
            $db->connection->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
?>