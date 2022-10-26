<?php 
namespace FirstProject\Model;

trait Timestamp  {

    protected $created_at;
    protected $updated_at;
    protected $deleted_at;
    // sve varijable + get set

    public function __get(string $name) {
        if($name)
            return $this->name;
        return $this;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function isDeleted() {
        return $this->deleted_at == null;
    }
}