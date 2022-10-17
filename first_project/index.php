<?php 
include 'User.php';

$test = new User(); 
/* $test->attributes = ["first_name", "last_name", "email"];
$test->allowed = ["first_name", "last_name", "email"];
$test->table_name = "User";*/
/* $test->first_name = "Maja";
$test->last_name = "Odak";
$test->email = "mo23230@unist.hr";
$test->save(); */
/* $test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 7;
echo "main: " . $test->id; */
/* $test = $test->getById(28);
$test->delete(); */
$test1 = $test->getAll();
var_dump($test1);
?>