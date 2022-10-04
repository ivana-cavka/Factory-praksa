<?php 
include 'user.php';

$test = new User(["first_name", "last_name", "email"], true, "User");
$test->id = 1;
//echo $test;
/* $test->table = "tbl2";
echo "<br>" . $test; */ 
$db = new DatabaseConnection();
$db->openConnection();
$result = $test->getById();
print_r($result);
//$db->closeConnection();
//$test->save();
?>