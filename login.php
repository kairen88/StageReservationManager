<?php


if(isset($_POST['username'])) 
{

$username=$_POST['username'];
$password=$_POST['password'];
if ($username=="admin" && $password=="admin")
{ echo "Successfully logged in.";
}
else 
{
echo "Incorrect username/password";
}
}





?>