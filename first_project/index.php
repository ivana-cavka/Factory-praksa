<?php 
include 'models.php';

$test = new Model("att1, att2, att3", true, "tbl1");
echo $test;
$test->table = "tbl2";
echo "<br>" . $test;

?>