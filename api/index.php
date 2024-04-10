<?php require_once 'config/connection.php';?>
<?php require_once 'config/functions.php';?>
<?php
header('Content-Type: application/json; charset=UTF-8');
$action=$_GET['action'];

if (($action=='login_api') || ($action=='reset_password_api') || ($action=='resend_otp_api') || ($action=='confirm_otp_api') ){

	switch ($action){

		case 'login_api':
		 
			$email=trim($_POST['email']);
			$password=md5(trim($_POST['password']));
			if (($email!='') || ($password!='')){// start if 1
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 2
					$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$email' AND `password`='$password'") or die (mysqli_error($conn));
					$count_user=mysqli_num_rows($query);
					if ($count_user>0){ /// start if 3
						$fetch_query=mysqli_fetch_array($query);
						$staff_id=$fetch_query['staff_id']; 
						$status_id=$fetch_query['status_id']; 
						$role_id=$fetch_query['role_id'];
						if($status_id==1){ /// start if 4
							/// Generate login access key
							$access_key=md5($staff_id.date("Ymdhis"));
							/// update user on staff_tab
							mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update access key - staff_tab");
							$response['response']=100; 
							$response['result']=true;
							$response['staff_id']=$staff_id;
							$response['role_id']=$role_id;  
							$response['access_key']=$access_key;
							$response['message1']="Login Successfully!";
							$response['message2']="Redireting to the portal..."; 
						}else if($status_id==2){/// else if 4
							$response['response']=101; 
							$response['result']=false;
							$response['message1']="User Suspended!"; 
							$response['message2']="Contact the admin for help."; 
						}else{/// else if 4
							$response['response']=102; 
							$response['result']=false;
							$response['message1']="User Under Reviewed"; 
							$response['message2']="Contact the admin for help."; 
						}/// end if 4
					}else{ /// else if 3
						$response['response']=103; 
						$response['result']=false;
						$response['message1']="Invalid Login Parameters!"; 
						$response['message2']="Check email or password to continue.";
					} /// end if 3
				}else{/// else if 2
					$response['response']=103; 
					$response['result']=false;
					$response['message1']="Invalid Login Parameters!"; 
					$response['message2']="Check email or password to continue."; 
				}/// end if 2
			}else{// else if 1
				$response['response']=105; 
				$response['result']=false;
				$response['message1']="Login Error!"; 
				$response['message2']="Fill all fields to continue."; 
			}// end if 1
				
		break;
	
	
	
	
	
	
	
	
		case 'reset_password_api':

			$email=trim($_POST['email']);
			if($email!='')	{ // start if 1
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 2
					$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$email'") or die (mysqli_error($conn));
					$count_user=mysqli_num_rows($query);
					if ($count_user>0){ /// start if 3
						$fetch_query=mysqli_fetch_array($query);
						$staff_id=$fetch_query['staff_id']; 
						$fullname=$fetch_query['fullname']; 
						$email=$fetch_query['email']; 
						$status_id=$fetch_query['status_id'];
						if($status_id==1){ /// start if 4 (check if the user is active)
							/// Generate otp
							$otp = rand(111111,999999);

							/// update user on staff_tab
							mysqli_query($conn,"UPDATE staff_tab SET otp='$otp', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update access key - staff_tab");
							////// send otp to email
							$mail_to_send='send_reset_password_otp';
							require_once('mail/mail.php');	

							$response['response']=106; 
							$response['result']=true;
							$response['staff_id']=$staff_id;
							$response['fullname']=ucwords(strtolower($fullname)); 
							$response['email']=$email;
							
						

						}else if($status_id==2){/// else if 4
							$response['response']=107; 
							$response['result']=false;
							$response['message1']="User Suspended"; 
							$response['message2']="Contact the admin for help."; 

						}else{ /// else if 4
							$response['response']=108;  
							$response['result']=false;
							$response['message1']="User Under Reviewed"; 
							$response['message2']="Contact the admin for help."; 
						} /// end if 4
					}else{/// else if 3
						$response['response']=109; 
						$response['result']=false;
						$response['message1']="Email Error!"; 
						$response['message2']="Invalid Email Address!"; 
					}/// end if 3
				}else{ /// else if 2
					$response['response']=110; 
					$response['result']=false;
					$response['message1']="Email Error!"; 
					$response['message2']="Invalid Email Address!"; 
				}/// end if 2
			}else{ /// else if 1
				$response['response']=111; 
				$response['result']=false;
				$response['message1']="Email Error!"; 
				$response['message2']="FIll email fields to continue!";  
			}/// end if 1
		break;
		
	
	
	
	
		case 'resend_otp_api':
			$staff_id=trim($_POST['staff_id']);
			if($staff_id==''){//start if 1
				$response['response']=112; 
				$response['result']=false;
				$response['message1']="STAFF ID ERROR!";
				$response['message2']="Cannot be empty";
			}else{//else if 1

				$user_array=$callclass->_get_staff($conn, $staff_id);
				$u_array = json_decode($user_array, true);
				$staff_id= $u_array[0]['staff_id'];
				$fullname= $u_array[0]['fullname'];
				$email= $u_array[0]['email'];

				/// Generate otp
				$otp = rand(111111,999999);
				/// update user on staff_tab
				mysqli_query($conn,"UPDATE staff_tab SET otp='$otp', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update OTP - staff_tab");
			
				//// resend otp to email
				$mail_to_send='send_reset_password_otp';
				require_once('mail/mail.php');

				$response['response']=113; 
				$response['result']=true;
				$response['message1']="OTP SENT!";
				$response['message2']="Check your inbox or spam!";
				$response['staff_id']=$staff_id;
				$response['fullname']=ucwords(strtolower($fullname)); 
				$response['email']=$email;

			}// end if 1
		break;
		
		
		
		
		case 'confirm_otp_api':
			$staff_id=trim($_POST['staff_id']);
			$otp=trim($_POST['otp']);
			$password=md5($_POST['password']);
	
			if(($staff_id=='') || ($otp=='') || ($password=='')){ //start if 1
				$response['response']=114; 
				$response['result']=false;
				$response['message1']="OTP OR PASSWORD ERROR!";
				$response['message2']="Fields Cannot be empty";
			}else{ // else if 1
				if (is_numeric($otp)) { ///start if 2
					$query=mysqli_query($conn,"SELECT staff_id, otp FROM staff_tab WHERE staff_id='$staff_id' AND otp='$otp'") or die (mysqli_error($conn));
					$count_user=mysqli_num_rows($query);
					if ($count_user>0){ /// start if 3
						/// update user password
						mysqli_query($conn,"UPDATE staff_tab SET `password`='$password', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update staff_tab");
						$response['response']=115; 
						$response['result']=true;
						$response['message1']="SUCCESS!";
						$response['message2']="Password Reset Successfully!";
					}else{/// else if 3
						$response['response']=116; 
						$response['result']=false;
						$response['message1']="OTP ERROR!";
						$response['message2']="Invalid OTP Parameters.";
					}/// end if 3
				}else{ // else if 2
					$response['response']=117; 
					$response['result']=false;
					$response['message1']="OTP ERROR!";
					$response['message2']="Invalid OTP Parameters.";
				}/// end if 2
			}// end if 1
		break;

	}


}else{
		$access_key=trim($_GET['access_key']);
		///////////auth/////////////////////////////////////////
		$fetch=$callclass->_validate_accesskey($conn,$access_key);
		$array = json_decode($fetch, true);
		$check=$array[0]['check'];
		$login_staff_id=$array[0]['staff_id'];
		$login_role_id=$array[0]['role_id'];

		$response['check']=$check;
		if ($check==0) { /// start if check 
			$response['response']=99; 
			$response['result']=False;
			$response['message']='Invalid AccessToken. Please LogIn Again.'; 
		} else {/// else if check 


		switch ($action){


			case 'fetch_status_api':                                                                                                
				$status_id=trim($_POST['status_id']); 
				if($status_id!=''){// start if 1
					$query=mysqli_query($conn,"SELECT * FROM setup_status_tab WHERE status_id IN($status_id) ");
					$response['response']=118;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{// else if 1
					$response['response']=119; 
					$response['result']=false;
					$response['message']='FETCH STATUS ERROR!'; 
				} // end if 1                                                                                                                           
			break;


			case 'fetch_role_api':
				$role_id=trim($_POST['role_id']);	
				if($role_id!=''){// start if 1
					$query=mysqli_query($conn,"SELECT * FROM setup_role_tab WHERE role_id IN($role_id) ");
					$response['response']=120;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{// else if 1
					$response['response']=121; 
					$response['result']=False;
					$response['message']='FETCH ROLE ERROR!'; 
				}//end if 1
			break;
	
			
			case 'fetch_cat_api':                                                                                                
				$query=mysqli_query($conn,"SELECT * FROM setup_categories_tab");
				$response['response']=122;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
				}                                                                                                                       
			break;

			case 'fetch_subscription_pricing_api':                                                                                                
				$query=mysqli_query($conn,"SELECT * FROM setup_subscription_pricing_tab");
				$response['response']=123;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
				}                                                                                                                       
			break;


			case 'fetch_video_volume_api':                                                                                              
				$query=mysqli_query($conn,"SELECT * FROM setup_video_volume_tab");
				$response['response']=124;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
				}                                                                                                                    
			break;

			
			case 'fetch_duration_api':                                                                                                
				$query=mysqli_query($conn,"SELECT * FROM setup_duration_tab");
				$response['response']=125;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
				}                                                                                                                    
			break;

			case 'add_or_update_staff_api':
				$staff_id=trim(strtoupper($_POST['staff_id']));
				$fullname=trim(strtoupper($_POST['fullname']));
				$mobile=trim($_POST['mobile']);
				$email=trim($_POST['email']);
				$address=trim(strtoupper($_POST['address']));	
			
				$passport='friends.png';
				$role_id=trim($_POST['role_id']);
				$status_id=trim($_POST['status_id']);
				
				if(($fullname=='')||($mobile=='')||($email=='')||($address=='')||($role_id=='')||($status_id=='')){ ///start if 1
					$response['response']=126; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Fill all fields to continue."; 
				}else{ ///else if 1
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){ ///start if 2
						if($staff_id==''){ ///start if 3
							$usercheck=mysqli_query($conn,"SELECT email FROM staff_tab WHERE email='$email'");
							$useremail=mysqli_num_rows($usercheck);
							if ($useremail>0){ ///start if 4
								$response['response']=127; 
								$response['result']=False;
								$response['message1']="EMAIL ERROR!"; 
								$response['message2']="Email already been used.";
							}else{ ///else if 4
								///////////////////////geting sequence//////////////////////////
								$counter_id='STF';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate staff_id and password 
								$staff_id='STF'.$no.date("Ymdhis");
								$password=md5($staff_id);	
								/// register staff

								mysqli_query($conn,"INSERT INTO `staff_tab`
								(`staff_id`, `fullname`, `mobile`, `email`,`address`, `role_id`, `status_id`, `password`, `passport`, `created_time`) VALUES
								('$staff_id', '$fullname', '$mobile','$email','$address','$role_id', '$status_id', '$password','$passport', NOW())")or die (mysqli_error($conn));
								
								$response['response']=128; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Staff Registered Successfully.";
								$response['staff_id']=$staff_id; 
							} ///end if 4
						}else{ ///else if 3
							$usercheck=mysqli_query($conn,"SELECT email FROM staff_tab WHERE email='$email' AND staff_id!='$staff_id' LIMIT 1");
							$useremail=mysqli_num_rows($usercheck);
							if ($useremail>0){ ///start if 5
								$response['response']=129; 
								$response['result']=false;
								$response['message1']="EMAIL ERROR!"; 
								$response['message2']="Email already been used.";
							}else{ ///else if 4
								mysqli_query($conn,"UPDATE staff_tab SET fullname='$fullname',mobile='$mobile',email='$email', `address`='$address', status_id='$status_id', role_id='$role_id' WHERE staff_id='$staff_id'") or die (mysqli_error($conn));
								$response['response']=130; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Staff Updated Successfully.";
								$response['staff_id']=$staff_id; 
							} ///end if 5
						} ///end if 3
					}else{ ///else if 2
						$response['response']=131; 
						$response['result']=false;
						$response['message']="ERROR: $email is NOT an email address"; 
						$response['message1']="EMAIL ERROR!"; 
						$response['message2']="Not valid email address";
					} ///end if 2
				} //end if 1
			break;


			case 'fetch_staff_api':
				$staff_id=trim(strtoupper($_POST['staff_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);
				
				$search_like="(staff_id like '%$search_txt%' OR 
				fullname like '%$search_txt%' OR 
				mobile like '%$search_txt%' OR 
				email like '%$search_txt%')";

				/// write sql statement and function that will return all staff here
				if ($staff_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name, c.role_name FROM staff_tab a, setup_status_tab b, setup_role_tab c WHERE a.status_id=b.status_id AND a.role_id=c.role_id AND b.status_id LIKE '%$status_id%' AND a.role_id<'$login_role_id' AND $search_like ORDER BY fullname ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=132;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // else if 2
						$response['response']=133;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
				}else{///else if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name, c.role_name FROM staff_tab a, setup_status_tab b, setup_role_tab c WHERE a.staff_id LIKE '%$staff_id%' AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%' AND a.role_id=c.role_id AND $search_like ORDER BY fullname ASC")or die (mysqli_error($conn));
					$response['response']=134;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
						$fullname=$fetch_query['fullname'];
						$response['fullname']=ucwords(strtolower($fullname));
						$response['data']=$fetch_query;
					} 
				} //end if 1
				
			break;


			case 'delete_staff_api':
				$staff_id=trim(strtoupper($_POST['staff_id']));
				$usercheck=mysqli_query($conn,"SELECT status_id FROM staff_tab WHERE staff_id='$staff_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_assoc($usercheck);
				$response['data']=$fetch_query; 
				$status_id=$fetch_query['status_id']; 

				if($status_id==1){ //// start if 1
					//// user is activated
					$response['response']=135;
					$response['result']=false;
					$response['message']="Unable to delete user, User is still active";

				}else if($status_id==2){ //// else if 1
					//// user is suspended
					mysqli_query($conn,"DELETE FROM staff_tab WHERE staff_id='$staff_id'")or die (mysqli_error($conn));
					$response['response']=136;
					$response['result']=true;
					$response['message']="User delete Successfully"; 
				}// End if 1
			break;


			case 'get_passport_api':
				$staff_id=trim(($_POST['staff_id']));
				$user_array=$callclass->_get_staff($conn, $staff_id);
				$u_array = json_decode($user_array, true);
				$db_passport= $u_array[0]['passport'];

				if($db_passport!=''){ // start if 1
					$response['response']=137;
					$response['result']=true;
					$response['staff_id']=$staff_id;
					$response['db_passport']=$db_passport;
				}// end if 1										
			break;


			case 'upload_passport_api':
				$staff_id=trim(($_POST['staff_id']));
				$passport_pix=$_FILES['passport']['name'];
				$datetime=date("Ymdhi");
				$response['response']=138;
				$response['result']=true;
				$response['message1']='PASSPORT UPLOADED';
				$response['message2']='Successfully!';
				if($passport_pix!=''){ // start if 1
					$extension = pathinfo($passport_pix, PATHINFO_EXTENSION);					
					$passport = $datetime.'_'.$staff_id.'_'.uniqid().'.'.$extension;	
					$response['staff_id']=$staff_id;
					$response['passport']=$passport;
				} // end if 1
				mysqli_query($conn,"UPDATE `staff_tab` SET passport='$passport' WHERE staff_id='$staff_id'") or die ("cannot update staff passport");
			break;
			////////End of Staff Registration//////	



			case 'fetch_user_api':
				$user_id=trim(strtoupper($_POST['user_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);
				
				$search_like="(user_id like '%$search_txt%' OR 
				fullname like '%$search_txt%' OR 
				mobile like '%$search_txt%' OR 
				email like '%$search_txt%')";

				if ($user_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM user_tab a, setup_status_tab b  WHERE a.status_id=b.status_id AND b.status_id LIKE '%$status_id%' AND $search_like ORDER BY fullname ASC  ")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=139;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 2
						$response['response']=140;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
					
				} else {///else 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM  user_tab a, setup_status_tab b WHERE a.user_id LIKE '%$user_id%'  AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%' AND $search_like ORDER BY fullname ASC")or die (mysqli_error($conn));
						$response['response']=141;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_assoc($query)){
						$response['data']=$fetch_query;
					} 
				} //enf if 1
			break;


			////////Start Subject Registration//////	
			case 'add_or_update_subject_api':
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$subject_name = str_replace("'", "\\'", strtolower(trim($_POST['subject_name'])));	
				$subject_url = str_replace("'", "\\'", strtolower(trim($_POST['subject_url'])));	
				$seo_keywords = str_replace("'", "\'", $_POST['seo_keywords']);
				$seo_description = str_replace("'", "\'", $_POST['seo_description']);
				$new_subject_pix = $_FILES['subject_picture']['name']; //// subject passport value			
				$status_id=trim($_POST['status_id']);
				
				if(($subject_name=='')||($subject_url=='')||($seo_keywords=='')||($seo_description=='')||($status_id=='')){ ///start if 1
					$response['response']=142; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{//else if 1
					if($subject_id==''){ ///start if 2
						$subjectcheck=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_name='$subject_name'");
						$subcheck=mysqli_num_rows($subjectcheck);
						if ($subcheck>0){ ///start if 3
							$response['response']=143; 
							$response['result']=False;
							$response['message1']="ERROR!"; 
							$response['message2']="Subject Already Exist!"; 						
						}else{ //else if 2
							$urlcheck=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_url='$subject_url'");
							$subcheck=mysqli_num_rows($urlcheck);
							if ($subcheck>0){ ///start if 4
								$response['response']=144; 
								$response['result']=False;
								$response['message1']="ERROR!"; 
								$response['message2']="Subject URL Already Exist!"; 						
							}else{ ///else if 3
							
								///////////////////////geting sequence//////////////////////////
								$counter_id='SUBJ';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate subject_id //// 
								$subject_id='SUBJ'.$no.date("Ymdhis");
								/// register subject ////
	
								$extension = pathinfo($new_subject_pix, PATHINFO_EXTENSION);
								$subject_picture = $subject_id.'_'.uniqid().'.'.$extension;

								If($new_subject_pix==''){ // start if 5
									$subject_picture='default_pix.jpg';
								}// end if 5

								mysqli_query($conn,"INSERT INTO `subject_tab`
								(`subject_id`, `subject_name`, `subject_url`, `seo_keywords`, `seo_description`, `status_id`, `subject_passport`, `created_time`) VALUES
								('$subject_id', '$subject_name', '$subject_url', '$seo_keywords', '$seo_description', '$status_id', '$subject_picture', NOW())")or die (mysqli_error($conn));
								
								$response['response']=145; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Subject Registered Successfully!"; 	 
								$response['subject_id']=$subject_id;  
								$response['subject_picture']=$subject_picture; 
							}// end if 4
						} ///end if 3
					}else{ ///else if 2
						$subjectcheck=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_name='$subject_name' AND subject_id!='$subject_id' LIMIT 1");
						$subcheck=mysqli_num_rows($subjectcheck);
						if ($subcheck>0){ ///start if 6
							$response['response']=146; 
							$response['result']=false;
							$response['message1']="ERROR!"; 
							$response['message2']="Subject Name Already Exist!"; 							
						}else{ ///else if 4
							$urlcheck=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_url='$subject_url' AND subject_id!='$subject_id' LIMIT 1");
							$subcheck=mysqli_num_rows($urlcheck);
							if ($subcheck>0){ ///start if 7
								$response['response']=147; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Subject URL Already Exist!"; 							
							}else{ ///else if 5
								
								mysqli_query($conn,"UPDATE subject_tab SET subject_name='$subject_name', subject_url='$subject_url', seo_keywords='$seo_keywords', seo_description='$seo_description',status_id='$status_id' WHERE subject_id='$subject_id'")or die ("cannot update subject_tab");
								
								if ($new_subject_pix!=''){
									$query=mysqli_query($conn,"SELECT subject_passport FROM subject_tab WHERE subject_id = '$subject_id'");
									$fetch_query=mysqli_fetch_array($query);
									$old_passport=$fetch_query['subject_passport'];
									$response['old_passport']=$old_passport; 

									$extension = pathinfo($new_subject_pix, PATHINFO_EXTENSION);
									$subject_picture = $subject_id.'_'.uniqid().'.'.$extension;
									mysqli_query($conn,"UPDATE subject_tab SET subject_passport='$subject_picture' WHERE subject_id='$subject_id'")or die ("cannot update subject_tab");
									$response['subject_picture']=$subject_picture; 
								}
								$response['response']=148; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Subject Updated Successfully!"; 
								$response['subject_id']=$subject_id;
							} ///end if 7	
						}// end if 6				
					} //end if 2
				} //end if 1
			break;


			case 'fetch_subject_api':
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(subject_id like '%$search_txt%' OR 
				subject_name like '%$search_txt%')";
						
				/// write sql statement and function that will return all subject here
				if($subject_id==''){///start if 1
					$query=mysqli_query($conn,"SELECT 
					a.*, b.status_name, 
					(SELECT COUNT(c.topic_id) FROM topic_tab c WHERE c.subject_id=a.subject_id AND c.status_id=1) AS total_topic_count 
					FROM subject_tab a, setup_status_tab b  
					WHERE a.status_id=b.status_id 
					AND b.status_id LIKE '%$status_id%'
					AND $search_like ORDER BY subject_name ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=149;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else if 2
						$response['response']=150;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
				}else{///else if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM subject_tab a, setup_status_tab b WHERE a.subject_id LIKE '%$subject_id%'  AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%' AND $search_like ORDER BY subject_name ASC")or die (mysqli_error($conn));
					$response['response']=151;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					} 
				} //end if 1
			break;



			case 'delete_subject_api':
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$usercheck=mysqli_query($conn,"SELECT status_id FROM subject_tab WHERE subject_id='$subject_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_assoc($usercheck);
				$response['data']=$fetch_query; 
				$status_id=$fetch_query['status_id']; 

				if($status_id==1){ //// start if 1
					//// user is activated
					$response['response']=152;
					$response['result']=false;
					$response['message']="subject cannot be deleted! subject is still active";

				}else if($status_id==2){ //// else 1
					//// user is suspended
					mysqli_query($conn,"DELETE FROM subject_tab WHERE subject_id='$subject_id' ")or die (mysqli_error($conn));
					$response['response']=153;
					$response['result']=true;
					$response['message']="Subject deleted Successfully"; 
				}// End if 1
			break;
			////////End Subject Registration//////	


			////////Start Exam Registration//////	
			case 'add_or_update_exam_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$abbreviation = str_replace("'", "\\'", strtolower(trim($_POST['abbreviation'])));
				$exam_name = str_replace("'", "\\'", strtoupper(trim($_POST['exam_name'])));
				$exam_url = str_replace("'", "\\'", strtolower(trim($_POST['exam_url'])));					
				$seo_keywords = str_replace("'", "\'", $_POST['seo_keywords']);
				$seo_description = str_replace("'", "\'", $_POST['seo_description']);
				$all_subject_id=$_POST['subject_id'];
				$new_exam_pix=$_FILES['exam_logo']['name']; //// exam passport value	
				$status_id=trim($_POST['status_id']);
				
				if(($abbreviation=='')||($exam_name=='')||($exam_url=='')||($seo_keywords=='')||($seo_description=='')||($status_id=='')){ ///start if 1
					$response['response']=154; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{ ///else if 1
					if($exam_id==''){ ///start if 2
						$examcheck=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE abbreviation='$abbreviation'");
						$check=mysqli_num_rows($examcheck);
						if ($check>0){ ///start if 3
							$response['response']=155; 
							$response['result']=False;
							$response['message1']="ERROR!"; 
							$response['message2']="Exam Already Exist!"; 						
						}else{ ///else if 3
							$urlcheck=mysqli_query($conn,"SELECT exam_url FROM exam_tab WHERE exam_url='$exam_url'");
							$check=mysqli_num_rows($urlcheck);
							if ($check>0){ ///start if 4
								$response['response']=156; 
								$response['result']=False;
								$response['message1']="ERROR!"; 
								$response['message2']="Exam URL Already Exist!"; 						
							}else{ ///else if 4

								///////////////////////geting sequence//////////////////////////
								$counter_id='EXAM';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate exam //// 
								$exam_id='EXAM'.$no.date("Ymdhis");
								/// register exam ////

								///////////////////////generate exam_pix//////////////////////////
								$extension = pathinfo($new_exam_pix, PATHINFO_EXTENSION);
								$exam_logo = $exam_id.'_'.uniqid().'.'.$extension;

								///////////////////////check if exam_pix is empty//////////////////
								If($new_exam_pix==''){
									$exam_logo= 'default_pix.jpg';
								}
						
								mysqli_query($conn,"INSERT INTO `exam_tab`
								(`exam_id`, `abbreviation`, `exam_name`, `exam_url`, `seo_keywords`, `seo_description`, `status_id`, `exam_passport`, `created_time`) VALUES
								('$exam_id', '$abbreviation', '$exam_name', '$exam_url', '$seo_keywords', '$seo_description', '$status_id', '$exam_logo', NOW())")or die (mysqli_error($conn));
															
								///////////////////////loop each subjects//////////////////
								$each_subject_ids = explode(',',$all_subject_id);
								foreach($each_subject_ids as $subject_id){	

								mysqli_query($conn,"INSERT INTO `exam_subject_tab`
								(`exam_id`, `subject_id`, `created_time`) VALUES
								('$exam_id', '$subject_id', NOW())")or die (mysqli_error($conn));

								$query=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_id='$subject_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$subject_url=$fetch_query['subject_url']; 
								$all_subject_urls .="$subject_url,";									
								}
					
								$response['response']=157; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Exam Registered Successfully!"; 	 
								$response['exam_id']=$exam_id;  
								$response['exam_logo']=$exam_logo; 
								$response['exam_url']=$exam_url;
								$response['all_subject_id']=$all_subject_id;  
								$response['all_subject_urls']=$all_subject_urls; 	
							} ///end if 4
						}//end if 3
					}else{ ///else if 2
						$examcheck=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE abbreviation='$abbreviation' AND exam_id!='$exam_id' LIMIT 1");
						$check=mysqli_num_rows($examcheck);
						if ($check>0){ ///start if 5
							$response['response']=158; 
							$response['result']=false;
							$response['message1']="ERROR!"; 
							$response['message2']="Exam Name Already Exist!"; 
						}else{ // else if 5
							$urlcheck=mysqli_query($conn,"SELECT exam_url FROM exam_tab WHERE exam_url='$exam_url' AND exam_id!='$exam_id' LIMIT 1");
							$check=mysqli_num_rows($urlcheck);
							if ($check>0){ ///start if 6
								$response['response']=159; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Exam URL Already Exist!"; 
							}else{ ///else if 6
								mysqli_query($conn,"DELETE FROM exam_subject_tab WHERE exam_id='$exam_id'") or die (mysqli_error($conn));

								$subcheck=mysqli_query($conn,"SELECT exam_url FROM exam_tab WHERE exam_id='$exam_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($subcheck);
								$db_exam_url=$fetch_query['exam_url']; 

								mysqli_query($conn,"UPDATE exam_tab 
								SET abbreviation='$abbreviation', exam_name='$exam_name', exam_url='$exam_url', seo_keywords='$seo_keywords', seo_description='$seo_description', status_id='$status_id' WHERE exam_id='$exam_id'")or die ("cannot update exam_tab");
								
								///////////////////////loop for update subject//////////////////
								$each_subject_ids = explode(',',$all_subject_id);
								foreach($each_subject_ids as $subject_id){	
								
										mysqli_query($conn,"INSERT INTO `exam_subject_tab`
										(`exam_id`, `subject_id`, `created_time`) VALUES
										('$exam_id', '$subject_id', NOW())")or die (mysqli_error($conn));

									$subcheck=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_id='$subject_id'") or die (mysqli_error($conn));
									$fetch_query=mysqli_fetch_array($subcheck);
									$subject_url=$fetch_query['subject_url'];
									$all_subject_urls .="$subject_url,";	

								}


								if ($new_exam_pix!=''){
									$query=mysqli_query($conn,"SELECT exam_passport FROM exam_tab WHERE exam_id = '$exam_id'");
									$fetch_query=mysqli_fetch_array($query);
									$old_passport=$fetch_query['exam_passport'];
									$response['old_passport']=$old_passport; 
							
									$extension = pathinfo($new_exam_pix, PATHINFO_EXTENSION);
									$exam_logo = $exam_id.'_'.uniqid().'.'.$extension;
									mysqli_query($conn,"UPDATE exam_tab SET exam_passport='$exam_logo' WHERE exam_id='$exam_id'")or die ("cannot update exam_tab");
									$response['exam_logo']=$exam_logo; 
								}
								
								$response['response']=160; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Exam Updated Successfully!"; 
								$response['exam_id']=$exam_id;
								$response['db_exam_url']=$db_exam_url;
								$response['exam_url']=$exam_url;
								$response['all_subject_id']=$all_subject_id;  
								$response['all_subject_urls']=$all_subject_urls; 	
							} ///end if 6
						}//end if 5				
					} ///end if 2
				} ///end if 1
			break;





			case 'fetch_exam_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);
				
				$search_like="(exam_id like '%$search_txt%' OR 
				abbreviation like '%$search_txt%' OR 
				exam_name like '%$search_txt%' OR  
				exam_url like '%$search_txt%')";
				
				/// write sql statement and function that will return all exam here
				if ($exam_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT 
					a.*, 
					b.status_name, 
					(SELECT COUNT(c.subject_id) FROM exam_subject_tab c, subject_tab d WHERE a.exam_id=c.exam_id AND c.subject_id=d.subject_id AND d.status_id=1) AS total_exam_subject_count 
					FROM exam_tab a, setup_status_tab b 
					WHERE a.status_id=b.status_id AND b.status_id  LIKE '%$status_id%' AND $search_like ORDER BY a.exam_name ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=161;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
						}
					}else{ // Else if 1
						$response['response']=162;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
				}else{///else if 2
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM  exam_tab a, setup_status_tab b WHERE a.exam_id LIKE '%$exam_id%' AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%' ")or die (mysqli_error($conn));
					$response['response']=163;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					} 


					$query=mysqli_query($conn,
					"SELECT
					a.subject_id,a.subject_name, 
					CASE
					WHEN b.subject_id IS NOT NULL THEN 'checked'
					ELSE 'unchecked'
					END AS checked
					FROM subject_tab a
					LEFT JOIN exam_subject_tab b ON
					a.subject_id = b.subject_id AND b.exam_id='$exam_id'")or die (mysqli_error($conn));
		
					$response['response']=164;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data2']=$fetch_query;
					}
				} //end if 1
			break;


			case 'fetch_exam_subject_api':
				$exam_id=($_POST['exam_id']);
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);
				
				$search_like="(subject_id like '%$search_txt%' OR 
				subject_name like '%$search_txt%')";
			
				$query=mysqli_query($conn,"SELECT 
				a.*, 
				b.subject_name, 
				b.subject_passport, 
				c.status_name,
				(SELECT COUNT(d.topic_id) FROM topic_tab d WHERE d.exam_id='$exam_id' AND a.subject_id=d.subject_id AND d.status_id=1) AS total_topic_count
				FROM exam_subject_tab a, subject_tab b, setup_status_tab c WHERE a.subject_id=b.subject_id AND exam_id='$exam_id' AND b.status_id=c.status_id AND b.status_id LIKE '%$status_id%' AND (b.subject_id like '%$search_txt%' OR b.subject_name like '%$search_txt%')")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1
					$response['response']=165;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{ // Else 1
					$response['response']=166;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 1
				$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id'")or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_array($query);
				$abbreviation=$fetch_query['abbreviation'];
				$response['abbreviation']=$abbreviation;	
			break;

			////////Start topic Registration//////	
			case 'add_or_update_topic_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$topic_name = str_replace("'", "\\'", strtoupper(trim($_POST['topic_name'])));	
				$status_id=trim($_POST['status_id']);
				
				$query=mysqli_query($conn,"SELECT exam_id, subject_id FROM exam_subject_tab WHERE exam_id='$exam_id' AND subject_id='$subject_id'");
				$check=mysqli_num_rows($query);
				if ($check>0){ // start if 1
					if(($topic_name=='')||($status_id=='')){ ///start if 2
						$response['response']=167; 
						$response['result']=False;
						$response['message1']="ERROR!"; 
						$response['message2']="Some Fields are empty!"; 
					}else{ //else if 2
						if($topic_id==''){ ///start if 3
							$query=mysqli_query($conn,"SELECT topic_name FROM topic_tab WHERE topic_name='$topic_name' AND exam_id='$exam_id'");
							$check=mysqli_num_rows($query);
							if ($check>0){ ///start if 4
								$response['response']=168; 
								$response['result']=False;
								$response['message1']="ERROR!"; 
								$response['message2']="Topic Name Already Exist!"; 						
							}else{ ///else if 4
	
								///////////////////////geting sequence//////////////////////////
								$counter_id='TOPIC';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate topic_id //// 
								$topic_id='TOPIC'.$no.date("Ymdhis");
								/// register topic ////
	
								mysqli_query($conn,"INSERT INTO `topic_tab`
								(`exam_id`,`subject_id`, `topic_id`, `topic_name`, `status_id`, `created_time`) VALUES
								('$exam_id','$subject_id', '$topic_id', '$topic_name', '$status_id', NOW())")or die (mysqli_error($conn));
								
								$response['response']=169; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Topic Registered Successfully!"; 	 
								$response['topic_id']=$topic_id;  									
							} ///end if 4
						}else{ ///else if 3
							$query=mysqli_query($conn,"SELECT topic_name FROM topic_tab WHERE topic_name='$topic_name' AND topic_id!='$topic_id' AND exam_id='$exam_id' LIMIT 1");
							$check=mysqli_num_rows($query);
							if ($check>0){ ///start if 5
								$response['response']=170; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Topic Name Already Exist!"; 							
							}else{ //else if 5
								mysqli_query($conn,"UPDATE topic_tab SET exam_id='$exam_id', subject_id='$subject_id', topic_name='$topic_name', status_id='$status_id' WHERE topic_id='$topic_id'")or die ("cannot update topic_tab");
								$response['response']=171; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Topic Updated Successfully!"; 
								$response['topic_id']=$topic_id;
							} ///end if 5					
						} ///end if 3
					} ///end if 2	
				}else{// else if 1
					$response['response']=172; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Error!";
				}// end if 1	
			break;



			case 'fetch_topic_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(topic_name like '%$search_txt%')";

				/// write sql statement and function that will return all topics here
				if ($topic_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT 
					a.*, b.status_name,
					(SELECT COUNT(c.sub_topic_id) FROM sub_topic_tab c WHERE c.topic_id=a.topic_id AND c.status_id=1) AS total_sub_topic_count  
					FROM topic_tab a, setup_status_tab b 
					WHERE a.status_id=b.status_id 
					AND b.status_id LIKE '%$status_id%' 
					AND a.exam_id LIKE '%$exam_id%' 
					AND a.subject_id LIKE '%$subject_id%' 
					AND $search_like 
					ORDER BY topic_name ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=173;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else if 2
						$response['response']=174;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2

					$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id'")or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$abbreviation=$fetch_query['abbreviation'];
					$response['abbreviation']=$abbreviation; 

					$query=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_id='$subject_id'")or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$subject_name=$fetch_query['subject_name'];
					$response['subject_name']=$subject_name; 

				}else{///else if 2
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM  topic_tab a, setup_status_tab b WHERE a.topic_id LIKE '%$topic_id%'  AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%' AND $search_like ORDER BY topic_name ASC")or die (mysqli_error($conn));
					$response['response']=175;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					} 
				} //end if 1
			break;



			case 'delete_topic_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));

				$check=mysqli_query($conn,"SELECT status_id FROM topic_tab WHERE topic_id='$topic_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_assoc($check);
				$response['data']=$fetch_query; 
				$status_id=$fetch_query['status_id']; 

				if($status_id==1){ //// start if 1
					//// user is activated
					$response['response']=176;
					$response['result']=false;
					$response['message']="Topic cannot be deleted! Topic is still active";

				}else if($status_id==2){ //// else 1
					//// user is suspended
					mysqli_query($conn,"DELETE FROM topic_tab WHERE topic_id='$topic_id' ")or die (mysqli_error($conn));
					$response['response']=177;
					$response['result']=true;
					$response['message']="Topic deleted Successfully"; 
				}// End if 1
			break;
			////////End Topic Registration//////	


			// ////////Start sub-topic Registration//////
			case 'add_or_update_sub_topic_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$exam_url = str_replace("'", "\\'", strtolower(trim($_POST['exam_url'])));
				$subject_url = str_replace("'", "\\'", strtolower(trim($_POST['subject_url'])));		
				$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
				$sub_topic_name = str_replace("'", "\\'", strtoupper(trim($_POST['sub_topic_name'])));
				$sub_topic_url = str_replace("'", "\\'", strtolower(trim($_POST['sub_topic_url'])));
				$subscription_price=trim(strtolower($_POST['subscription_price']));
				$seo_keywords = str_replace("'", "\'", $_POST['seo_keywords']);
				$seo_description = str_replace("'", "\'", $_POST['seo_description']);
				$subscription_duration_id=$_POST['subscription_duration_id'];
				$new_sub_topic_pix=$_FILES['sub_topic_logo']['name']; //// exam passport value	
				$status_id=trim($_POST['status_id']);
				
				if(($sub_topic_name=='')||($sub_topic_url=='')||($subscription_price=='')||($seo_keywords=='')||($seo_description=='')||($subscription_duration_id=='')||($status_id=='')){ ///start if 1
					$response['response']=178; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{ ///else if 1
					if($sub_topic_id==''){ ///start if 2
						$query=mysqli_query($conn,"SELECT sub_topic_name, topic_id FROM sub_topic_tab WHERE sub_topic_name='$sub_topic_name' AND topic_id='$topic_id'");
						$check=mysqli_num_rows($query);
						if ($check>0){ ///start if 3
							$response['response']=179; 
							$response['result']=False;
							$response['message1']="ERROR!"; 
							$response['message2']="Sub Topic Name Already Exist!"; 						
						}else{ ///else if 3
							$urlcheck=mysqli_query($conn,"SELECT sub_topic_url, topic_id FROM sub_topic_tab WHERE sub_topic_url='$sub_topic_url' AND topic_id='$topic_id'");
							$check=mysqli_num_rows($urlcheck);
							if ($check>0){ ///start if 4
								$response['response']=180; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Sub Topic URL Already Exist!";
							}else{ // else if 4

								///////////////////////geting sequence//////////////////////////
								$counter_id='SUBTOPIC';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate sub topic_id //// 
								$sub_topic_id='SUBTOPIC'.$no.date("Ymdhis");
								/// register sub topic ////

								///////////////////////generate exam_pix//////////////////////////
								$extension = pathinfo($new_sub_topic_pix, PATHINFO_EXTENSION);
								$sub_topic_logo = $sub_topic_id.'_'.uniqid().'.'.$extension;

								///////////////////////check if sub_topic_pix is empty//////////////////
								If($new_sub_topic_pix==''){
									$sub_topic_logo= 'default_pix.jpg';
								} 
								
								mysqli_query($conn,"INSERT INTO `sub_topic_tab`
								(`subject_id`, `topic_id`, `sub_topic_id`, `sub_topic_name`, `sub_topic_url`, `subscription_price`, `seo_keywords`, `seo_description`, `subscription_duration_id`, `sub_topic_passport`, `status_id`, `created_time`) VALUES
								('$subject_id', '$topic_id', '$sub_topic_id', '$sub_topic_name', '$sub_topic_url', '$subscription_price', '$seo_keywords', '$seo_description', '$subscription_duration_id', '$sub_topic_logo', '$status_id', NOW())")or die (mysqli_error($conn));
								
								$query=mysqli_query($conn,"SELECT * FROM exam_tab a, topic_tab b WHERE a.exam_id=b.exam_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$exam_id=$fetch_query['exam_id']; 

								$query=mysqli_query($conn,"SELECT exam_url FROM exam_tab WHERE exam_id='$exam_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$exam_url=$fetch_query['exam_url']; 

								$query=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_id='$subject_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$subject_url=$fetch_query['subject_url']; 
							
								$response['response']=181; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Sub-topic Registered Successfully!"; 	 
								$response['exam_id']=$exam_id;  
								$response['subject_id']=$subject_id;
								$response['topic_id']=$topic_id;
								$response['exam_url']=$exam_url;
								$response['subject_url']=$subject_url;
								$response['sub_topic_id']=$sub_topic_id;
								$response['sub_topic_logo']=$sub_topic_logo;
								$response['sub_topic_url']=$sub_topic_url;
							} // end if 4
						}// end if 3
					}else{//else if 2
						$query=mysqli_query($conn,"SELECT sub_topic_name FROM sub_topic_tab WHERE sub_topic_name='$sub_topic_name' AND sub_topic_id!='$sub_topic_id' AND exam_id!='$exam_id' LIMIT 1");
						$check=mysqli_num_rows($query);
						if ($check>0){ ///start if 5
							$response['response']=182; 
							$response['result']=false;
							$response['message1']="ERROR!"; 
							$response['message2']="Sub Topic Name Already Exist!"; 							
						}else{  // else if 5
							$urlcheck=mysqli_query($conn,"SELECT sub_topic_url FROM sub_topic_tab WHERE sub_topic_url='$sub_topic_url' AND sub_topic_id!='$sub_topic_id' AND exam_id!='$exam_id' LIMIT 1");
							$check=mysqli_num_rows($urlcheck);
							if ($check>0){ ///start if 6
								$response['response']=183; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Sub Topic URL Already Exist!"; 
							}else{// else if 6	
								$db_url_query=mysqli_query($conn,"SELECT sub_topic_url FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($db_url_query);
								$db_sub_topic_url=$fetch_query['sub_topic_url']; 
						
								mysqli_query($conn,"UPDATE sub_topic_tab SET sub_topic_name='$sub_topic_name', sub_topic_url='$sub_topic_url', subscription_price='$subscription_price', seo_keywords='$seo_keywords', seo_description='$seo_description', subscription_duration_id='$subscription_duration_id', status_id='$status_id' WHERE sub_topic_id='$sub_topic_id'")or die ("cannot update sub_topic_tab");
					
								if ($new_sub_topic_pix!=''){
								$query=mysqli_query($conn,"SELECT sub_topic_passport FROM sub_topic_tab WHERE sub_topic_id = '$sub_topic_id'");
								$fetch_query=mysqli_fetch_array($query);
								$old_sub_topic_passport=$fetch_query['sub_topic_passport'];
								$response['old_sub_topic_passport']=$old_sub_topic_passport; 
						
								$extension = pathinfo($new_sub_topic_pix, PATHINFO_EXTENSION);
								$sub_topic_logo = $sub_topic_id.'_'.uniqid().'.'.$extension;
								mysqli_query($conn,"UPDATE sub_topic_tab SET sub_topic_passport='$sub_topic_logo' WHERE sub_topic_id='$sub_topic_id'")or die ("cannot update sub_topic_tab");
								$response['sub_topic_logo']=$sub_topic_logo; 
								}

								$query=mysqli_query($conn,"SELECT * FROM exam_tab a, topic_tab b WHERE a.exam_id=b.exam_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$exam_id=$fetch_query['exam_id']; 
								$exam_url=$fetch_query['exam_url']; 

								$query=mysqli_query($conn,"SELECT subject_url FROM subject_tab WHERE subject_id='$subject_id'") or die (mysqli_error($conn));
								$fetch_query=mysqli_fetch_array($query);
								$subject_url=$fetch_query['subject_url']; 

								$response['response']=184; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Sub Topic Updated Successfully!"; 
								$response['sub_topic_id']=$sub_topic_id;
								$response['sub_topic_url']=$sub_topic_url;	
								$response['db_sub_topic_url']=$db_sub_topic_url;
								$response['exam_url']=$exam_url;
								$response['subject_url']=$subject_url;	
								$response['exam_id']=$exam_id;
								$response['topic_id']=$topic_id;					
							}// end if 6
						}// end if 5							
					} //end if 2
				} //end if 1
			break;



			case 'fetch_sub_topic_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(sub_topic_name like '%$search_txt%')";
		
				/// write sql statement and function that will return all sub topic here
				if ($sub_topic_id=='') {//start if 1
					$query=mysqli_query($conn,"SELECT 
					a.*, b.status_name,
					(SELECT COUNT(c.video_id) FROM sub_topic_video_tab c WHERE c.sub_topic_id=a.sub_topic_id AND c.topic_id=a.topic_id AND c.status_id=1) AS total_sub_topic_video_count
					FROM sub_topic_tab a, setup_status_tab b 
					WHERE topic_id LIKE '%$topic_id%' 
					AND a.status_id=b.status_id 
					ORDER BY sub_topic_name ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=185;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 2
						$response['response']=186;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 3
						$query=mysqli_query($conn,"SELECT topic_name FROM topic_tab WHERE topic_id='$topic_id'") or die (mysqli_error($conn));
						$fetch_query=mysqli_fetch_array($query);
						$topic_name=$fetch_query['topic_name']; 
						$response['topic_name']=$topic_name;
				}else{///else if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM sub_topic_tab a, setup_status_tab b WHERE a.sub_topic_id LIKE '%$sub_topic_id%' AND a.topic_id LIKE '%$topic_id%' AND a.status_id=b.status_id AND a.status_id LIKE '%$status_id%'")or die (mysqli_error($conn));
					$response['response']=187;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
						$response['data']=$fetch_query;
					} 
				} //end if 1		
			break;



			case 'delete_sub_topic_api':
				$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
				$check=mysqli_query($conn,"SELECT status_id FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_assoc($check);
				$response['data']=$fetch_query; 
				$status_id=$fetch_query['status_id']; 

				if($status_id==1){ //// start if 1
					//// user is activated
					$response['response']=188;
					$response['result']=false;
					$response['message']="Sub Topic cannot be deleted! Sub Topic is still active";
				}else if($status_id==2){ //// else 1
					//// user is suspended
					mysqli_query($conn,"DELETE FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));
					$response['response']=189;
					$response['result']=true;
					$response['message']="Sub Topic deleted Successfully"; 
				}// End if 1
			break;



			case 'add_or_update_sub_topic_video_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
				$video_id =trim(strtoupper($_POST['video_id']));
				$video_title = str_replace("'", "\\'", strtoupper(trim($_POST['video_title'])));
				$video_objective=trim((str_replace("'", "\\'", $_POST['video_objective'])));
				$video_duration =trim(strtolower($_POST['video_duration']));
				$video=$_FILES['video']['name']; 
				$new_video_pix=$_FILES['video_logo']['name']; //// exam passport value
				$video_volume_id =$_POST['video_volume_id'];
				$subscription_pricing_id=trim($_POST['subscription_pricing_id']);
				$status_id=trim($_POST['status_id']);
				
				if(($video_title=='')||($video_objective=='')||($video_duration=='')||($video_volume_id =='')||($subscription_pricing_id=='')||($status_id=='')){ ///start if 1
					$response['response']=190; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{ ///else if 1
					if($video_id==''){ ///start if 2
						$query=mysqli_query($conn,"SELECT video_title, sub_topic_id FROM sub_topic_video_tab WHERE video_title='$video_title' AND sub_topic_id='$sub_topic_id'");
						$check=mysqli_num_rows($query);
						if ($check>0){ ///start if 3
							$response['response']=191; 
							$response['result']=False;
							$response['message1']="ERROR!"; 
							$response['message2']="Video Title Already Exist!"; 						
						}else{ ///else if 3
							$volumecheck=mysqli_query($conn,"SELECT video_volume_id, sub_topic_id FROM sub_topic_video_tab WHERE video_volume_id='$video_volume_id' AND sub_topic_id='$sub_topic_id'");
							$check=mysqli_num_rows($volumecheck);
							if ($check>0){ ///start if 4
								$response['response']=192; 
								$response['result']=false;
								$response['message1']="Video Volume Already Exist!"; 
								$response['message2']="Select Next Video Volume!"; 
							}else{ //else if 4

								///////////////////////geting sequence//////////////////////////
								$counter_id='VIDEO';
								$sequence=$callclass->_get_sequence_count($conn, $counter_id);
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate sub topic_id //// 
								$video_id='VIDEO'.$no.date("Ymdhis");
								/// register sub topic ////

								///////////////////////generate exam_pix//////////////////////////
								$extension = pathinfo($new_video_pix, PATHINFO_EXTENSION);
								$video_logo = $video_id.'_'.uniqid().'.'.$extension;

								///////////////////////generate exam_pix//////////////////////////
								$extension = pathinfo($video, PATHINFO_EXTENSION);
								$video = $video_id.'_'.uniqid().'.'.$extension;

								///////////////////////check if sub_topic_pix is empty//////////////////
								If($new_video_pix==''){
									$video_logo= 'default_pix.jpg';
								}

								mysqli_query($conn,"INSERT INTO `sub_topic_video_tab`
								(`topic_id`, `sub_topic_id`, `video_id`, `video_title`, `video_objective`, `video_duration`, `video`, `subscription_pricing_id`, `video_passport`, `video_volume_id`, `status_id`, `created_time`) VALUES
								('$topic_id', '$sub_topic_id', '$video_id', '$video_title', '$video_objective', '$video_duration', '$video', '$subscription_pricing_id', '$video_logo', '$video_volume_id', '$status_id', NOW())")or die (mysqli_error($conn));

								$response['response']=193; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Video Registered Successfully!"; 	 
								$response['topic_id']=$topic_id;
								$response['sub_topic_id']=$sub_topic_id;
								$response['video_id']=$video_id;
								$response['video_logo']=$video_logo;
								$response['video']=$video;
							} ///end if 4
						}// end if 3
					}else{ ///else if 2
						$query=mysqli_query($conn,"SELECT video_title FROM sub_topic_video_tab WHERE video_title='$video_title' AND video_id!='$video_id' LIMIT 1");
						$check=mysqli_num_rows($query);
						if ($check>0){ ///start if 5
							$response['response']=194; 
							$response['result']=false;
							$response['message1']="ERROR!"; 
							$response['message2']="Sub Topic Name Already Exist!"; 							

						}else{ // else if 5
							$urlcheck=mysqli_query($conn,"SELECT sub_topic_url FROM sub_topic_tab WHERE sub_topic_url='$sub_topic_url' AND sub_topic_id!='$sub_topic_id' LIMIT 1");
							$check=mysqli_num_rows($urlcheck);
							if ($check>0){ ///start if 6
								$response['response']=195; 
								$response['result']=false;
								$response['message1']="ERROR!"; 
								$response['message2']="Sub Topic URL Already Exist!"; 
							}else{ //else if 6
								$volumecheck=mysqli_query($conn,"SELECT video_volume_id FROM sub_topic_video_tab WHERE video_volume_id='$video_volume_id' AND video_id!='$video_id' AND sub_topic_id='$sub_topic_id' LIMIT 1");
								$check=mysqli_num_rows($volumecheck);
								if ($check>0){ ///start if 7
									$response['response']=196; 
									$response['result']=false;
									$response['message1']="Video Volume Already Exist!"; 
									$response['message2']="Select Next Video Volume!"; 
								}else{ ///else if 7

									mysqli_query($conn,"UPDATE sub_topic_video_tab SET video_title ='$video_title', video_objective ='$video_objective', video_duration='$video_duration', video_volume_id ='$video_volume_id', subscription_pricing_id='$subscription_pricing_id', status_id='$status_id' WHERE video_id='$video_id'")or die ("cannot update sub_topic_tab");
						
									if ($new_video_pix!=''){
										$query=mysqli_query($conn,"SELECT video_passport FROM sub_topic_video_tab WHERE video_id = '$video_id'");
										$fetch_query=mysqli_fetch_array($query);
										$old_video_passport=$fetch_query['video_passport'];
									
										$extension = pathinfo($new_video_pix, PATHINFO_EXTENSION);
										$video_logo = $video_id.'_'.uniqid().'.'.$extension;
										mysqli_query($conn,"UPDATE sub_topic_video_tab SET video_passport='$video_logo' WHERE video_id='$video_id'")or die ("cannot update sub_topic_tab");
										$response['video_logo']=$video_logo; 
									}

									if ($video!=''){
										$query=mysqli_query($conn,"SELECT video FROM sub_topic_video_tab WHERE video_id ='$video_id'");
										$fetch_query=mysqli_fetch_array($query);
										$old_video=$fetch_query['video'];
								
										$extension = pathinfo($video, PATHINFO_EXTENSION);
										$video = $video_id.'_'.uniqid().'.'.$extension;
										mysqli_query($conn,"UPDATE sub_topic_video_tab SET video='$video' WHERE video_id='$video_id'")or die ("cannot update sub_topic_video_tab");
										$response['video']=$video; 
									}

									$response['response']=197; 
									$response['result']=true;
									$response['message1']="SUCCESS!"; 
									$response['message2']="Video Updated Successfully!";
									$response['topic_id']=$topic_id;
									$response['sub_topic_id']=$sub_topic_id;
									$response['video_id']=$video_id; 
									$response['video']=$video;
									$response['old_video']=$old_video;
									$response['video_logo']=$video_logo;
									$response['old_video_passport']=$old_video_passport;		
								} ///end if 7
							}//end if 6	
						}// end if 5								
					} //end if 2
				} ///end if 1
			break;




			case 'fetch_sub_topic_video_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));
				$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
				$video_id=trim(strtoupper($_POST['video_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(a.video_title like '%$search_txt%' OR 
				b.video_volume_name like '%$search_txt%')";

				/// write sql statement and function that will return all subject here
				if ($video_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT a.*, b.video_volume_name, c.subscription_pricing_name, d.status_name FROM sub_topic_video_tab a, setup_video_volume_tab b, setup_subscription_pricing_tab c, setup_status_tab d WHERE a.sub_topic_id LIKE '%$sub_topic_id%' AND a.topic_id LIKE '%$topic_id%' AND a.status_id LIKE '%$status_id%' AND a.video_volume_id=b.video_volume_id AND a.subscription_pricing_id=c.subscription_pricing_id AND a.status_id=d.status_id AND $search_like ORDER BY video_volume_id ASC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=198;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
						}
					}else{ // Else if 2
						$response['response']=199;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
					////// get sub_topic_name
					$query=mysqli_query($conn,"SELECT * FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));
					$fetch_array=mysqli_fetch_array($query);
					$response['sub_topic_name']=$fetch_array['sub_topic_name']; 
					////// get topic_name
					$query=$callclass->_get_topic_detail($conn, $topic_id);
					$fetch_array = json_decode($query, true);
					$exam_id= $fetch_array[0]['exam_id']; 
					$subject_id= $fetch_array[0]['subject_id']; 
					$response['topic_name']= $fetch_array[0]['topic_name']; 
					//////// get subject_name
					$query=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_id='$subject_id' ")or die (mysqli_error($conn));
					$fetch_array=mysqli_fetch_array($query);
					$response['subject_name']=$fetch_array['subject_name'];
					 //////// get abbreviation
					$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id' ")or die (mysqli_error($conn));
					$fetch_array=mysqli_fetch_array($query);
					$response['abbreviation']=$fetch_array['abbreviation']; 

				}else{///else if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name, c.video_volume_name, d.subscription_pricing_name FROM sub_topic_video_tab a, setup_status_tab b, setup_video_volume_tab c, setup_subscription_pricing_tab d WHERE a.video_id LIKE '%$video_id%' AND a.sub_topic_id LIKE '%$sub_topic_id%' AND a.status_id=b.status_id AND a.video_volume_id=c.video_volume_id AND a.subscription_pricing_id=d.subscription_pricing_id AND a.status_id LIKE '%$status_id%'")or die (mysqli_error($conn));
					$response['response']=200;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					} 
					$query=mysqli_query($conn,"SELECT sub_topic_name FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id'")or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$sub_topic_name=$fetch_query['sub_topic_name'];
					$response['sub_topic_name']=$sub_topic_name; 
				} //end if 1
			break;


		


			case 'change_password_api':
				$old_password=md5(trim($_POST['old_password']));
				$new_password=md5(trim($_POST['new_password']));

				$query=mysqli_query($conn, "SELECT `password` FROM staff_tab WHERE `password`='$old_password' AND staff_id='$login_staff_id' ") or die('cannot select password from staff_tab');
				$check_pass=mysqli_num_rows($query);
				if ($check_pass>0){ // start if 1
					$fetch_query=mysqli_fetch_array($query);
					$staff_id=$fetch_query['staff_id']; 
					$access_key=md5($staff_id.date("Ymdhis"));

					mysqli_query($conn,"UPDATE staff_tab SET `password`='$new_password',`access_key`='$access_key' WHERE staff_id='$login_staff_id'")or die ("cannot update staff_tab");
					$response['response']=201;
					$response['result']=true;
					$response['message1']='PASSWORD CHANGED';
					$response['message2']='Successfully';
				}else{ // else if 1
					$response['response']=202;
					$response['result']=false;
					$response['message1']='OLD PASSWORD ERROR!';
					$response['message2']='Old Password Not Correct';
				}// end if 1
			break;





			case 'add_or_update_faq_api':
				$cat_id=trim(strtoupper($_POST['cat_id']));
				$faq_id=trim(strtoupper($_POST['faq_id']));
				$faq_question=trim((str_replace("'", "\'", $_POST['faq_question'])));
				$faq_answer=trim((str_replace("'", "\'", $_POST['faq_answer'])));
				$status_id=trim($_POST['status_id']);

				if(($faq_question=='')||($faq_answer=='')||($status_id=='')){ ///start if 1
					$response['response']=203; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{ ///else if 1
					if($faq_id==''){ ///start if 2
			
						///////////////////////geting sequence//////////////////////////
						$counter_id='FAQ';
						$sequence=$callclass->_get_sequence_count($conn, $counter_id);
						$array = json_decode($sequence, true);
						$no= $array[0]['no'];
						
						/// generate faq id //// 
						$faq_id='FAQ'.$no.date("Ymdhis");
						/// register faq ////

						mysqli_query($conn,"INSERT INTO `faq_tab`
						(`cat_id`, `faq_id`, `faq_question`, `faq_answer`, `status_id`, `created_time`) VALUES
						('$cat_id', '$faq_id', '$faq_question', '$faq_answer', '$status_id', NOW())")or die (mysqli_error($conn));

						$response['response']=204; 
						$response['result']=true;
						$response['message1']="SUCCESS!"; 
						$response['message2']="FAQ Registered Successfully!"; 	 
						$response['faq_id']=$faq_id;  									
					}else{ ///else if 2 									
						mysqli_query($conn,"UPDATE faq_tab SET cat_id='$cat_id', faq_question='$faq_question', faq_answer='$faq_answer', status_id='$status_id' WHERE faq_id='$faq_id'")or die ("cannot update faq_tab");
						$response['response']=205; 
						$response['result']=true;
						$response['message1']="SUCCESS!"; 
						$response['message2']="FAQ Updated Successfully!"; 
						$response['faq_id']=$faq_id;
					} ///end if 2		
				} //end if 1						
			break;


			case 'fetch_faq_api':
				$faq_id=trim(strtoupper($_POST['faq_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(faq_question like '%$search_txt%')";

				/// write sql statement and function that will return all faq here
				if ($faq_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT * FROM faq_tab WHERE status_id LIKE '%$status_id%' AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=206;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
						}
					}else{ // Else if 2
						$response['response']=207;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
				}else {///else if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM faq_tab a, setup_status_tab b  WHERE a.faq_id LIKE '%$faq_id%' AND a.status_id =b.status_id AND a.status_id LIKE '%$status_id%' AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
					$response['response']=208;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					} 
				} //end if 1
			break;

			
			case 'add_and_update_blog':
				$staff_id=trim(strtoupper($_POST['staff_id']));
				$cat_id = $_POST['cat_id'];
				$blog_id = $_POST['blog_id'];
				$blog_title =str_replace("'", "\'", $_POST['blog_title']);
				$blog_url = str_replace("'", "\\'", strtolower(trim($_POST['blog_url'])));
				$seo_keywords =str_replace("'", "\'", $_POST['seo_keywords']);
				$blog_summary = str_replace("'", "\'", $_POST['blog_summary']);
				$blog_detail = str_replace("'", "\'", $_POST['blog_detail']);
				$new_blog_pix=$_FILES['blog_photo']['name']; //// exam passport value
				$status_id=trim($_POST['status_id']);

				if(($cat_id=='')||($blog_title=='')||($seo_keywords=='')||($blog_summary=='')||($blog_title=='')||($blog_detail=='')||($status_id=='')){ ///start if 1
					$response['response']=209; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Some Fields are empty!"; 
				}else{ ///else if 1
					if($blog_id==''){ ///start if 2
						$urlcheck=mysqli_query($conn,"SELECT blog_url FROM blog_tab WHERE blog_url='$blog_url'");
						$check=mysqli_num_rows($urlcheck);
						if ($check>0){ ///start if 3
							$response['response']=210; 
							$response['result']=False;
							$response['message1']="ERROR!"; 
							$response['message2']="Blog URL Already Exist!"; 						
						}else{ ///else if 3

							///////////////////////geting sequence//////////////////////////
							$counter_id='BLOG';
							$sequence=$callclass->_get_sequence_count($conn, $counter_id);
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							
							/// generate Blog id //// 
							$blog_id='BLOG'.$no.date("Ymdhis");
							/// register Blog ////
							
							///////////////////////generate exam_pix//////////////////////////
							$extension = pathinfo($new_blog_pix, PATHINFO_EXTENSION);
							$blog_photo = $blog_id.'_'.uniqid().'.'.$extension;

							If($new_blog_pix==''){
								$blog_photo= 'default_pix.jpg';
							}

							mysqli_query($conn,"INSERT INTO `blog_tab`
							(`cat_id`, `blog_id`, `blog_title`, `blog_url`, `seo_keywords`, `blog_summary`, `blog_detail`, `status_id`, `blog_pix`, `staff_id`, `created_time`, `updated_time`) VALUES 
							('$cat_id', '$blog_id', '$blog_title', '$blog_url', '$seo_keywords', '$blog_summary', '$blog_detail', '$status_id', '$blog_photo', '$login_staff_id', NOW(), NOW())")or die (mysqli_error($conn));
						
							$response['response']=211; 
							$response['result']=true;
							$response['message1']="SUCCESS!"; 
							$response['message2']="BLOG Registered Successfully!"; 	 
							$response['blog_id']=$blog_id;
							$response['blog_photo']=$blog_photo;  	
							$response['blog_url']=$blog_url;  								
						}// end if 3
					}else{ ///else if 2 	
						$blogcheck=mysqli_query($conn,"SELECT blog_url FROM blog_tab WHERE blog_id='$blog_id'") or die (mysqli_error($conn));
						$fetch_query=mysqli_fetch_array($blogcheck);
						$db_blog_url=$fetch_query['blog_url']; 

						mysqli_query($conn,"UPDATE blog_tab SET cat_id='$cat_id', blog_title='$blog_title', blog_url='$blog_url', seo_keywords='$seo_keywords', blog_summary='$blog_summary', blog_detail='$blog_detail', status_id='$status_id' WHERE blog_id='$blog_id'")or die ("cannot update faq_tab");
			
						if ($new_blog_pix!=''){
							$query=mysqli_query($conn,"SELECT blog_pix FROM blog_tab WHERE blog_id = '$blog_id'");
							$fetch_query=mysqli_fetch_array($query);
							$old_blog_pix=$fetch_query['blog_pix'];
							$response['old_blog_pix']=$old_blog_pix; 
					
							$extension = pathinfo($new_blog_pix, PATHINFO_EXTENSION);
							$blog_photo = $blog_id.'_'.uniqid().'.'.$extension;
							mysqli_query($conn,"UPDATE blog_tab SET blog_pix='$blog_photo' WHERE blog_id='$blog_id'")or die ("cannot update blog_tab");
							$response['blog_photo']=$blog_photo; 
						}

						$response['response']=212; 
						$response['result']=true;
						$response['message1']="SUCCESS!"; 
						$response['message2']="BLOG Updated Successfully!"; 
						$response['blog_id']=$blog_id;
						$response['blog_photo']=$blog_photo;
						$response['old_blog_pix']=$old_blog_pix;
						$response['blog_url']=$blog_url;
						$response['db_blog_url']=$db_blog_url;
					} ///end if 2		
				}//end if 1
			break;


			case 'fetch_blog_api':
				$blog_id=trim(strtoupper($_POST['blog_id']));
				$status_id=($_POST['status_id']);
				$search_txt=($_POST['search_txt']);

				$search_like="(blog_title like '%$search_txt%')";

				// write sql statement and function that will return all blogs here
				if ($blog_id=='') {///start if 1
					$query=mysqli_query($conn,"SELECT a.*, b.status_name FROM blog_tab a, setup_status_tab b WHERE a.status_id=b.status_id AND b.status_id LIKE '%$status_id%' AND $search_like ")or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 2
						$response['response']=213;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 2
						$response['response']=214;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 2
				}else{///else 1
					$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE blog_id LIKE '%$blog_id%' AND status_id LIKE '%$status_id%' AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
					$response['response']=215;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
					}
				} //end if 1
			break;

			case 'fetch_dashboard_count_api':
				$query=mysqli_query($conn,"SELECT
				(SELECT COUNT(staff_id) FROM staff_tab WHERE status_id=1) AS total_active_staff,
				(SELECT COUNT(user_id) FROM user_tab WHERE status_id=1) AS total_active_user,
				(SELECT COUNT(subject_id) FROM subject_tab WHERE status_id=1) AS total_active_subject,
				(SELECT COUNT(exam_id) FROM exam_tab WHERE status_id=1) AS total_active_exam,
				(SELECT COUNT(blog_id) FROM blog_tab WHERE status_id=1) AS total_active_blog,
				(SELECT COUNT(faq_id) FROM faq_tab WHERE status_id=1) AS total_active_faq");
				$response['response']=216;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
					$response['data']=$fetch_query;
				} 
			break;

			

			

			case 'update_user_api':
				$user_id=trim(strtoupper($_POST['user_id']));
				$fullname=trim(strtoupper($_POST['fullname']));
				$mobile=trim($_POST['mobile']);
				$email=trim($_POST['email']);
	
				$status_id=trim($_POST['status_id']);
				
				if(($fullname=='')||($mobile=='')||($email=='')||($status_id=='')){ ///start if 1
					$response['response']=217; 
					$response['result']=False;
					$response['message1']="ERROR!"; 
					$response['message2']="Fill all fields to continue."; 
				}else{ ///else if 1
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){ ///start if 2
						$usercheck=mysqli_query($conn,"SELECT email FROM user_tab WHERE email='$email' AND user_id!='$user_id' LIMIT 1");
						$useremail=mysqli_num_rows($usercheck);
						if ($useremail>0){ ///start if 3
							$response['response']=218; 
							$response['result']=false;
							$response['message1']="EMAIL ERROR!"; 
							$response['message2']="Email already been used.";
						}else{ ///else if 3
							mysqli_query($conn,"UPDATE user_tab SET fullname='$fullname', mobile='$mobile', email='$email', status_id='$status_id' WHERE user_id='$user_id'") or die (mysqli_error($conn));
							$response['response']=219; 
							$response['result']=true;
							$response['message1']="SUCCESS!"; 
							$response['message2']="User Updated Successfully.";
							$response['user_id']=$user_id; 
						} ///end if 3
					}else{ ///else if 2
						$response['response']=220; 
						$response['result']=false;
						$response['message']="ERROR: $email is NOT an email address"; 
						$response['message1']="EMAIL ERROR!"; 
						$response['message2']="Not valid email address";
					} ///end if 2
				} //end if 1
			break;







			






			case 'fetch_wallet_history_api':
				$user_id=trim(strtoupper($_POST['user_id']));
				$view_report=trim($_POST['view_report']);
	
				if ($view_report=='custom_search'){///////////

					$datefrom=$_POST['datefrom'];
					$dateto=$_POST['dateto'];
					/// get db date
					$db_day30= date('Y-m-d', strtotime($datefrom));
					$db_today= date('Y-m-d', strtotime($dateto));
				}else{
					$db_day30 = date('Y-m-d', strtotime('today - 30 days'));
					$db_today = date('Y-m-d');
				}
   
				$pay_query=mysqli_query($conn,"SELECT a.*, b.transaction_type_name,
				c.status_name,
				(SELECT COUNT(d.payment_id) FROM user_wallet_tab d WHERE d.user_id='$user_id') as count_all
				FROM user_wallet_tab a, setup_transaction_type_tab b, setup_status_tab c  
				WHERE a.transaction_type_id=b.transaction_type_id AND a.status_id=c.status_id
				AND  a.user_id='$user_id' AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date DESC")or die (mysqli_error($conn));		
				$count=mysqli_num_rows($pay_query);
				if ($count>0){///start if 1
					
					$response['response']=221;
					$response['result']=true;
					while($fetch_query_pay=mysqli_fetch_all($pay_query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query_pay;
					}

					$user_array=$callclass->_get_user_detail($conn, $user_id);
					$user_array = json_decode($user_array, true);
					$wallet_balance= $user_array[0]['wallet_balance'];
					$response['wallet_balance']=$wallet_balance;
			
	
					$wallet_array=$callclass->_get_user_wallet_detail($conn, $user_id);
					$wallet_fetch = json_decode($wallet_array, true);
					$amount_received= $wallet_fetch[0]['amount_received'];
					$amount_withdraw= $wallet_fetch[0]['amount_withdraw'];
	
					$response['amount_received']=$amount_received;
					$response['amount_withdraw']=$amount_withdraw;
		
				}else{///else 2
					$response['response']=222;
					$response['result']=false;
					$response['message']='NO RECORD FOUND!';
						
				} //enf if 2
					
			break;




			case 'fetch_subscription_api':
				$user_id=trim(strtoupper($_POST['user_id']));
				$view_report=trim($_POST['view_report']);

					if ($view_report=='custom_search'){/////////
					
						$datefrom=$_POST['datefrom'];
						$dateto=$_POST['dateto'];
					
						/// get db date
						$db_day30= date('Y-m-d', strtotime($datefrom));
						$db_today= date('Y-m-d', strtotime($dateto));
					}else{
						$db_day30 = date('Y-m-d', strtotime('today - 30 days'));
						$db_today = date('Y-m-d');
					}


					$select_query="SELECT a.*, b.abbreviation, b.exam_passport, c.subject_name, d.topic_name, e.sub_topic_name, g.status_name,
					(SELECT COUNT(h.sub_topic_id) FROM user_subscription_tab h WHERE h.user_id='$user_id' AND (date(h.date) BETWEEN '$db_day30' AND '$db_today')) as count_all 
					FROM user_subscription_tab a, exam_tab b, subject_tab c, topic_tab d,  sub_topic_tab e,  exam_subject_tab f, setup_status_tab g 
					WHERE
					b.exam_id=f.exam_id AND d.exam_id=f.exam_id 
					AND c.subject_id=f.subject_id AND e.subject_id=f.subject_id  
					AND d.topic_id=e.topic_id AND e.sub_topic_id=a.sub_topic_id 
					AND a.status_id=g.status_id AND a.user_id='$user_id'";

					$query=mysqli_query($conn,$select_query. "AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date DESC");
					$count=mysqli_num_rows($query);
					if ($count>0){///start if 1
						$response['response']=223;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
								
					}else{///else 2
						$response['response']=224;
						$response['result']=false;
						$response['message']='NO RECORD FOUND!';
							
					} //enf if 2
						
			break;




			case 'fetch_transaction_history_api':
				$user_id=trim(strtoupper($_POST['user_id']));
				$payment_id=trim(strtoupper($_POST['payment_id']));
				
				$view_report=trim($_POST['view_report']);

				if ($view_report=='custom_search'){
					
					$datefrom=$_POST['datefrom'];
					$dateto=$_POST['dateto'];
					/// get db date
					$db_day30= date('Y-m-d', strtotime($datefrom));
					$db_today= date('Y-m-d', strtotime($dateto));
				}else{
					$db_day30 = date('Y-m-d', strtotime('today - 30 days'));
					$db_today = date('Y-m-d');
				}
		

				$select_query="SELECT 
				a.*, b.transaction_type_name, 
				c.status_name, d.fund_method_name,
				(SELECT COUNT(f.payment_id) FROM payment_tab f WHERE f.user_id='$user_id' AND (date(f.date) BETWEEN '$db_day30' AND '$db_today')) as count_all
				FROM payment_tab a, setup_transaction_type_tab b, setup_status_tab c, setup_fund_method_tab d, sub_topic_tab e 
				WHERE a.sub_topic_id=e.sub_topic_id AND a.transaction_type_id=b.transaction_type_id AND a.fund_method_id=d.fund_method_id AND a.status_id=c.status_id  AND a.user_id='$user_id'";		

										
				if($payment_id==''){				
					$pay_query=mysqli_query($conn,$select_query. "AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date DESC")or die (mysqli_error($conn));
					$count=mysqli_num_rows($pay_query);
					if ($count>0){
						$response['response']=225;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($pay_query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{
						$response['response']=226;
						$response['result']=false;
						$response['message']='NO RECORD FOUND!';
					}
							
				}else{///else 2
					
					$pay_query=mysqli_query($conn,$select_query. " AND a.payment_id='$payment_id'")or die (mysqli_error($conn));
					$response['response']=227;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($pay_query)){
						$response['data']=$fetch_query;
					}

					$query=mysqli_query($conn,"SELECT sub_topic_id,status_id FROM payment_tab WHERE payment_id='$payment_id' AND user_id='$user_id'");
					$fetch_query=mysqli_fetch_array($query);
					$sub_topic_id=$fetch_query['sub_topic_id'];
					$status_id=$fetch_query['status_id'];
					if($status_id==5){
						$response['db_payment_status_id']=$status_id;
					}else{

					}

					$select_query2="SELECT
					a.*, 
					CASE
					WHEN b.sub_topic_id IS NOT NULL THEN 'yes'
					ELSE 'no'
					END AS subscription,
					b.start_date,
					b.due_date,
					c.abbreviation,
					d.subject_name,
					e.topic_name,
					f.status_name
					FROM sub_topic_tab a
					
					LEFT JOIN user_subscription_tab b ON a.sub_topic_id = b.sub_topic_id AND b.user_id='$user_id'
					
					LEFT JOIN topic_tab e ON a.topic_id= e.topic_id
					
					LEFT JOIN exam_subject_tab h ON a.subject_id= h.subject_id 
					
					LEFT JOIN subject_tab d ON h.subject_id= d.subject_id
					
					LEFT JOIN exam_tab c ON e.exam_id = c.exam_id AND h.exam_id=c.exam_id
					
					LEFT JOIN payment_tab g ON g.sub_topic_id = b.sub_topic_id AND b.user_id=g.user_id 
					
					LEFT JOIN setup_status_tab f ON b.status_id = f.status_id WHERE";


					$pay_query=mysqli_query($conn,$select_query2. " a.sub_topic_id='$sub_topic_id' LIMIT 1")or die (mysqli_error($conn));
					$response['response']=228;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_assoc($pay_query)){
						$response['data2']=$fetch_query;
					}
	
				} //enf if 2
		break;



		case 'fetch_setup_backend_settings_api':
			$backend_setting_id=trim(strtoupper($_POST['backend_setting_id']));
			$query=mysqli_query($conn,"SELECT * FROM setup_backend_settings_tab")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			$response['response']=229;
			$response['result']=true;
			while($fetch_query=mysqli_fetch_assoc($query)){
				$response['data']=$fetch_query;
			}
		break;



		case 'update_backend_settings_api':
			$backend_setting_id=trim(strtoupper($_POST['backend_setting_id']));
			$sender_name=($_POST['sender_name']);
			$smtp_host=trim($_POST['smtp_host']);
			$smtp_username=trim($_POST['smtp_username']);
			$smtp_password=trim($_POST['smtp_password']);
			$smtp_port=trim($_POST['smtp_port']);
			
			if(($sender_name=='')||($smtp_host=='')||($smtp_username=='')||($smtp_password=='')||($smtp_port=='')){ ///start if 1
				$response['response']=230; 
				$response['result']=False;
				$response['message1']="ERROR!"; 
				$response['message2']="Fill all fields to continue."; 
			}else{ ///else if 1
				mysqli_query($conn,"UPDATE setup_backend_settings_tab SET sender_name='$sender_name', smtp_host='$smtp_host', smtp_username='$smtp_username', smtp_password='$smtp_password', smtp_port='$smtp_port' WHERE backend_setting_id='BK_ID001'") or die (mysqli_error($conn));
				$response['response']=231; 
				$response['result']=true;
				$response['message1']="SUCCESS!"; 
				$response['message2']="Settings Updated Successfully.";
				$response['backend_setting_id']=$backend_setting_id; 
			} //end if 1
		break;







			


		}
	
	}//End if check//



}
echo json_encode($response);

?>





