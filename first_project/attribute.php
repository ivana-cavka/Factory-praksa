<?php

trait Attribute  {
    public function attributesToString() {
        return implode(", ", User::$attributes);
    }

    /* public function attributesFromString(string $string) {
        $this->attributes = explode(", ", $string);
    }  */
}