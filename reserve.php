<?php
//===============Server Configuration============
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a4670404_ppstage";
$mysql_user = "a4670404_kairen";
$mysql_password = "password123";
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');
echo " conn success" ;

//=============Starting Registration Script==========
 
$date_reserved    =    $_POST['dateReserved'];
$date_reserved_from   =    $_POST['dateFrom'];
$date_reserved_to  =    $_POST['dateTo'];
$stage_id  =    $_POST['stageId'];
$spec_id   =    $_POST['specId'];
$spec_name  =    $_POST['specName'];
$reservation_id=   $_POST['reservationId'];

echo " post success" ;

echo $date_reserved;
echo $date_reserved_from ;
echo $date_reserved_to;
echo $stage_id;
echo $spec_id ;
echo $spec_name;


 
 
if(isset($_POST['btnRegister'])) //===When I will Set the Button to 1 or Press Button to register
{
echo " if success" ;
$q= " COUNT * FROM stageReservation";
//$reservation_id=   mysql_query($q)+1;
$query    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_id,spec_id,spec_name,reservation_id)
					   VALUES('$date_reserved','$date_reserved_from','$date_reserved_to','$stage_id','$spec_id','$spec_name','$reservation_id')";
$res    =    mysql_query($query);
//header('location:success_reserve.php');
}
 
?>