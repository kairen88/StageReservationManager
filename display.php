<?php
//===============Server Configuration============
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a4670404_ppstage";
$mysql_user = "a4670404_kairen";
$mysql_password = "password123";
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


$q= "SELECT * FROM stageReservation ";
$res    =    mysql_query($q); 
$table = array();

while($row = mysql_fetch_array($res)){

	//echo $row['stage_name']."   ".$row['date_reserved']."   ". $row['date_reserved_from']."   ".$row['date_reserved_to']."   ".$row['spec_id']."   ".$row['spec_name'];
	//echo "<br /><br />";
	array_push($table, $row);
	//echo json_encode($row); 
}
echo json_encode($table); 

?>