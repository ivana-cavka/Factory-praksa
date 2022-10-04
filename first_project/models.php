<?php 

class Attribute {
    private $title;

    public function __construct($title = null) {
        $this->title = $title;
    }

    public function __get($name) {
        return $this;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

class Model {
    private $attributes; //one to many na class Attribute?
    private $allowed;
    private $table;

    public function __construct($attributes = null, $allowed = false, $table = null) {
        $this->attributes = $attributes;
        $this->allowed = $allowed;
        $this->table = $table;
    }

    public function toArray() {
        return array($this->attributes, $this->allowed);
    }

    public function __get($name) {
        return $this;
    }

    //može li se više varijabli unit?
    public function __set($name, $value) {
        $this->$name = $value;
    }

    //echo $obj
    public function __toString() {
        return "\tattributes: " . $this->attributes . "\tallowed: " . $this->allowed . "\ttable: " . $this->table;
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
        //TO_DO: otvori konekciju s bazom
        //TO_DO: izvuci podatke?
    }

    //__sleep() is called when you serialize() an object - sesija gotova, konekcija s bazom se zatvara
    public function __sleep() {
        //TO_DO: zatvori konekciju s bazom
        return $this->toArray();
    }
}
?>