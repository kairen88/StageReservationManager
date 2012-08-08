<?php

$to="ksk.3393@gmail.com";
$subject = "Stage Reservation period Overwritten!\n";
	$body = "Hi,Recently your Stage Reservation period was overwritten for the duration ";


if(	mail($to, $subject, $body))
														echo "mail sent ";
													else
													    echo "error sending mail";



?>