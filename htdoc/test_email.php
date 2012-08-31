
<?php  
/* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */   
 
//This will send an email using auth smtp and output a log array  
//logArray - connection,   
 
function authSendEmail($from, $to,$subject, $message)  
{  
//SMTP + SERVER DETAILS  
/* * * * CONFIGURATION START * * * */ 
$smtpServer = "mail.corp.ebay.com";  
$port = "25";  
$timeout = "30";  
$username = "skrishnasamy@paypal.com";  
$password = "test";  
$localhost = "mail.corp.ebay.com";  
$newLine = "\r\n";  
/* * * * CONFIGURATION END * * * * */ 
 
//Connect to the host on the specified port  
$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);  
$smtpResponse = fgets($smtpConnect, 515);  
if(empty($smtpConnect))   
{  
$output = "Failed to connect: $smtpResponse";  
return $output;  
}  
else 
{  
$logArray['connection'] = "Connected: $smtpResponse";  
}  
 
//Request Auth Login  
fputs($smtpConnect,"AUTH LOGIN" . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['authrequest'] = "$smtpResponse";  
 
//Send username  
fputs($smtpConnect, base64_encode($username) . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['authusername'] = "$smtpResponse";  
 
//Send password  
fputs($smtpConnect, base64_encode($password) . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['authpassword'] = "$smtpResponse";  
 
//Say Hello to SMTP  
fputs($smtpConnect, "HELO $localhost" . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['heloresponse'] = "$smtpResponse";  
 
//Email From  
fputs($smtpConnect, "MAIL FROM: $from" . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['mailfromresponse'] = "$smtpResponse";  
 
//Email To  
fputs($smtpConnect, "RCPT TO: $to" . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['mailtoresponse'] = "$smtpResponse";  
 
//The Email  
fputs($smtpConnect, "DATA" . $newLine);  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['data1response'] = "$smtpResponse";  
 
//Construct Headers  
$headers = "MIME-Version: 1.0" . $newLine;  
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  
//$headers .= "Cc:<$to>" . $newLine;  
//$headers .= "To:<$to>" . $newLine;  
//$headers .= "From:<$from>" . $newLine;  
 
fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");  
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['data2response'] = "$smtpResponse";  
 
// Say Bye to SMTP  
fputs($smtpConnect,"QUIT" . $newLine);   
$smtpResponse = fgets($smtpConnect, 515);  
$logArray['quitresponse'] = "$smtpResponse";   

//insert var_dump here -- uncomment out the next line for debug info
//var_dump($logArray);
}  
?>  
 