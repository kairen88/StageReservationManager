<?php
//===============Server Configuration============
$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a4670404_ppstage";
$mysql_user = "a4670404_kairen";
$mysql_password = "password123";
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