<?php 
include 'all_models.php';

//$test = new User(["first_name", "last_name", "email"], true, "User"); //id=1
$test = new Product();
$db = new DatabaseConnection();
$db->openConnection();
$test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 2;
echo $test->id;
$test->delete();
//var_dump($test->getByProperty('title', 'laptop'));
$db->closeConnection();
?>