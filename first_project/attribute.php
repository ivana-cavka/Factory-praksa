<?php

trait Attribute  {
    public function attributesToString() {
        return implode(", ", $this->attributes);
    }

    public function attributesFromString(string $string) {
        $this->attributes = explode(", ", $string);
    }
}

?>