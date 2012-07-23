<?php

$a="saran@gmail.com";
$b="kumar@yahoo.com";
$c="krishnasamy@hotmail.com";

$to  = $a . ', '.$b. ', '.$c; 
	echo $to;
echo"<br />";

echo "Line1";
echo"<br />";
echo "Line2";

// set your date here
$mydate = "2012-01-17";
echo"<br />";
/* strtotime accepts two parameters.
The first parameter tells what it should compute.
The second parameter defines what source date it should use. */
$new_date = strtotime("+1 day", strtotime($mydate));

// format and display the computed date
echo date("Y-m-d", $new_date);


?>