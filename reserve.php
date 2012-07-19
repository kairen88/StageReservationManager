<?php
//===============Server Configuration============
$mysql_host = "localhost.zymic.com";
$mysql_database = "saran93_zxq_ppstage";
$mysql_user = "760379_ppuser";
$mysql_password = "password123";
//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


//=============Starting Registration Script==========
 
$date_reserved_from   =    $_POST['dateFrom'];
$date_reserved_to  =    $_POST['dateTo'];
$stage_name =    $_POST['stageName'];
$spec_id   =    $_POST['specId'];
$spec_name  =    $_POST['specName'];
 
if(isset($_POST['btnRegister'])) 
{
					$q1= " SELECT * FROM stageReservation 
					WHERE stage_name='$stage_name' AND (date_reserved_from='$date_reserved_from' AND date_reserved_to='$date_reserved_to')";
					$res    =    mysql_query($q1);
					$num= mysql_num_rows($res);
					if($num>0)
					{
									$i=0;
									while($row = mysql_fetch_array($res))
									{
												$r_id=$row['reservation_id'];
												$s_id=$row['spec_id'];
												echo $s_id;
												echo " \n Stage to be deleted: $r_id \n " ;
												$q2=" DELETE FROM stageReservation WHERE reservation_id='$r_id'";
												$res2    =   mysql_query($q2);
												if($res2)
												{
												
													$q3=" SELECT spec_lead_email,dtl_email FROM spec WHERE spec_id='$s_id'";
													$res3= mysql_query($q3);
													$row3 = mysql_fetch_array($res3);
													$s_email=$row3['spec_lead_email'];
													$d_email=$row3['dtl_email'];
													echo $s_email;
													echo $d_email;
													$to = $s_mail;
													 $subject = "Hi!";
													 $body = "Hi,\n\nHow are you?";
													 if (mail($to, $subject, $body)) {
													   echo("<p>Message successfully sent!</p>");
													  } else {
													   echo("<p>Message delivery failed...</p>");
													  }
													
													
														echo "Deleted $i row\n" ;
														$i++;
												}

									}
					}



					$query    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name)
										   VALUES(DATE(NOW()),'$date_reserved_from','$date_reserved_to','$stage_name','$spec_id','$spec_name')";
					$res    =    mysql_query($query);
					if($res)
					{
						echo "Stage registered successfully.<br />";
						echo "<a href=\"display.php\">Click here to proceed</a>"; 
					}

}
 
?>