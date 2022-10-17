<?php
include "Model.php";

class Product extends Model {
    protected $title;
    protected $description;
    protected $price;

    protected static $table_name = "Product";
    protected static $attributes = ["title", "description", "price"];
    protected static $allowed = ["title", "description", "price"];

}