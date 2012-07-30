<?php

include 'config.php';

//===============Server Configuration============
/* $mysql_host = "localhost.zymic.com";
$mysql_database = "saran93_zxq_ppstage";
$mysql_user = "760379_ppuser";
$mysql_password = "password123"; */
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


//=============Starting Registration Script==========
 

$name =    $_POST['name'];
$url  =    $_POST['url'];

 
 
if(isset($_POST['btnStage'])) 
{
$query    =    "INSERT INTO stage(name,stage_id,url)
					   VALUES('$name','$stage_id','$url')";
$res    =    mysql_query($query);
if($res)
{
echo "Stage added successfully.<br />";
echo "<a href=\"form.html\">Click here to proceed</a>"; 
}

}
 
?>