<?php
namespace FirstProject\Model;
use Carbon\Carbon;
use FirstProject\DatabaseConnection\DatabaseConnection;

abstract class Model {
    use Attribute;
    use Timestamp;
    
    protected static $allowed;
    protected static $table_name; 
    protected $id;

    public function toArray() {
        return array($this->attributes, $this->allowed);
    }

    //$this->var;
    public function __get(string $name) {
        if($name)
            return $this->name;
        return $this;
    }//ako postoji varijabla, vrati varijablu, ili ne, ili da je $name string
    //solid princip -> ne treba kakav je name vec samo this->var, problem je sta ce vratit gresku ili null posto var ne postoji

    //$this->var = new_state;
    public function __set($name, $value) {
        $this->$name = $value;
    }//osugirat da se ne moze setat nesto sta ne postoji

    //echo $obj
    public function __toString() {
        return "\tattributes: " . $this->attributesToString(static::$attributes) . "\tallowed: " . $this->attributesToString(static::$allowed) . "\ttable_name: " . static::$table_name . "\tid: " . $this->id;
    }  

    //koristi se više za private i protected metode?
    public function __call($method, $args) {
        return call_user_func($method, $args);
    }//return method, args

    public static function __callStatic($method, $args) {
        return call_user_func($method, $args);
    }

    public function __isset($property) {
        return isset($this->$property);
    }

    public function __unset($property) {
        unset($this->$property);
    }

    //__wakeup() after you unserialize() the object - sesija se otvara, otvori konekciju s bazom
    public function __wakeup() {
        $db = DatabaseConnection::getInstance();
        //TO_DO: izvuci podatke?
    }

    //__sleep() is called when you serialize() an object - sesija gotova, konekcija s bazom se zatvara
    public function __sleep() {
        $db = DatabaseConnection::getInstance();
        $db->closeConnection();
        return $this->toArray();
    }

    public function save() {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $this->created_at = $this->updated_at = Carbon::now('Europe/Zagreb');
            $attributes_str = $values_str = "";
            foreach(static::$attributes as $attribute) {
                if($this->$attribute != null) {
                    $values_str .= $this->$attribute . "', '";
                    $attributes_str .= $attribute . ", ";
                }
            }
            $values_str = rtrim($values_str, ", '");
            $attributes_str = rtrim($attributes_str, ", ");
            $sql = "INSERT INTO " . static::$table_name . " (" . $attributes_str . ")" . " VALUES ('". $values_str ."');";
            $connection->exec($sql);
            $this->id = $connection->lastInsertId();
        } catch(\PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    } 

    public function forceDelete() {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $sql = "DELETE FROM " . static::$table_name . " WHERE id = '" . strval($this->id) . "';";
            $connection->exec($sql);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update() {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $this->updated_at = Carbon::now('Europe/Zagreb');
            $update_str = "";
            foreach(static::$attributes as $attribute) {
                if($this->$attribute != null) {
                    $update_str .= $attribute . " = '" . $this->$attribute . "', ";
                }
            }
            $update_str = rtrim($update_str, ", ");
            echo $update_str;
            $sql = "UPDATE " . static::$table_name . " SET " . $update_str . " WHERE id = " . strval($this->id) . ";";
            $connection->exec($sql);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete() {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $this->deleted_at = Carbon::now('Europe/Zagreb');
            $update_str = "";
            foreach(static::$attributes as $attribute) {
                if($this->$attribute != null) {
                    $update_str .= $attribute . " = '" . $this->$attribute . "', ";
                }
            }
            $update_str = rtrim($update_str, ", ");
            echo $update_str;
            $sql = "UPDATE " . static::$table_name . " SET " . $update_str . " WHERE id = " . strval($this->id) . ";";
            $connection->exec($sql);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAll() {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $sql = "SELECT * FROM " . static::$table_name . " WHERE deleted_at is NULL";
            $models = $connection->query($sql)->fetchAll(\PDO::FETCH_CLASS, "FirstProject\Model\\" . static::$table_name . "\\" . static::$table_name);
            return $models;
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    } 
   
    public function getById($id) {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $sql = "SELECT * FROM " . static::$table_name . " WHERE id = " . $id . " AND deleted_at is NULL";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(\PDO::FETCH_CLASS, "FirstProject\Model\\" . static::$table_name . "\\" . static::$table_name); 
            $result = $statement->fetch();
            return $result;
        } catch(\PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    } 

    public function getByProperty($name, $value) {
        $db = DatabaseConnection::getInstance();
        $connection = $db->getConnection();
        try {
            $sql = "SELECT * FROM " . static::$table_name . " WHERE ". $name ." = '". $value . "' AND deleted_at is NULL";
            $models = $connection->query($sql)->fetchAll(\PDO::FETCH_CLASS, "FirstProject\Model\\" . static::$table_name . "\\" . static::$table_name);
            return $models;
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }  
}