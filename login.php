<?php
$username=$_POST['username'];
$password=$_POST['password'];
if ($username=="admin" && $password="admin")
{ echo "Please click <a href=\"adminpage.html\">here</a> to proceed";
}
else 
{
echo "Sorry ! You do not have permission to access the admin area";
echo "<br />Click <a href=\"index.html\"> here </a> to go back to main page";
}

?>