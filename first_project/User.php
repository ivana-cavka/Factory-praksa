<?php
include "Model.php";

class User extends Model {
    protected $first_name;
    protected $last_name;
    protected $email;

    protected static $table_name = "User";
    protected static $attributes = ["first_name", "last_name", "email", "created_at", "updated_at", "deleted_at"];
    protected static $allowed = ["first_name", "email"];

}