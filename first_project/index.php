<?php 
include 'User.php';

$test = new User(); 
$test->first_name = "Maja";
$test->last_name = "Odak";
$test->email = "mo27230@unist.hr";
$test->Timestamp->save(); 
/* $test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 7;
echo "main: " . $test->id; */
/* $test = $test->getById(28);
$test->delete(); */
$test1 = $test->getAll();
//Svar_dump($test1);
?>