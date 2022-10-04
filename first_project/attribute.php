<?php

trait Attribute  {
    public function attributesToString(array $array) {
        return implode(", ", $array);
    }
}

?>