<?php

trait Attribute  {
    public function attributesToString() {
        return implode(", ", Model::$attributes);
    }

    /* public function attributesFromString(string $string) {
        $this->attributes = explode(", ", $string);
    }  */
}