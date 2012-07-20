<?php
//===============Server Configuration============
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a4670404_ppstage";
$mysql_user = "a4670404_kairen";
$mysql_password = "password123";
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


$q= "SELECT name FROM stage ";
$res    =    mysql_query($q); 
$table = array();

while($row = mysql_fetch_array($res)){
	array_push($table, $row);
}
echo json_encode($table); 

?>