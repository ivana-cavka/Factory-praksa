<?php
include "Model.php";

class Product extends Model {
    protected $title;
    protected $description;
    protected $price;

    protected static $table_name = "Product";
    protected static $attributes = ["title", "description", "price", "created_at", "updated_at", "deleted_at"];
    protected static $allowed = ["title", "description", "price"];

}