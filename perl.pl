



#	Simple Email Function
 #	($to, $from, $subject, $message)
 sub sendEmail
 {
 	my ($to, $from, $subject, $message) = @_;
 	my $sendmail = '/usr/lib/sendmail';
 	open(MAIL, "|$sendmail -oi -t");
 		print MAIL "From: $from\n";
 		print MAIL "To: $to\n";
 		print MAIL "Subject: $subject\n\n";
 		print MAIL "$message\n";
 	close(MAIL);
 } 

 sendEmail("kairen09@gmail.com", "kaiteo@paypal.com", "Simple email.", "This is a test of the email function."); 