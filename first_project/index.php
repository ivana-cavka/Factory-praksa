<?php 
include 'user.php';

//$test = new User(["first_name", "last_name", "email"], true, "User"); //id=1
$test = new User(["username", "email", "password"], true, "Admin"); //id=2
$test->id = 3;
//echo $test;
/* $test->table = "tbl2";
echo "<br>" . $test; */ 
$db = new DatabaseConnection();
$db->openConnection();
$result = $test->delete();
//echo $result;
//$db->closeConnection();
//$test->save();
?>