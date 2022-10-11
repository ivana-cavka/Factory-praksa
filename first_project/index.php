<?php 
include 'all_models.php';

//$test = new User(["first_name", "last_name", "email"], true, "User", "Ivana", "Čavka", "ic47480@unist.hr"); //id=1
$test = new User();
$db = new DatabaseConnection();
$db->openConnection();
$test->save();
/* $test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 7;
echo "main: " . $test->id; */
$test = $test->getById(1);
//echo $test->table_name;
//var_dump($test->getByProperty('title', 'laptop'));
$db->closeConnection();
?>