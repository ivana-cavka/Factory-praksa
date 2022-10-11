<?php
interface modelInterface {
    public function __construct($attributes = null, $allowed = false, $table = null);
    public function toArray();
    public function __get($name);
    public function __set($name, $value);
    public function __toString();
    public function __call($method, $args);
    public function __isset($property);
    public function __unset($property);
    public function __wakeup();
    public function __sleep();
    public function getById($id);
    public function getByProperty($name, $value);
    public function delete();
    public function save();
}
?>