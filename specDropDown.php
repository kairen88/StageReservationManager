<?php
include 'config.php';
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


$q= "SELECT * FROM spec ";
$res    =    mysql_query($q); 
$table = array();

while($row = mysql_fetch_array($res)){
	array_push($table, $row);
}
echo json_encode($table); 

?>