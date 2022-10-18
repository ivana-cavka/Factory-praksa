<?php 
include 'User.php';

$test = new User(); 
//$test = $test->getByProperty("first_name","Maja");
$test->first_name = "Mirko";
$test->last_name = "Odak";
$test->email = "mo52460@unist.hr";
$test->saveWithTimestamp();
/* $test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 7;
echo "main: " . $test->id; */
$test = $test->getAll();
var_dump($test);
//$test->delete();
?>