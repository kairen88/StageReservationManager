<?php
include 'config.php';
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


//=============Starting Registration Script==========
 

$name =    $_POST['stage_name'];
$url  =    $_POST['url'];

 
 
if(isset($_POST['stage_name'])) 
{
$query    =    "INSERT INTO stage(name,url)
					   VALUES('$name','$url')";
$res    =    mysql_query($query);
if($res)
{
echo "Stage added successfully.";
}

}
 
?>
