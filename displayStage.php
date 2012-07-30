<?php
//===============Server Configuration============
$mysql_host = "10.238.85.62:3306/";
$mysql_database = "stage_rm";
$mysql_user = "mpais";
$mysql_password = "mpais123";
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
