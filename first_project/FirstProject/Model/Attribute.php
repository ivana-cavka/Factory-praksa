<?php
namespace FirstProject\Model;

trait Attribute  {

    protected static $attributes; 

    public function __get(string $name) {
        if($name)
            return $this->name;
        return $this;
    }

    public function attributesToString() {
        return implode(", ", User::$attributes);
    }

    /* public function attributesFromString(string $string) {
        $this->attributes = explode(", ", $string);
    }  */
}