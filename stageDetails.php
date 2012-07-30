<?php
//===============Server Configuration============
$mysql_host = "10.238.85.62:3306/";
$mysql_database = "stage_rm";
$mysql_user = "mpais";
$mysql_password = "mpais123";
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
