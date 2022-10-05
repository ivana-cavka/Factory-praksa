<?php 
include "attribute.php";
include "db.php";

abstract class Model {
    use Attribute;

    private $attributes; 
    private $allowed;
    private $table_name;
    private $id;

    public function __construct($attributes = null, $allowed = false, $table = null) {
        $this->attributes = $attributes;
        $this->allowed = $allowed;
        $this->table_name = $table;
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
        return "\tattributes: " . $this->attributesToString($this->attributes) . "\tallowed: " . $this->allowed . "\ttable_name: " . $this->table_name . "\tid: " . $this->id;
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
            VALUES ('". $this->attributesToString($this->attributes) ."', ". $this->allowed .", '". $this->table_name ."');";
            $db->connection->exec($sql);
            $this->id = $db->connection->lastInsertId();
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    } //RADI

    public function getAll() {
        global $db;
        try {
            // set the PDO error mode to exception <----- treba li uvijek?
            //$db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $models = $db->connection->query('SELECT * FROM model')->fetchAll(PDO::FETCH_CLASS, get_class($this));
            var_dump($models);
            return $models;
        } catch(PDOException $e) {
            echo $models . "<br>" . $e->getMessage();
        }
    } //NE RADI
    //OUTPUT: array(1) { [0]=> object(User)#5 (4) { ["attributes":"Model":private]=> NULL ["allowed":"Model":private]=> bool(false) ["table_name":"Model":private]=> NULL ["id":"Model":private]=> string(1) "1" } }

    public function getById($id) {
        global $db;
        try {
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT attributes, allowed, table_name, id
                    FROM model
                    WHERE id = :id';
            $statement = $db->connection->prepare($sql);
            $statement->execute([':id' => $id]);
            $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
            $model = $statement->fetch();
            echo $model->attributes;
            //$attribute_array = $model->attributesFromString($model->attributes);
            //$model->attributes=$attribute_array;
            var_dump($model);
        } catch(PDOException $e) {
            echo $model . "<br>" . $e->getMessage();
        }
    }  //NE RADI
    //OUTPUT: object(User)#5 (4) { ["attributes":"Model":private]=> NULL ["allowed":"Model":private]=> bool(false) ["table_name":"Model":private]=> NULL ["id":"Model":private]=> string(1) "1" }

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
    }  //NE RADI

    public function delete() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$db->connection->query('DELETE FROM model WHERE id = '. $this->id);
            $sql = 'DELETE FROM model WHERE id = :id';
            $statement = $db->connection->prepare($sql);
            $statement->execute([':id' => $this->id]);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    } //RADI
}
?>