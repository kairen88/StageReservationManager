<?php

include 'config.php';

//===============Server Configuration============
// $mysql_host = "mysql4.000webhost.com";
// $mysql_database = "a4670404_ppstage";
// $mysql_user = "a4670404_kairen";
// $mysql_password = "password123";

/* $mysql_host = "localhost";
$mysql_database = "saran93_zxq_ppstage";
$mysql_user = "760379_ppuser";
$mysql_password = "password123"; */

//Establish Connection with Server
$conn        =    mysql_connect($mysql_host,$mysql_user,$mysql_password) or die('Server Information is not Correct'); 
mysql_select_db($mysql_database,$conn) or die('Database Information is not correct');


//=============Starting Registration Script==========
 
$date_reserved_from   =    $_POST['dateFrom'];
$date_reserved_to  =    $_POST['dateTo'];
$stage_name =    $_POST['stageName'];
$spec_id   =    $_POST['specId'];
$spec_name  =    $_POST['specName'];
if(isset($_POST['stageName'])) 
{
					$q1= " SELECT * FROM stageReservation 
					WHERE stage_name='$stage_name' AND status='R'
												   AND(
															(date_reserved_from>='$date_reserved_from' AND date_reserved_to<='$date_reserved_to')
													   OR   (date_reserved_from>='$date_reserved_from' AND date_reserved_to>='$date_reserved_to') 
													   OR    (date_reserved_from<='$date_reserved_from' AND date_reserved_to<='$date_reserved_to')
													   OR    (date_reserved_from<'$date_reserved_from' AND date_reserved_to>'$date_reserved_to')
													)
													";
					$res    =    mysql_query($q1);
					$num= mysql_num_rows($res);
					if($num>0)
					{
									//$i=1;
									while($row = mysql_fetch_array($res))
									{
												$r_id=$row['reservation_id'];
												$s_id=$row['spec_id'];
												$old_from=$row['date_reserved_from'];
												$old_to=$row['date_reserved_to'];
											
												
												$from_date=$date_reserved_from;
												$to_date=$date_reserved_to;
												
												if ($old_from<$date_reserved_from && $old_to>$date_reserved_to )
												{
																$from_date=$date_reserved_from;
																$to_date=$date_reserved_to;
																
																$new_date=date("Y-m-d",strtotime("-1 day", strtotime($date_reserved_from )));
																echo "<br/>";
																echo "NEW DATE : $new_date";
																$querynew1    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																					VALUES(DATE(NOW()),'$old_from','$new_date','$stage_name','$spec_id','$spec_name','R')";
																$resnew1    =    mysql_query($querynew1);
																if($resnew1)
																{
																	echo "<br />";
																	echo "Case1.1 executed successfully.<br />";
																	echo "<br />";
																}
																
																$new_date=date("Y-m-d", strtotime("+1 day", strtotime($date_reserved_to)));
																echo "<br/>";
																echo "NEW DATE : $new_date";
																$querynew2    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																					VALUES(DATE(NOW()),'$new_date','$old_to','$stage_name','$spec_id','$spec_name','R')";
																$resnew2    =    mysql_query($querynew2);
																if($resnew2)
																{
																	echo "<br />";
																	echo "Case1.2 executed successfully.<br />";
																	echo "<br />";
																}
																
											    
												
												}
												else if($old_from>=$date_reserved_from && $old_to<=$date_reserved_to ) 
												{
														 $from_date=$old_from;
														 $to_date=$old_to;
												}

												else if ($old_from>=$date_reserved_from && $old_to>=$date_reserved_to )
												{
																	$from_date=$old_from;
																	$new_date=date("Y-m-d", strtotime("+1 day", strtotime($date_reserved_to)));
																	$querynew3    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																					VALUES(DATE(NOW()),'$new_date','$old_to','$stage_name','$spec_id','$spec_name','R')";
																$resnew3    =    mysql_query($querynew3);
																if($resnew3)
																{
																	echo "<br />";
																	echo "Case3 executed successfully.<br />";
																	echo "<br />";
																}
													
												}
												else if ($old_from<=$date_reserved_from && $old_to<=$date_reserved_to )
												{
												
																$to_date=$old_to;
															$new_date=date("Y-m-d", strtotime("-1 day", strtotime($date_reserved_from )));	
															$querynew4    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																				VALUES(DATE(NOW()),'$old_from','$new_date','$stage_name','$spec_id','$spec_name','R')";
															$resnew4    =    mysql_query($querynew4);
															if($resnew4)
															{
																echo "<br />";
																echo "Case4 executed successfully.<br />";
																echo "<br />";
															}
													
												}
												
												$query_old = "UPDATE stageReservation SET status='O' WHERE reservation_id='$r_id'";
												$res_old    =    mysql_query($query_old);
															if($res_old)
															{
																echo "<br />";
																echo "Status updated to O successfully.<br />";
																echo "<br />";
															}
												
												// echo $s_id;
												// echo "<br />";
												// echo "  Stage to be deleted: \n $r_id  " ;
												// echo "<br />";
												//$q2=" DELETE FROM stageReservation WHERE reservation_id='$r_id'";
												//$res2    =   mysql_query($q2);
												//if($res2)
												//{
												
													$q3=" SELECT spec_lead_email,dtl_email FROM spec WHERE spec_id='$s_id'";
													$res3= mysql_query($q3);
													$row3 = mysql_fetch_array($res3);
													$s_email=$row3['spec_lead_email'];
													$d_email=$row3['dtl_email'];
													
													$q3=" SELECT spec_lead_email,dtl_email FROM spec WHERE spec_id='$spec_id'";
													$res3= mysql_query($q3);
													$row3 = mysql_fetch_array($res3);
													$new_s_email=$row3['spec_lead_email'];
													$new_d_email=$row3['dtl_email'];
													
													
													
													// echo $s_email;
													// echo $d_email;
													$to  = $s_email . ', '.$d_email . ', '.$new_s_email. ', '.$new_d_email; 
													$subject = "Stage Reservation period Overwritten!";
													$body = "Hi,Recently your Stage Reservation period was overwritten for the duration 
																$from_date to $to_date by $spec_name";
													//mail($to, $subject, $body);
													 echo "Receipients : $to";
													 echo "<br/>";
													 echo "Subject : $subject ";
													 echo "<br/>";
													 echo "Message : $body ";
													 echo "<br />";
													
													
														//echo "Deleted $i row\n" ;
														//$i++;
												//}

									}
					}
					// $q4=" SELECT * FROM stageReservation 
					// WHERE stage_name='$stage_name' AND (date_reserved_from='$date_reserved_from' AND date_reserved_to='$date_reserved_to')";
					// $res4    =    mysql_query($q4);
					// $num= mysql_num_rows($res4);
					
					


					$query    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
										   VALUES(DATE(NOW()),'$date_reserved_from','$date_reserved_to','$stage_name','$spec_id','$spec_name','R')";
					$res    =    mysql_query($query);
					if($res)
					{
						//echo "<br />";
						echo "Stage registered successfully.";
						//echo "<a href=\"display.php\">Click here to proceed</a>"; 
					}

}
 
?>