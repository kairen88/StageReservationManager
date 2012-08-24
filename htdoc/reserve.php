<?php
include 'config.php';
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
												   AND NOT(
														   (date_reserved_from>'$date_reserved_from' AND date_reserved_from>'$date_reserved_to' AND date_reserved_to>'$date_reserved_from' AND date_reserved_to>'$date_reserved_to') 
														   OR 
														   (date_reserved_from<'$date_reserved_from' AND date_reserved_from<'$date_reserved_to' AND date_reserved_to<'$date_reserved_from' AND date_reserved_to<'$date_reserved_to')
														)
					
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
												$old_spec_id=$row['spec_id'];
												$old_spec_name=$row['spec_name'];
												$old_date_reserved=$row['date_reserved'];
											
												
												$from_date=$date_reserved_from;
												$to_date=$date_reserved_to;
												
												if ($old_from<$date_reserved_from && $old_to>$date_reserved_to )
												{
																$from_date=$date_reserved_from;
																$to_date=$date_reserved_to;
																
																$new_date=date("Y-m-d",strtotime("-1 day", strtotime($date_reserved_from )));
																
																//echo "\nNEW DATE : $new_date";
																$querynew1    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																					VALUES('$old_date_reserved','$old_from','$new_date','$stage_name','$old_spec_id','$old_spec_name','R')";
																$resnew1    =    mysql_query($querynew1);
																if($resnew1)
																{
																	//echo "\nCase1.1 executed successfully.";
														
																}
																
																$new_date=date("Y-m-d", strtotime("+1 day", strtotime($date_reserved_to)));
																
																//echo "\nNEW DATE : $new_date";
																$querynew2    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																					VALUES('$old_date_reserved','$new_date','$old_to','$stage_name','$old_spec_id','$old_spec_name','R')";
																$resnew2    =    mysql_query($querynew2);
																if($resnew2)
																{
																	
																	//echo "\nCase1.2 executed successfully.";
																	
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
																					VALUES('$old_date_reserved','$new_date','$old_to','$stage_name','$old_spec_id','$old_spec_name','R')";
																$resnew3    =    mysql_query($querynew3);
																if($resnew3)
																{
																
																	//echo "\nCase3 executed successfully.";
																	
																}
													
												}
												else if ($old_from<=$date_reserved_from && $old_to<=$date_reserved_to )
												{
												
																$to_date=$old_to;
															$new_date=date("Y-m-d", strtotime("-1 day", strtotime($date_reserved_from )));	
															$querynew4    =    "INSERT INTO stageReservation(date_reserved,date_reserved_from,date_reserved_to,stage_name,spec_id,spec_name,status)
																				VALUES('$old_date_reserved','$old_from','$new_date','$stage_name','$old_spec_id','$old_spec_name','R')";
															$resnew4    =    mysql_query($querynew4);
															if($resnew4)
															{
																
																//echo "\nCase4 executed successfully.";
																
															}
													
												}
												
												$query_old = "UPDATE stageReservation SET status='O' WHERE reservation_id='$r_id'";
												$res_old    =    mysql_query($query_old);
															if($res_old)
															{
																
																//echo "\nStatus updated to O successfully.";
															
															}
												if($spec_name!=$old_spec_name)
												// echo $s_id;
												// echo "<br />";
												// echo "  Stage to be deleted: \n $r_id  " ;
												// echo "<br />";
												//$q2=" DELETE FROM stageReservation WHERE reservation_id='$r_id'";
												//$res2    =   mysql_query($q2);
												//if($res2)
												//{
												{
												
												
													$query_old1 = "UPDATE stageReservation SET overwritten_date=DATE(NOW()),overwriting_spec='$spec_name' WHERE reservation_id='$r_id'";
													$res_old1   =    mysql_query($query_old1);
												
												
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
													$subject = "Stage Reservation period Overwritten!\n";
													$body = "Hi,Recently your Stage Reservation period was overwritten for the duration 
																$from_date to $to_date by $spec_name\n";
													//if(	mail($to, $subject, $body))
														//echo "mail sent ";
													//else
													   // echo "error sending mail";
													// echo "Receipients : $to\n";
													 //echo "Subject : $subject \n";
													// echo "Message : $body ";
													$body2 = "You have overwritten $old_spec_name's Stage reservation period from $from_date to $to_date \nPlease notify $new_s_email of this change \n";
													echo $body2;
													 
												}	
													
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
						
						echo "Stage reserved successfully.";
					}

}
 
?>
