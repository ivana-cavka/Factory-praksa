<?php 
require_once 'vendor\autoload.php';

$test = new FirstProject\Model\User\User(); 
//$test = $test->getByProperty("first_name","Maja");
/* $test->first_name = "Ivana";
$test->last_name = "Čavka";
$test->email = "ic47470@unist.hr";
$test->save(); */
/* $test->title = "laptop";
$test->description = "lenovo";
$test->price = 5000;
$test->id = 7;
echo "main: " . $test->id; */
/* $test->email = "ic47480@unist.hr";
$test->update();
$test->delete(); */
$test = $test->getAll();
var_dump($test);
//$test->delete();
?>