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

    public function saveModel() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //spremanje novog modela u bazu, u tablicu Model
            $sql = "INSERT INTO model (attributes, allowed, table_name) 
            VALUES ('". $this->attributesToString($this->attributes) ."', ". $this->allowed .", '". $this->table_name ."');";
            $db->connection->exec($sql);
            $this->id = $db->connection->lastInsertId();
            //stvaranje nove tablice po modelu (ako ne postoji)
            $attribute_columns = implode(" TEXT, ", $this->attributes);
            $attribute_columns = "id int NOT NULL AUTO_INCREMENT PRIMARY KEY," . $attribute_columns . " TEXT";
            var_dump($attribute_columns);
            $db->connection->query("CREATE TABLE IF NOT EXISTS " . $this->table_name . " (" . $attribute_columns .  ")");
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    } //RADI

    public function delete() {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'DELETE FROM ' . get_class($this) . ' WHERE id = :id';
            $statement = $db->connection->prepare($sql);
            echo $this->id; //ništa, iako je u mainu dodana vrijednost
            $statement->bindParam(':id', $this->id);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    } //RADI ZA HARDKODIRANE VRIJEDNOSTI (npr 2), ALI NE I ZA VARIJABILNE ($this->id)

    public function getAll() {
        global $db;
        try {
            //set the PDO error mode to exception <----- treba li uvijek?
            //$db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $models = $db->connection->query('SELECT * FROM ' . get_class($this))->fetchAll(PDO::FETCH_CLASS, get_class($this));
            return $models;
        } catch(PDOException $e) {
            echo $models . "<br>" . $e->getMessage();
        }
    } //RADI
   
    public function getById($id) {
        global $db;
        try {
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT *
                    FROM model
                    WHERE id = ?';
            $statement = $db->connection->prepare($sql);
            $statement->execute([$id]);
            $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
            $model = $statement->fetch();
            return $model;
        } catch(PDOException $e) {
            echo $model . "<br>" . $e->getMessage();
        }
    }  //NE RADI
    //OUTPUT: false -> ne pronalazi?

    public function getByProperty($name, $value) {
        global $db;
        try {
            // set the PDO error mode to exception
            $db->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $db->connection->prepare("SELECT * FROM model WHERE '". $name ."' = '". $value . "'");
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
            $model = $statement->fetch();
            return $model;
        } catch(PDOException $e) {
            echo $model . "<br>" . $e->getMessage();
        }
    }  //NE RADI
    //OUTPUT: false -> ne pronalazi?
}
?>