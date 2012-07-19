<?php
//===============Server Configuration============
$mysql_host = "localhost.zymic.com";
$mysql_database = "saran93_zxq_ppstage";
$mysql_user = "760379_ppuser";
$mysql_password = "password123";
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


//=============Starting Registration Script==========
 
$date_reserved_from   =    $_POST['dateFrom'];
$date_reserved_to  =    $_POST['dateTo'];
$stage_name =    $_POST['stageName'];
$spec_id   =    $_POST['specId'];
$spec_name  =    $_POST['specName'];

 
 
if(isset($_POST['btnRegister'])) 
{
$query    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name)
					   VALUES(DATE(NOW()),'$date_reserved_from','$date_reserved_to','$stage_name','$spec_id','$spec_name')";
$res    =    mysql_query($query);
if($res)
{
echo "Stage registered successfully.<br />";
echo "<a href=\"display.php\">Click here to proceed</a>"; 
}

}
 
?>