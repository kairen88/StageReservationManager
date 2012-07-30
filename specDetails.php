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
 
$spec_id=    $_POST['spec_id'];
$spec_name =    $_POST['spec_name'];
$spec_lead_email  =    $_POST['spec_lead_email'];
$DTL_email  =    $_POST['DTL_email'];

echo $spec_id;

echo $spec_name ;

echo $spec_lead_email;

echo $DTL_email ;

 
if(isset($_POST['btnSpec'])) 
{
$query    =    "INSERT INTO spec(spec_id,spec_name,spec_lead_email,dtl_email)
					   VALUES('$spec_id','$spec_name','$spec_lead_email','$DTL_email')";
$res    =    mysql_query($query);
if($res)
{
echo "Spec was added successfully.<br />";
echo "<a href=\"index.html\">Click here to proceed</a>"; 
}

}
 
?>