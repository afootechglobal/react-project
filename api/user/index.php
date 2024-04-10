<?php require_once '../config/connection.php';?>
<?php require_once '../config/functions.php';?>
<?php
// Retrieve JSON data from the request body
// //$action = isset($_POST['action']) ? $_POST['action'] : null;
// $action = isset($_POST['action']) ? $_POST['action'] : null;
	$_POST = json_decode(file_get_contents('php://input'), true);
 	$action=$_POST['action'];
// $action=isset($_POST['action']) ? $_POST['action'] : null;
if (($action=='login_api') || ($action=='reset_password_api') || ($action=='resend_otp_api') || ($action=='confirm_otp_api')|| ($action=='fetch_all_exam_api')|| ($action=='user_regisration_api')|| ($action=='otp_authentication_api')){

	switch ($action){

		case 'login_api':
			$email=trim($_POST['email']);
			$password= md5(trim($_POST['password']));
			// $email = isset($_POST['email']) ? $_POST['email'] : null;
    		// $password = isset($_POST['password']) ? $_POST['password'] : null;
			if (($email!='') || ($password!='')) {// start if 4
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 1
					
					$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE email='$email' AND `password`='$password'") or die (mysqli_error($conn));
					$count_user=mysqli_num_rows($query);
	
						if ($count_user>0){ /// start if 3
							$fetch_query=mysqli_fetch_array($query);
							$user_id=$fetch_query['user_id']; 
							$status_id=$fetch_query['status_id']; 
								if($status_id==1) { /// start if 2 (check if the user is active)
									/// Generate login access key
									$access_key=md5($user_id.date("Ymdhis"));
									/// update user on user_tab
									mysqli_query($conn,"UPDATE user_tab SET access_key='$access_key', updated_time=NOW() WHERE user_id='$user_id'")or die ("cannot update access key - user_tab");
									
								
									$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE user_id='$user_id'")or die (mysqli_error($conn));
									$response['response']=131;
									$response['result']=true;
									while($fetch_query=mysqli_fetch_assoc($query)){
										$fullname=$fetch_query['fullname'];
										$response['fullname']=ucwords(strtolower($fullname));
										$response['data']=$fetch_query;
									}
									$response['response']=100; 
									$response['result']=true;
									$response['user_id']=$user_id;
									$response['access_key']=$access_key;
									$response['message1']="LOGIN SUCCESSFULLY!";
									$response['message2']="Redireting to the portal..."; 						
								}else if($status_id==2){/// else if 2
									$response['response']=101; 
									$response['result']=false;
									$response['message1']="USER SUSPENDED!"; 
									$response['message2']="Contact the admin for help.";
								}else{ //// else if 2
									$response['response']=102; 
									$response['result']=false;
									$response['message1']="PENDING ACCOUNT!"; 
									$response['message2']="Contact the admin for help."; 
								} /// end if 2
					
						}else{//// else if 3
							$response['response']=103; 
							$response['result']=false;
							$response['message1']="INVALID LOGIN PARAMETERS!"; 
							$response['message2']="Check email or password to continue.";
						}//// end if 3
				}else{ //// else if 1
					$response['action']=$action; 
					$response['email']=$email; 
					$response['password']=$password; 
					$response['response']=104; 
					$response['result']=false;
					$response['message1']="INVALID LOGIN PARAMETERS!"; 
					$response['message2']="Check email or password to continue."; 
				}/// end if 1
	
			}else{ /// else 4
				
				$response['response']=105; 
				$response['result']=false;
				$response['message1']="LOGIN ERROR!"; 
				$response['message2']="Fill this fields to continue."; 
			}/// end if 4
	break;
	
	
	
	
	
	
	
	
	case 'reset_password_api':
		$email=trim($_POST['email']);
		if($email!='')	{ // start if 4
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 1
					$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE email='$email'") or die (mysqli_error($conn));
					$count_user=mysqli_num_rows($query);
	
						if ($count_user>0){ /// start if 3
							$fetch_query=mysqli_fetch_array($query);
							$user_id=$fetch_query['user_id']; 
							$fullname=$fetch_query['fullname']; 
							$fullname=ucwords(strtolower($fullname));
							$status_id=$fetch_query['status_id'];
							
								if($status_id==1){ /// start if 2 (check if the user is active)
									/// Generate otp
									$otp = rand(111111,999999);
	
									/// update user on user_tab
									mysqli_query($conn,"UPDATE user_tab SET otp='$otp', updated_time=NOW() WHERE user_id='$user_id'")or die ("cannot update access key - user_tab");
									////// send otp to email
									$mail_to_send='send_reset_password_otp';
									require_once('mail/mail.php');	
	
									$response['response']=106; 
									$response['result']=true;
									$response['message1']="PROCEED!"; 
									$response['message2']="Continue to reset password"; 
									$response['user_id']=$user_id;
									$response['fullname']=ucwords(strtolower($fullname)); 
									$response['email']=$email;
									$response['otp']=$otp;
	
								}else if($status_id==2){/// else if 2
									$response['response']=107; 
									$response['result']=false;
									$response['message1']="USER SUSPENDED"; 
									$response['message2']="Contact the admin for help.";
	
								}else{ /// else if 2
									$response['response']=108;  
									$response['result']=false;
									$response['message2']="PENDING ACCOUNT!"; 
									$response['message2']="Contact the admin for help."; 
								} /// end if 2
					
						}else{/// else if 3
							$response['response']=109; 
							$response['result']=false;
							$response['message1']="INVALID EMAIL ADDRESS!"; 
							$response['message2']="Kindly, check your email or sign-up!"; 
						}/// end if 3

				}else{ /// else if 1
					$response['response']=110; 
					$response['result']=false;
					$response['message1']="EMAIL ERROR!"; 
					$response['message2']="Invalid email address!"; 
				}/// end if 1
	
	
			}else{ /// else 4
				$response['response']=111; 
				$response['result']=false;
				$response['message1']="EMAIL ERROR!"; 
				$response['message2']="Fill this field to continue!";  
			}/// end if 4

	break;
	
	
	
	
	
		case 'resend_otp_api':
			$user_id=trim($_POST['user_id']);

			$query=mysqli_query($conn,"SELECT user_id FROM user_tab WHERE user_id='$user_id'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);
				if($count_user>0){ // start if 1
					$user_array=$callclass->_get_user_detail($conn, $user_id);
					$u_array = json_decode($user_array, true);
					$fullname= $u_array[0]['fullname'];
					$fullname=ucwords(strtolower($fullname));
			
					$email= $u_array[0]['email'];
					/// Generate otp
					$otp = rand(111111,999999);
					/// update user on user_tab
					mysqli_query($conn,"UPDATE user_tab SET otp='$otp', updated_time=NOW() WHERE user_id='$user_id'")or die ("cannot update OTP - user_tab");
					
					////// send otp to email
					$mail_to_send='send_reset_password_otp';
					require_once('mail/mail.php');

					$response['response']=112; 
					$response['result']=true;
					$response['message1']="OTP SENT!";
					$response['message2']="Check your inbox or spam!";
				}else{ // else i
					$response['response']=113; 
					$response['result']=false;
					$response['message1']="USER ERROR!";
					$response['message2']="Cannot be empty";
				}// end if 1
				
		break;
	
	
	
	
		case 'confirm_otp_api':
			$user_id=trim($_POST['user_id']);
			$otp=trim($_POST['otp']);
			$password=md5($_POST['password']);
			
			$query=mysqli_query($conn,"SELECT user_id FROM user_tab WHERE user_id='$user_id'") or die (mysqli_error($conn));
			$get_user=mysqli_num_rows($query);
			if ($get_user>0){// start if 1
				
				if(($password=='')){ //start if 2
					$response['response']=114; 
					$response['result']=false;
					$response['message1']="PASSWORD ERROR!";
					$response['message2']="Fill this field to continue";
				}else{ // else 2
					if (is_numeric($otp)) { ///start if 3

						$query=mysqli_query($conn,"SELECT user_id, otp FROM user_tab WHERE user_id='$user_id' AND otp='$otp'") or die (mysqli_error($conn));
						$count_user=mysqli_num_rows($query);
						if ($count_user>0){ /// start if 4
							/// update user password
							mysqli_query($conn,"UPDATE user_tab SET `password`='$password', updated_time=NOW() WHERE user_id='$user_id'")or die (mysqli_error($conn));
							$response['response']=115; 
							$response['result']=true;
							$response['message1']="SUCCESS!";
							$response['message2']="Password Reset Successfully!";
						}else{/// else 4
							$response['response']=116; 
							$response['result']=false;
							$response['message1']="INVALID OTP PARAMETERS!";
							$response['message2']="Kindly, check your Gmail and try again";
					
						}/// end if 4

					}else{ // else 3
							$response['response']=117; 
							$response['result']=false;
							$response['message1']="OTP ERROR!";
							$response['message2']="Invalid OTP Parameters.";
					}/// end if 3
		
				}// end if 2
			} else { // else 1
				$response['response']=118; 
				$response['result']=false;
				$response['message1']="USER NOT EXIST!";
				$response['message2']="Please check and try again.";
			
			}// end if 1
		
		break;




		case 'fetch_all_exam_api':
				$query=mysqli_query($conn,"SELECT * FROM exam_tab WHERE status_id=1 ORDER BY exam_name ASC ")or die (mysqli_error($conn));	
				$fetch_query=mysqli_num_rows($query);
				if($fetch_query>0){
					$response['response']=119;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{
					$response['result']=false;
					$response['response']=120;
					$response['message1']="No Record Found!";
				}
				
		break;






		case 'otp_authentication_api':
			$fullname=trim($_POST['fullname']);
			$email=trim($_POST['email']);
				if($email==''){ // start if 1
					$response['response']=121; 
					$response['result']=false;
					$response['message1']="EMAIL ERROR!";
					$response['message2']="Fill this field to continue!";
				}else{ // else i
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 1
	
							$usercheck=mysqli_query($conn,"SELECT email FROM user_tab WHERE email='$email'");
							$useremail=mysqli_num_rows($usercheck);
							if ($useremail>0){ ///start if 3
								$response['response']=122; 
								$response['result']=False;
								$response['message1']="ACCOUNT ALREADY EXIST!"; 
								$response['message2']="Kindly, reset your password or login";
							} else { ///else 3

								$email_check=mysqli_query($conn,"SELECT email FROM user_verification_tab WHERE email='$email'");
								$check=mysqli_num_rows($email_check);
								/// Generate new otp
								$otp = rand(111111,999999);
								if($check>0){ // start if 2
									mysqli_query($conn,"UPDATE user_verification_tab SET otp='$otp', updated_time=NOW() WHERE email='$email'")or die (mysqli_error($conn));
								}else{ /// else 2
									/// insert into user_verification_tab
									mysqli_query($conn,"INSERT INTO `user_verification_tab`
									(`email`, `otp`, `created_time`) VALUES
									('$email','$otp', NOW())")or die (mysqli_error($conn));
							
								}// end if 2

								$response['response']=123; 
								$response['result']=true;
								$response['message1']="OTP SENT!";
								$response['message2']="Check your inbox or spam!";
								$response['otp']=$otp;
								$response['fullname']=ucwords(strtolower($fullname));
								$response['email']=$email;
								$fullname=ucwords(strtolower($fullname));
								////// send otp to email
								$mail_to_send='send_reset_password_otp';
								require_once('mail/mail.php');
							}	
						} else { // else 1
							$response['response']=124; 
							$response['result']=false;
							$response['message1']="INVALID EMAIL ADDRESS!";
							$response['message2']="Kindly, check your email and try again";
						
						}// end if 1
					
			}// end if 1
		
		break;






		case 'user_regisration_api':
			$fullname=trim(strtoupper($_POST['fullname']));
			$email=trim($_POST['email']);
			$mobile=trim($_POST['mobile']);
			$all_exam_id=$_POST['exam_id'];
			$password=md5($_POST['password']);
			$otp=$_POST['otp'];
		
			if (is_numeric($otp)){// start if 5
						$otpcheck=mysqli_query($conn,"SELECT otp FROM user_verification_tab WHERE otp='$otp' AND email='$email'");
						$check=mysqli_num_rows($otpcheck);
				if($check>0){ // start if 4

					if(($fullname=='')||($mobile=='')||($email=='')||($all_exam_id=='')||($password=='')||($otp=='')){ ///start if 1
						$response['response']=125; 
						$response['result']=False;
						$response['message1']="ERROR!"; 
						$response['message2']="Fill all fields to continue."; 
					}else{ ///else 1
						if(filter_var($email, FILTER_VALIDATE_EMAIL)){ ///start if 2
							
							$usercheck=mysqli_query($conn,"SELECT email FROM user_tab WHERE email='$email'");
							$useremail=mysqli_num_rows($usercheck);
							if ($useremail>0){ ///start if 3
								$response['response']=126; 
								$response['result']=False;
								$response['message1']="ACCOUNT ALREADY EXIST!"; 
								$response['message2']="Kindly, reset your password or login";
							}else{ ///else 3

								///////////////////////geting sequence//////////////////////////
								$sequence=$callclass->_get_sequence_count($conn, 'USER');
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								
								/// generate user_id and password 
								$user_id='USER'.$no.date("Ymdhis");
								
								/// register staff
								mysqli_query($conn,"INSERT INTO `user_tab`
								(`user_id`, `fullname`, `mobile`, `email`,`status_id`, `password`,`reg_otp`, `created_time`) VALUES
								('$user_id', '$fullname', '$mobile','$email','1', '$password','$otp', NOW())")or die (mysqli_error($conn));
						
								///////////////////////loop each subjects//////////////////
								$each_exam_ids = explode(',',$all_exam_id);
								foreach($each_exam_ids as $exam_id){	
									mysqli_query($conn,"INSERT INTO `user_exam_tab`
									(`user_id`, `exam_id`,`created_time`) VALUES
									('$user_id','$exam_id', NOW())")or die (mysqli_error($conn));								
								}
								$access_key=md5($user_id.date("Ymdhis"));
								/// update user on user_tab
								mysqli_query($conn,"UPDATE user_tab SET access_key='$access_key', updated_time=NOW() WHERE user_id='$user_id'")or die ("cannot update access key - user_tab");
								$response['response']=127; 
								$response['result']=true;
								$response['message1']="LOGIN SUCCESSFULLY!"; 
								$response['message2']="Redireting to the portal..."; 
								$response['user_id']=$user_id; 
								$response['access_key']=$access_key; 
								
							} ///end if 3
								
						}else{ ///else 2
							$response['response']=128; 
							$response['result']=false;
							$response['message1']="INVALID EMAIL ADDRESS!";
							$response['message2']="Kindly, check your email and try again";
						} ///end if 2
					
					} ///end if 1
				}else{ // else 4
					$response['response']=129; 
					$response['result']=false;
					$response['message1']="INVALID OTP PARAMETERS!"; 
					$response['message2']="Kindly, check your Gmail and try again";
				}// end if 4

			}else{/// else 5
				$response['response']=130; 
				$response['result']=false;
				$response['message1']="OTP ERROR!"; 
				$response['message2']="OTP only accept numbers";
			}//end if 5
		break;









	
	}

}else{
			$access_key=trim($_GET['access_key']);
			///////////auth/////////////////////////////////////////
			$fetch=$callclass->_user_validate_accesskey($conn,$access_key);
			$array = json_decode($fetch, true);
			$check=$array[0]['check'];
			$login_user_id=$array[0]['user_id'];
			$response['check']=$check; 
			
		if ($check==0) { /// start if check 
			$response['response']=99; 
			$response['result']=False;
			$response['message1']='Invalid AccessToken. Please LogIn Again.'; 
	  	} else {/// else if check 

			switch ($action){


			case 'fetch_user_api':
				// $user_id=trim(strtoupper($_POST['user_id']));
				$query=mysqli_query($conn,"SELECT * FROM user_tab  WHERE user_id='$login_user_id'  ")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1
						$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE user_id='$login_user_id'")or die (mysqli_error($conn));
						$response['response']=131;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_assoc($query)){
						$fullname=$fetch_query['fullname'];
						$response['fullname']=ucwords(strtolower($fullname));
						$response['data']=$fetch_query;
					} 
				} else {///else 1
					$response['user_id']=$login_user_id;
					$response['response']=132;
					$response['result']=false;
					$response['message1']="USER ERROR!"; 
					$response['message2']="User not exist"; 
				} //enf if 1
				
			break;


					

			case 'update_user_api':
				// $user_id=trim(strtoupper($_POST['user_id']));
				$fullname=trim(strtoupper($_POST['fullname']));
				$email= trim($_POST['email']);
				$mobile= trim($_POST['mobile']);
				
					$query=mysqli_query($conn,"SELECT user_id FROM user_tab WHERE user_id='$login_user_id' ")or die (mysqli_error($conn));
					$check=mysqli_num_rows($query);
				if($check>0){
						
					if(($fullname=='')||($email=='')||($mobile=='')){ ///start if 1
						$response['response']=133; 
						$response['result']=false;
						$response['message1']="ERROR!"; 
						$response['message2']="Fill all fields to continue!"; 
					}else{ ///else if 1
						$usercheck=mysqli_query($conn,"SELECT email FROM user_tab WHERE email='$email' AND user_id!='$login_user_id' ");
						$useremail=mysqli_num_rows($usercheck);
							if ($useremail>0){ ///start if 5
								$response['response']=134;
								$response['result']=false;
								$response['message1']="ACCOUNT EXIST!"; 
								$response['message2']="Email already used by someone!"; 
							} else {///else 1
								mysqli_query($conn,"UPDATE user_tab SET fullname='$fullname',email='$email',mobile='$mobile' WHERE user_id='$login_user_id'") or die (mysqli_error($conn));
						
								$response['response']=135; 
								$response['result']=true;
								$response['message1']="SUCCESS!"; 
								$response['message2']="Profile Updated Successfully!"; 
								$response['fullname']=ucwords(strtolower($fullname)); 
										
							}
					} ///end if 1
							
				}else{
					$response['response']=136; 
					$response['result']=false;
					$response['message1']="USER ERROR!"; 
					$response['message2']="User not valid!";
				}

			break;




			case 'get_passport_api':
				$user_id=trim(($_POST['user_id']));
		
				$user_array=$callclass->_get_user_detail($conn, $user_id);
				$u_array = json_decode($user_array, true);
				$db_passport= $u_array[0]['passport'];
				
				$response['response']=137;
				$response['result']=true;
				$response['user_id']=$user_id;
				$response['db_passport']=$db_passport;
			break;
		
		
		
			// case 'upload_passport_api':
			// 	$uploadDirectory = "../../alwaysonlineclasses.com/public/UploadedFiles/UserPix/";

			// 	if ($_FILES['passport']) {
			// 		$passport = $_FILES['passport'];

			// 		// Move the uploaded file to the destination directory
			// 		$destinationPath = $uploadDirectory . basename($passport['name']);

			// 		if (move_uploaded_file($passport['tmp_name'], $destinationPath)) {
			// 			$datetime = date("Ymdhi");
			// 			$extension = pathinfo($passport['name'], PATHINFO_EXTENSION);
			// 			$newFileName = $datetime . '_' . uniqid() . '.' . $extension;

			// 			// Rename the file
			// 			$newFilePath = $uploadDirectory . $newFileName;
			// 			rename($destinationPath, $newFilePath);

			// 			// Update database or perform other necessary actions

			// 			// Prepare response data
			// 			$response = [
			// 				'response' => 84,
			// 				'result' => true,
			// 				'message1' => 'PASSPORT UPLOAD',
			// 				'message2' => 'Successfully!',
			// 				'passport' => $newFileName,
			// 			];

			// 		} else {
			// 			// Handle file upload error
			// 			$response = [
			// 				'response' => 500,
			// 				'result' => false,
			// 				'message1' => 'Failed to upload file.',
			// 			];

			// 		}
			// 	} else {
			// 		// Handle no file provided error
			// 		$response = [
			// 			'response' => 400,
			// 			'result' => false,
			// 			'message1' => 'No file provided.',
			// 		];

			// 	}

			// break;
			


			case 'upload_passport_api':
			
				$passport = $_POST['passport'];
				$passport_pix = $_FILES['passport']['name'];

				 // Handle the file here
				 
				 $response['passport_pix'] = $passport_pix;
				 move_uploaded_file($_FILES['passport']['tmp_name'], 'user_pix/'.$passport_pix);
				// $tmpName = $_FILES['passport']['tmp_name'];
				// $datetime = date("Ymdhi");
				
				// // Assuming $login_user_id is defined somewhere in your code
				// // $user_array = $callclass->_get_staff($conn, $login_user_id);
				// // $u_array = json_decode($user_array, true);
				// // $db_passport = $u_array[0]['passport'];
				
				// // $response['db_passport'] = $db_passport;
				
				// $extension = pathinfo($passport, PATHINFO_EXTENSION);
				// $passport = $datetime . '_' . $login_user_id . '_' . uniqid() . '.' . $extension;
				
				//$newImageName = $uploadPath . $passport;
				// $passport='faf3831bbc96b4e360a1081fa3208122.jpg';
				//move_uploaded_file($tmpName, 'user_pix/'.$passport);
			
				mysqli_query($conn, "UPDATE `user_tab` SET passport='$passport' WHERE user_id='$login_user_id'")
					or die(mysqli_error($conn));
			
				$response['response'] = 84;
				$response['result'] = true;
				$response['message1'] = 'PASSPORT UPLOAD';
				$response['message2'] = 'Successfully!';
				$response['passport'] = $passport;
				
			break;
	
			
			case 'upload_passport_apiss':
	
				// Upload Profile Pix for first time login
				$passport=$_POST['passport'];
				$response['passport']=$passport;
				
				$datetime=date("Ymdhi");
					
				$extension = pathinfo($passport_pix, PATHINFO_EXTENSION);					
				$passport = $datetime.'_'.$user_id.'_'.uniqid().'.'.$extension;
		
				$response = [
					'response' => 84,
					'result' => true,
					'message1' => 'PASSPORT UPLOAD',
					'message2' => 'Successfully!',
					'passport' => $passport,
				];
			
				$response['user_id']=$login_user_id;
				//$response['passport']=$passport;
				
				mysqli_query($conn,"UPDATE `user_tab` SET passport='$passport' WHERE user_id='$user_id'")
				or die ("cannot update passport to user tab");
			

			
					// $file = $_POST['passport'];
				
					// $uploadDirectory = '../../alwaysonlineclasses.com/public/UploadedFiles/UserPix/'; // Set your folder path
					// $uploadedFilePath = $uploadDirectory . basename($file['name']);
				
					// if (move_uploaded_file($file['tmp_name'], $uploadedFilePath)) {
					// 				// Prepare response data
					// 	$response = [
					// 		'response' => 84,
					// 		'result' => true,
					// 		'message1' => 'PASSPORT UPLOAD',
					// 		'message2' => 'Successfully!',
					// 		'passport' => $file,
					// 	];
					// } else {
					// 	// Prepare response data
					// 	$response = [
					// 		'response' => 84,
					// 		'result' => true,
					// 		'message1' => 'Error uploading file',
					// 		'passport' => $file,
					// 	];
					// }
					
			
			break;
	

		

		


			case 'load_wallet_api':
				$amount=($_POST['amount']);
				$amount= str_replace( ',', '', $amount);
				//$currency_id=trim(($_POST['currency_id']));

				if($amount==''){ ///start if 1 --= check if not empty
					$response['response']=138; 
					$response['result']=False;
					$response['message1']="AMOUNT ERROR!"; 
					$response['message2']="Fill all fields to continue"; 
				}else{ ///else 1

					if (is_numeric($amount)){ // start if 2 //check if $amount is numeric

						if ($amount>=1){ // start if 3 --- check if amount is greater than Zero(0)

							$query=mysqli_query($conn,"SELECT user_id,email FROM user_tab WHERE user_id='$login_user_id' AND status_id=1");
							$count=mysqli_num_rows($query);
							if($count>0){// start if 4
								$fetch_query=mysqli_fetch_array($query);
								$user_id=$fetch_query['user_id']; 
								$email=$fetch_query['email']; 
									
								$backend_setting=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
								$u_array = json_decode($backend_setting, true);
								$payment_key=$u_array[0]['payment_key'];
								
								///////////////////////geting sequence//////////////////////////
								$sequence=$callclass->_get_sequence_count($conn, 'TRANS');
								$array = json_decode($sequence, true);
								$no= $array[0]['no'];
								/// generate payment ID
								$payment_id='TRANS'.$no.date("Ymdhis");
								
								/// Insert to user wallet tab
								mysqli_query($conn,"INSERT INTO `user_wallet_tab`
								(`user_id`, `payment_id`, `balance_before`,  `amount`, `balance_after`, `transaction_type_id`, `status_id`, `date`) VALUES
								('$login_user_id', '$payment_id', '$wallet_balance', '$amount', '$wallet_balance', 'CR', 7, NOW())")or die (mysqli_error($conn));

								/// Insert to backup_payment_tab
								mysqli_query($conn,"INSERT INTO `backup_payment_tab`
								(`user_id`, `payment_id`, `amount`, `fund_method_id`, `payment_key`, `status_id`, `date`) VALUES
								('$login_user_id', '$payment_id','$amount', 'FM001', '$payment_key', 7, NOW())")or die (mysqli_error($conn));

								$response['response']=139; 
								$response['result']=true;
								$response['message1']="PROCEED!"; 
								$response['message2']="Proceed to wallet payment"; 
							
								$response['payment_id']=$payment_id; 
								$response['user_id']=$user_id; 
								$response['fullname']=ucwords(strtolower($fullname)); 
								$response['email']=$email; 
								$response['amount']=$amount; 
								$response['mobile']=$mobile; 
								$response['payment_key']=$payment_key;
		
							}else{ // else 4
								$response['response']=140;
								$response['result']=false;
								$response['message1']="USER ERROR!";
								$response['message2']="User ID not valid.";
							}// end if 4
					
						}else{ // else 3
							$response['response']=141;
							$response['result']=false;
							$response['message1']="AMOUNT ERROR!";
							$response['message2']="Amount cannot less than #1.00";
						}// end if 3

					}else{ // else 1
						$response['response']=142;
						$response['result']=false;
						$response['message1']="AMOUNT ERROR!";
						$response['message2']="Invalid amount entered.";
					}// end if 1
				}	
			break;
		
		
		
			case 'wallet_payment_success_api':
				$payment_id=trim(strtoupper($_POST['payment_id']));
				$stack_pay_ref=trim($_POST['stack_pay_ref']);
				$amount=trim(($_POST['amount']));
	
				$query=mysqli_query($conn,"SELECT payment_id FROM user_wallet_tab WHERE payment_id='$payment_id' AND user_id='$login_user_id' AND status_id=7");
				$count=mysqli_num_rows($query);
				if($count>0){// start if 1
					$response['response']=143; 
					$response['result']=true;

					$user_array=$callclass->_get_user_detail($conn, $login_user_id);
					$user_array = json_decode($user_array, true);
					$fullname= $user_array[0]['fullname'];
					$email= $user_array[0]['email'];
					$phone= $user_array[0]['phone'];
					$wallet_balance= $user_array[0]['wallet_balance']; 

					if(($stack_pay_ref=='') || ($amount=='')){// start if 2
						$response['response']=144; 
						$response['result']=false;
						$response['message1']='PAYMENT ERROR!'; 
						$response['message2']='Some fields are empty'; 
					}else{ // else 2
						$new_wallet_balance=$amount+$wallet_balance;
						/// update user_wallet_tab
						mysqli_query($conn,"UPDATE `user_wallet_tab` SET payment_gateway_id='$stack_pay_ref', balance_before='$wallet_balance', balance_after='$new_wallet_balance',
						status_id=5 WHERE user_id='$login_user_id' AND payment_id='$payment_id'"); 
						/// update backup_payment_tab
						mysqli_query($conn,"UPDATE `backup_payment_tab` SET payment_gateway_id='$stack_pay_ref', status_id=5 WHERE user_id='$login_user_id' AND payment_id='$payment_id'"); 
						/// update user_tab
						mysqli_query($conn,"UPDATE `user_tab` SET wallet_balance='$new_wallet_balance' WHERE user_id='$login_user_id'"); 
						
						$response['response']=145; 
						$response['result']=true;
						$response['message1']='WALLET LOADED'; 
						$response['message2']='Wallet Payment Successful'; 
					} // end if 2
				}else{ // else 1
					$response['response']=146; 
					$response['result']=false;
					$response['message1']='PAYMENT ERROR!'; 
					$response['message2']='Payment ID not valid'; 
				} // end if 1
					
			break;



			case 'wallet_payment_cancelled_api':
				$payment_id=trim(strtoupper($_POST['payment_id']));

				$query=mysqli_query($conn, "SELECT `payment_id` FROM user_wallet_tab WHERE `payment_id`='$payment_id' AND `user_id`='$login_user_id' AND status_id=7  ") or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0){

					$user_array=$callclass->_get_user_detail($conn, $login_user_id);
					$user_array = json_decode($user_array, true);
					$wallet_balance= $user_array[0]['wallet_balance']; 

					/// update user_wallet_tab
					mysqli_query($conn,"UPDATE user_wallet_tab SET balance_before='$wallet_balance', balance_after='$wallet_balance', status_id=6 WHERE payment_id='$payment_id' AND user_id='$login_user_id'")or die (mysqli_error($conn));
					/// update backup_payment_tab
					mysqli_query($conn,"UPDATE `backup_payment_tab` SET  status_id=6 WHERE user_id='$login_user_id' AND payment_id='$payment_id'"); 
				
					$response['response']=147; 
					$response['result']=true;
					$response['message1']='WALLET CANCELLED'; 
					$response['message2']='Wallet Payment Cancelled'; 
				}else{
					$response['response']=148; 
					$response['result']=false;
					$response['message1']='PAYMENT CANCELED ERROR!';
					$response['message2']='Transaction ID error!';
				}
					
			break;





			case 'fetch_wallet_history_api':
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
					(SELECT COUNT(d.payment_id) FROM user_wallet_tab d WHERE d.user_id='$login_user_id') as count_all
					FROM user_wallet_tab a, setup_transaction_type_tab b, setup_status_tab c  
					WHERE a.transaction_type_id=b.transaction_type_id AND a.status_id=c.status_id
					AND  a.user_id='$login_user_id' AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date DESC")or die (mysqli_error($conn));		
					$count=mysqli_num_rows($pay_query);
					if ($count>0){///start if 1
						
						$response['response']=149;
						$response['result']=true;
						while($fetch_query_pay=mysqli_fetch_all($pay_query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query_pay;
						}
			
					}else{///else 2
						$response['response']=150;
						$response['result']=false;
						$response['message']='NO RECORD FOUND!';
							
					} //enf if 2
					
			break;




			case 'change_password_api':

				$old_password=md5(trim($_POST['old_password']));
				$new_password=md5(trim($_POST['new_password']));
	
					$query=mysqli_query($conn, "SELECT `password` FROM user_tab WHERE `password`='$old_password' AND user_id='$login_user_id' ") or die (mysqli_error($conn));
					$check_pass=mysqli_num_rows($query);
					if ($check_pass>0){
						$fetch_query=mysqli_fetch_array($query);
						$user_id=$fetch_query['user_id']; 
						$access_key=md5($user_id.date("Ymdhis"));

						mysqli_query($conn,"UPDATE user_tab SET `password`='$new_password',`access_key`='$access_key' WHERE user_id='$login_user_id'")or die (mysqli_error($conn));
						$response['response']=151;
						$response['result']=true;
						$response['message1']='PASSWORD CHANGE';
						$response['message2']='Successfully';
					}else {
						$response['response']=152;
						$response['result']=false;
						$response['message1']='OLD PASSWORD ERROR!';
						$response['message2']='Old Password Not Correct';
					}	
			break;






			case 'fetch_exam_api':
				$search_txt=($_POST['search_txt']);
				$search_like="(b.exam_name like '%$search_txt%' OR b.abbreviation like '%$search_txt%')";
				
				$query=mysqli_query($conn,"SELECT 
				a.*, 
				b.abbreviation, 
				b.exam_name, 
				b.exam_passport, 
				b.seo_description,
				(SELECT COUNT(h.exam_id) FROM user_exam_tab h WHERE h.user_id='$login_user_id') as count_all, 
				(SELECT COUNT(c.subject_id) FROM exam_subject_tab c, subject_tab d WHERE c.exam_id=b.exam_id AND c.subject_id=d.subject_id AND d.status_id=1 ) AS exam_subject_count
				FROM user_exam_tab a, exam_tab b WHERE a.exam_id=b.exam_id AND $search_like AND b.status_id=1 AND a.user_id='$login_user_id'")or die ("cannot select");
				
				$count=mysqli_num_rows($query);
					if ($count>0){///start if 1
							
						$response['response']=153;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 1
						$response['response']=154;
						$response['result']=false;
						$response['message1']="NO RECORD FOUND!!!"; 
					}// End if 1
			break;





			case 'fetch_user_exam_api':

				$query=mysqli_query($conn,
					"SELECT
					a.exam_id,a.abbreviation, 
					CASE
					WHEN b.exam_id IS NOT NULL THEN 'checked'
					ELSE 'unchecked'
					END AS checked
					FROM exam_tab a
					LEFT JOIN user_exam_tab b ON
					a.exam_id = b.exam_id AND b.user_id='$login_user_id' AND a.status_id=1")or die (mysqli_error($conn));
				//$query=mysqli_query($conn,"SELECT * FROM exam_tab WHERE status_id=1 ORDER BY exam_name ASC ")or die (mysqli_error($conn));	
				$fetch_query=mysqli_num_rows($query);
				if($fetch_query>0){
					$response['response']=155;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{
					$response['result']=false;
					$response['response']=156;
					$response['message1']="No Record Found!";
				}
				
		break;







		case 'add_new_exam':
			$all_exam_id=$_POST['exam_id'];
		
			if($all_exam_id==''){ ///start if 1
				$response['response']=157; 
				$response['result']=False;
				$response['message1']="ERROR!"; 
				$response['message2']="Select atleast one exam."; 
			}else{ ///else 1
					
				mysqli_query($conn,"DELETE FROM `user_exam_tab` WHERE user_id='$login_user_id'")or die (mysqli_error($conn));
				$each_exam_ids = explode(',',$all_exam_id);
				foreach($each_exam_ids as $exam_id){	
					mysqli_query($conn,"INSERT INTO `user_exam_tab`
					(`user_id`, `exam_id`,`created_time`) VALUES
					('$login_user_id','$exam_id', NOW())")or die (mysqli_error($conn));								
				}
				$response['response']=158; 
				$response['result']=true;
				$response['message1']="SUCCESS!"; 
				$response['message2']="Exam Added Successful."; 						
			} ///end if 3
						
		break;


			
	





			case 'fetch_exam_subject_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$search_txt=($_POST['search_txt']);
				
				$search_like="(b.subject_name like '%$search_txt%')";

				$query=mysqli_query($conn,"SELECT
				 a.*,
				b.subject_name, 
				b.subject_passport,
				(SELECT COUNT(c.topic_id) FROM topic_tab c WHERE c.subject_id=b.subject_id  AND c.exam_id='$exam_id' AND c.status_id=1) AS subject_topic_count
				FROM exam_subject_tab a, subject_tab b
				WHERE a.subject_id=b.subject_id AND b.status_id=1 AND a.exam_id='$exam_id' AND $search_like  ")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1
					$response['response']=159;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{ // Else 1
					$response['response']=160;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!"; 
				}// End if 1
							
				$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id' ")or die (mysqli_error($conn));
				$fetch_array=mysqli_fetch_array($query);
				$abbreviation=$fetch_array['abbreviation']; 
				$response['abbreviation']=$abbreviation;
			break;
	










			case 'fetch_topic_api':
				$exam_id=trim(strtoupper($_POST['exam_id']));
				$subject_id=trim(strtoupper($_POST['subject_id']));
				$search_txt=($_POST['search_txt']);

				$search_like="(a.topic_name like '%$search_txt%')";

				$query=mysqli_query($conn,"SELECT 
				a.topic_id, 
				a.topic_name,
				(SELECT COUNT(c.sub_topic_id) FROM sub_topic_tab c WHERE c.topic_id=a.topic_id AND c.subject_id='$subject_id' AND c.status_id=1) AS sub_topic_count
				FROM topic_tab a WHERE $search_like AND a.exam_id= '$exam_id' AND a.subject_id= '$subject_id' AND a.status_id=1 ORDER BY a.topic_name ASC")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1
					$response['response']=161;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{ // Else 1
					$response['response']=162;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!"; 
				}// End if 1
				$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id' ")or die (mysqli_error($conn));
				$fetch_array=mysqli_fetch_array($query);
				$abbreviation=$fetch_array['abbreviation']; 
				$response['abbreviation']=$abbreviation;

				$query=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_id='$subject_id' ")or die (mysqli_error($conn));
				$fetch_array=mysqli_fetch_array($query);
				$subject_name=$fetch_array['subject_name']; 
				$response['subject_name']=$subject_name;		
			break;









			case 'fetch_sub_topic_api':
				$topic_id=trim(strtoupper($_POST['topic_id']));

					$query=mysqli_query($conn,"SELECT
					a.*, b.due_date, 
					CASE
					WHEN b.sub_topic_id IS NOT NULL THEN 'yes'
					ELSE 'no'
					END AS subscribed,
					(SELECT COUNT(c.sub_topic_id) FROM sub_topic_video_tab c WHERE c.sub_topic_id=a.sub_topic_id AND c.status_id=1) AS nums_of_videos
					FROM sub_topic_tab a
					LEFT JOIN user_subscription_tab b ON
					a.topic_id=b.topic_id AND
					a.sub_topic_id = b.sub_topic_id AND b.user_id='$login_user_id' WHERE a.topic_id='$topic_id' ")or die (mysqli_error($conn));

					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 1
						$response['response']=163;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 1
						$response['response']=164;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!"; 
					}// End if 1

			break;











			
				case 'fetch_sub_topic_video_api':
					$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
					$search_txt=($_POST['search_txt']);

					$search_like="(video_title like '%$search_txt%')";

				
						$query=mysqli_query($conn,"SELECT * FROM user_subscription_tab WHERE sub_topic_id = '$sub_topic_id' AND user_id = '$login_user_id' AND status_id=1 ")or die (mysqli_error($conn));
						$count=mysqli_num_rows($query);
						if($count>0){
							$subscription_check=1;
						}else{
							$subscription_check=0;
						}
						$response['subscription_check']=$subscription_check;
						
						$query=mysqli_query($conn,"SELECT a.*, b.video_volume_name, 
						c.subscription_pricing_name 
						FROM sub_topic_video_tab a, setup_video_volume_tab b, 
						setup_subscription_pricing_tab c 
						WHERE a.sub_topic_id = '$sub_topic_id' AND $search_like 
						AND a.status_id=1 AND a.video_volume_id=b.video_volume_id 
						AND a.subscription_pricing_id=c.subscription_pricing_id ORDER BY video_volume_id ASC")or die (mysqli_error($conn));
						$check_query=mysqli_num_rows($query);
					
						if ($check_query>0) { // start if 1
							$response['response']=165;
							$response['result']=true;
							while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
								$response['data']=$fetch_query;
							}
							$query=mysqli_query($conn,"SELECT subscription_price, subscription_duration_id FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));	
							$fetch_query=mysqli_fetch_array($query);
							$subscription_price=$fetch_query['subscription_price']; 
							$subscription_duration_id=$fetch_query['subscription_duration_id']; 
							$response['subscription_price']=$subscription_price;
							$response['subscription_duration_id']=$subscription_duration_id;
							
						}else{ // Else 1
							$response['response']=166;
							$response['result']=false;
							$response['message']="NO RECORD FOUND!"; 	
						}// End if 1
							


							$query=mysqli_query($conn,"SELECT DISTINCT(topic_id), sub_topic_name FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));
							$fetch_array=mysqli_fetch_array($query);
							$topic_id=$fetch_array['topic_id']; 
							$sub_topic_name=$fetch_array['sub_topic_name']; 

							$query=$callclass->_get_topic_detail($conn, $topic_id);
							$fetch_array = json_decode($query, true);
							$exam_id= $fetch_array[0]['exam_id']; 
							$topic_name= $fetch_array[0]['topic_name']; 
							$subject_id= $fetch_array[0]['subject_id']; 

							$response['exam_id']=$exam_id;
							$response['subject_id']=$subject_id;

							$query=mysqli_query($conn,"SELECT subject_name FROM subject_tab WHERE subject_id='$subject_id' ")or die (mysqli_error($conn));
							$fetch_array=mysqli_fetch_array($query);
							$subject_name=$fetch_array['subject_name']; 
							$response['topic_id']=$topic_id;

							$query=mysqli_query($conn,"SELECT abbreviation FROM exam_tab WHERE exam_id='$exam_id' ")or die (mysqli_error($conn));
							$fetch_array=mysqli_fetch_array($query);
							$abbreviation=$fetch_array['abbreviation']; 
							
							$response['sub_topic_name']=$sub_topic_name;
							$response['topic_name']=$topic_name;
							$response['subject_name']=$subject_name;
							$response['abbreviation']=$abbreviation;


							

				break;
	
	
				


				case 'fetch_video_subcription':
					$video_id=trim(strtoupper($_POST['video_id']));
					
					$query=mysqli_query($conn,"SELECT a.*, b.video_volume_name, c.subscription_pricing_name   FROM sub_topic_video_tab a, setup_video_volume_tab b, setup_subscription_pricing_tab c WHERE 
					a.video_volume_id=b.video_volume_id AND a.subscription_pricing_id=c.subscription_pricing_id AND a.video_id='$video_id'  ")or die (mysqli_error($conn));
					
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 1
						$response['response']=167;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_assoc($query)){
							$response['data']=$fetch_query;
						}
					}else{ // Else 1
						$response['response']=168;
						$response['result']=false;
						$response['message']="NO RECORD FOUND!!!"; 
					}// End if 1
								
					
				break;







				case 'fetch_subscription_api':
					$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
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
						(SELECT COUNT(h.sub_topic_id) FROM user_subscription_tab h WHERE h.user_id='$login_user_id' AND (date(h.date) BETWEEN '$db_day30' AND '$db_today')) as count_all 
						FROM user_subscription_tab a, exam_tab b, subject_tab c, topic_tab d,  sub_topic_tab e,  exam_subject_tab f, setup_status_tab g 
						WHERE
						b.exam_id=f.exam_id AND d.exam_id=f.exam_id 
						AND c.subject_id=f.subject_id AND e.subject_id=f.subject_id  
						AND d.topic_id=e.topic_id AND e.sub_topic_id=a.sub_topic_id 
						AND a.status_id=g.status_id AND a.user_id='$login_user_id'";
						if($sub_topic_id==''){

							$query=mysqli_query($conn,$select_query. "AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date ASC");
							$count=mysqli_num_rows($query);
							if ($count>0){///start if 1
								$response['response']=169;
								$response['result']=true;
								while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
									$response['data']=$fetch_query;
								}
										
							}else{///else 2
								$response['response']=170;
								$response['result']=false;
								$response['message']='NO RECORD FOUND!';
									
							} //enf if 2
						}else{
							$query=mysqli_query($conn,$select_query. "AND a.sub_topic_id='$sub_topic_id'");
							$response['response']=171;
							$response['result']=true;
							while($fetch_query=mysqli_fetch_assoc($query)){
								$response['data']=$fetch_query;
							}

						}
						
						
				break;
	
	
	




				case 'fund_method_api':
					$query=mysqli_query($conn,"SELECT * FROM setup_fund_method_tab WHERE fund_method_id IN('FM001','FM002')");
						$response['response']=172;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
							$response['data']=$fetch_query;
						}
				break;




				case 'subscription_payment_detail_api':
					$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
					$query=mysqli_query($conn,"SELECT sub_topic_name, subscription_price, subscription_duration_id FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));	
					$check_query=mysqli_num_rows($query);
					if ($check_query>0) { // start if 1
						$response['response']=173;
						$response['result']=true;

						$fetch_query=mysqli_fetch_array($query);
						$sub_topic_name=$fetch_query['sub_topic_name']; 
						$subscription_price=$fetch_query['subscription_price']; 
						$subscription_duration_id=$fetch_query['subscription_duration_id']; 
						$response['sub_topic_name']=ucwords(strtolower($sub_topic_name));
						$response['subscription_price']=$subscription_price;
						$response['subscription_duration_id']=$subscription_duration_id;

					}else{ // Else 1
						$response['response']=174;
						$response['result']=false;
						$response['message1']="Xxx Xxx"; 
						$response['message2']="0.00"; 
					}// End if 1
				
				break;
	



				case 'payment_subscription_api':
					$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
					$fund_method_id=trim(strtoupper($_POST['fund_method_id']));

					$query=mysqli_query($conn,"SELECT * FROM sub_topic_video_tab WHERE sub_topic_id = '$sub_topic_id' AND status_id=1 ")or die (mysqli_error($conn));
					$query_count=mysqli_num_rows($query);
					if ($query_count>0) {
						$video_check=1;
					
							$fund_query=mysqli_query($conn,"SELECT fund_method_id FROM setup_fund_method_tab WHERE fund_method_id='$fund_method_id' ")or die (mysqli_error($conn));	
							$check_query=mysqli_num_rows($fund_query);
							if ($check_query>0) { // start if 1

								$backend_setting=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
								$u_array = json_decode($backend_setting, true);
								$payment_key=$u_array[0]['payment_key'];
								
								$sequence1=$callclass->_get_sub_topic_detail($conn, $sub_topic_id);
								$array = json_decode($sequence1, true);
								$subscription_price= $array[0]['subscription_price'];
								$sub_topic_name= $array[0]['sub_topic_name'];
							

								$response['subscription_name']=$sub_topic_name; 
								///////////////////////geting sequence//////////////////////////
								$sequence4=$callclass->_get_sequence_count($conn, 'TRANS');
								$array = json_decode($sequence4, true);
								$no= $array[0]['no'];
								/// generate payment ID
								$payment_id='TRANS'.$no.date("Ymdhis");
								
							
								mysqli_query($conn,"INSERT INTO `payment_tab`
								(`user_id`,`payment_id`,`sub_topic_id`,`fund_method_id`,`transaction_type_id`,`amount`,`status_id`,`date`) VALUES 
								('$login_user_id','$payment_id','$sub_topic_id','$fund_method_id','DB','$subscription_price', 7, NOW())")or die (mysqli_error($conn));
								
								/// Insert to backup_payment_tab
								mysqli_query($conn,"INSERT INTO `backup_payment_tab`
								(`user_id`, `payment_id`, `amount`, `fund_method_id`, `payment_key`, `status_id`, `date`) VALUES
								('$login_user_id', '$payment_id', '$subscription_price', '$fund_method_id', '$payment_key', 7, NOW())")or die (mysqli_error($conn));


								$user_array=$callclass->_get_user_detail($conn, $login_user_id);
								$user_array = json_decode($user_array, true);
								$fullname= $user_array[0]['fullname'];
								$email= $user_array[0]['email'];
								$mobile= $user_array[0]['mobile'];
								
								$array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
								$fetch = json_decode($array, true);
								$payment_key=$fetch[0]['payment_key'];
								$currency_id=$fetch[0]['currency_id'];

								$response['response']=175;
								$response['result']=true;
								$response['message1']="PROCEED"; 
								$response['message2']="Proceed to payment"; 

								if($fund_method_id=='FM001'){/// check if pay with card 
									$response['pay_with_card_id']=$fund_method_id; 
								} else if($fund_method_id=='FM002'){// check if pay with wallet
									$response['pay_with_wallet_id']=$fund_method_id;
								}
								$response['payment_id']=$payment_id; 
								$response['amount']=$subscription_price; 
								$response['fullname']=$fullname; 
								$response['email']=$email; 
								$response['mobile']=$mobile; 
								$response['payment_key']=$payment_key; 
								$response['currency_id']=$currency_id; 
						}else{// else 1
							$response['response']=176;
							$response['result']=false;
							$response['message1']="PAYMENT METHOD ERROR!"; 
							$response['message2']="Payment cannot proceed"; 
						}// end if 1

					}else{// else 1
						$video_check=0;
					}// end if 1
					$response['video_check']=$video_check;
					
					$query=mysqli_query($conn,"SELECT DISTINCT(topic_id) FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id' ")or die (mysqli_error($conn));
					$fetch_array=mysqli_fetch_array($query);
					$topic_id=$fetch_array['topic_id']; 
					
					$query=$callclass->_get_topic_detail($conn, $topic_id);
					$fetch_array = json_decode($query, true);
					$exam_id= $fetch_array[0]['exam_id']; 
					$subject_id= $fetch_array[0]['subject_id']; 

					$response['exam_id']=$exam_id; 
					$response['subject_id']=$subject_id; 

					$sequence1=$callclass->_get_sub_topic_detail($conn, $sub_topic_id);
					$array = json_decode($sequence1, true);
					$sub_topic_name= $array[0]['sub_topic_name'];
					// $subscription_price= $array[0]['subscription_price'];
					// $subscription_duration_id= $array[0]['subscription_duration_id'];

					$response['subscription_name']=$sub_topic_name; 
				break;




				case 'pay_with_card_success_api':
					$payment_id=trim(strtoupper($_POST['payment_id']));
					$stack_pay_ref=trim($_POST['stack_pay_ref']);
					$amount=trim(($_POST['amount']));
		
					$query=mysqli_query($conn,"SELECT payment_id FROM payment_tab WHERE payment_id='$payment_id' AND user_id='$login_user_id' AND status_id=7");
					$count=mysqli_num_rows($query);
					if($count>0){// start if 1
			
						$array=$callclass->_get_payment_details($conn, $payment_id);
						$fetch = json_decode($array, true);
						$sub_topic_id= $fetch[0]['sub_topic_id'];

						// $user_array=$callclass->_get_user_detail($conn, $login_user_id);
						// $user_array = json_decode($user_array, true);
						// $fullname= $user_array[0]['fullname'];
						// $email= $user_array[0]['email'];
						// $phone= $user_array[0]['phone'];
					
	
						if(($stack_pay_ref=='') || ($amount=='')){// start if 2
							$response['response']=177; 
							$response['result']=false;
							$response['message1']='PAYMENT ERROR!'; 
							$response['message2']='Some fields are empty'; 
						}else{ // else 2

							$sequence1=$callclass->_get_sub_topic_detail($conn, $sub_topic_id);
							$array = json_decode($sequence1, true);
							$topic_id= $array[0]['topic_id'];
							$subscription_duration_id= $array[0]['subscription_duration_id'];

							///////////////////////geting sequence//////////////////////////
							$sequence2=$callclass->_get_sequence_count($conn, 'US_ID');
							$array = json_decode($sequence2, true);
							$no= $array[0]['no'];
							/// generate user subscription ID
							$us_id='US_ID'.$no.date("Ymdhis");

							/// Insert to user wallet tab
							mysqli_query($conn,"INSERT INTO `user_subscription_tab`
							(`us_id`, `user_id`, `topic_id`,`sub_topic_id`, `subscription_duration_id`, `start_date`, `status_id`, `date`) VALUES
							('$us_id', '$login_user_id','$topic_id','$sub_topic_id','$subscription_duration_id',NOW(), 2, NOW())")or die (mysqli_error($conn));

							$query=mysqli_query($conn,"SELECT due_date FROM user_subscription_tab WHERE sub_topic_id='$sub_topic_id' AND user_id='$login_user_id' ")or die (mysqli_error($conn));	
							$fetch_query=mysqli_fetch_array($query);
							$due_date=$fetch_query['due_date']; 
							// Convert the strings to DateTime objects
							$due_date = new DateTime($due_date);
							// Add days to the due_date
							$due_date->add(new DateInterval("P{$subscription_duration_id}D"));
							// Format the updated due_date as a string
							$updated_due_date = $due_date->format("Y-m-d h:i:s");

							/// update payment_tab
							mysqli_query($conn,"UPDATE payment_tab SET  payment_gateway_id='$stack_pay_ref',  status_id=5, date=NOW() WHERE user_id='$login_user_id' AND payment_id='$payment_id'")or die (mysqli_error($conn));
							/// update user_subscription_tab
							mysqli_query($conn,"UPDATE user_subscription_tab SET due_date='$updated_due_date', status_id=1, date=NOW() WHERE user_id='$login_user_id' AND sub_topic_id='$sub_topic_id'")or die (mysqli_error($conn));
							/// update backup_payment_tab
							mysqli_query($conn,"UPDATE `backup_payment_tab` SET payment_gateway_id='$stack_pay_ref', status_id=5 WHERE user_id='$login_user_id' AND payment_id='$payment_id'")or die (mysqli_error($conn));
							
							$response['response']=178; 
							$response['result']=true;
							$response['message1']='SUCCESS'; 
							$response['message2']='Payment Successful'; 
						} // end if 2
					}else{ // else 1
						$response['response']=179; 
						$response['result']=false;
						$response['message1']='PAYMENT ERROR!'; 
						$response['message2']='Payment cannot proceed'; 
					} // end if 1
						
				break;
	
	


				case 'payment_subscription_cancelled_api':
					$payment_id=trim(strtoupper($_POST['payment_id']));
	
					$query=mysqli_query($conn, "SELECT `payment_id` FROM payment_tab WHERE `payment_id`='$payment_id' AND `user_id`='$login_user_id' AND status_id=7  ") or die (mysqli_error($conn));
					$check_query=mysqli_num_rows($query);
					if ($check_query>0){
	
						mysqli_query($conn,"UPDATE payment_tab SET status_id=6 WHERE payment_id='$payment_id' AND user_id='$login_user_id'")or die (mysqli_error($conn));
						/// update backup_payment_tab
						mysqli_query($conn,"UPDATE `backup_payment_tab` SET  status_id=6 WHERE user_id='$login_user_id' AND payment_id='$payment_id'"); 
					
						$response['response']=183; 
						$response['result']=true;
						$response['message1']='PAYMENT CANCELLED'; 
						$response['message2']='Payment Subcription Cancelled'; 
					}else{
						$response['response']=184; 
						$response['result']=false;
						$response['message1']='ERROR!';
						$response['message2']='Transaction Cannot Proceed!';
					}
						
				break;




		
		
			case 'payment_with_wallet_subscription_api':
					$payment_id=trim(strtoupper($_POST['payment_id']));
					
					$query=mysqli_query($conn,"SELECT payment_id FROM payment_tab WHERE payment_id='$payment_id' AND user_id='$login_user_id' ")or die (mysqli_error($conn));	
					$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1

						$array=$callclass->_get_payment_details($conn, $payment_id);
						$fetch = json_decode($array, true);
						$amount= $fetch[0]['amount'];
						$sub_topic_id= $fetch[0]['sub_topic_id'];
						
						$user_array=$callclass->_get_user_detail($conn, $login_user_id);
						$user_array = json_decode($user_array, true);
						// $fullname= $user_array[0]['fullname'];
						// $email= $user_array[0]['email'];
						// $phone= $user_array[0]['phone'];
						$wallet_balance= $user_array[0]['wallet_balance'];

					if($wallet_balance>=$amount){ // start if 2
							$response['response']=180;
							$response['result']=true;
							$response['message1']="PAY WITH WALLET"; 
							$response['message2']="Proceed to payment"; 

							$sequence1=$callclass->_get_sub_topic_detail($conn, $sub_topic_id);
							$array = json_decode($sequence1, true);
							$topic_id= $array[0]['topic_id'];
							$subscription_duration_id= $array[0]['subscription_duration_id'];

							///////////////////////geting sequence//////////////////////////
							$sequence3=$callclass->_get_sequence_count($conn, 'US_ID');
							$array = json_decode($sequence3, true);
							$no= $array[0]['no'];
							/// generate user subscription ID
							$us_id='US_ID'.$no.date("Ymdhis");

							/// Insert to user wallet tab
							mysqli_query($conn,"INSERT INTO `user_subscription_tab`
							(`us_id`, `user_id`, `topic_id`,`sub_topic_id`, `subscription_duration_id`, `start_date`, `status_id`, `date`) VALUES
							('$us_id', '$login_user_id','$topic_id','$sub_topic_id','$subscription_duration_id',NOW(), 7, NOW())")or die (mysqli_error($conn));

							$new_wallet_balance=$wallet_balance - $amount;
							mysqli_query($conn,"UPDATE user_tab SET  wallet_balance='$new_wallet_balance' WHERE user_id='$login_user_id'")or die (mysqli_error($conn));
							
							$balance_after=$new_wallet_balance;
							/// Insert to user wallet tab
							mysqli_query($conn,"INSERT INTO `user_wallet_tab`
							(`user_id`, `payment_id`, `balance_before`,  `amount`, `balance_after`, `transaction_type_id`, `status_id`, `date`) VALUES
							('$login_user_id', '$payment_id', '$wallet_balance', '$amount', '$balance_after', 'DB', 5, NOW())")or die (mysqli_error($conn));
					
							/// update payment_tab
							mysqli_query($conn,"UPDATE payment_tab SET  payment_gateway_id='$payment_id',  status_id=5, date=NOW() WHERE user_id='$login_user_id' AND payment_id='$payment_id'")or die (mysqli_error($conn));
							/// update user_wallet_tab
							mysqli_query($conn,"UPDATE user_wallet_tab SET  payment_gateway_id='$payment_id',  status_id=5, date=NOW() WHERE user_id='$login_user_id' AND payment_id='$payment_id'")or die (mysqli_error($conn));
							/// update backup_payment_tab
							mysqli_query($conn,"UPDATE `backup_payment_tab` SET payment_gateway_id='$payment_id', status_id=5 WHERE user_id='$login_user_id' AND payment_id='$payment_id'")or die (mysqli_error($conn));
							
							$query=mysqli_query($conn,"SELECT due_date FROM user_subscription_tab WHERE sub_topic_id='$sub_topic_id' AND user_id='$login_user_id' ")or die (mysqli_error($conn));	
							$fetch_query=mysqli_fetch_array($query);
							$due_date=$fetch_query['due_date']; 
							// Convert the strings to DateTime objects
							$due_date = new DateTime($due_date);
							// Add days to the due_date
							$due_date->add(new DateInterval("P{$subscription_duration_id}D"));
							// Format the updated due_date as a string
							$updated_due_date = $due_date->format("Y-m-d h:i:s");							
							mysqli_query($conn,"UPDATE user_subscription_tab SET  status_id=1, due_date='$updated_due_date', date=NOW() WHERE user_id='$login_user_id' AND sub_topic_id='$sub_topic_id'")or die (mysqli_error($conn));
						// note if otp needed
										
					}else{ // Else 2
						/// Insert to user wallet tab
						mysqli_query($conn,"INSERT INTO `user_wallet_tab`
						(`user_id`, `payment_id`, `balance_before`,  `amount`, `balance_after`, `transaction_type_id`, `status_id`, `date`) VALUES
						('$login_user_id', '$payment_id', '$wallet_balance', '$amount', '$wallet_balance', 'DB', 7, NOW())")or die (mysqli_error($conn));
			
						$response['response']=181;
						$response['result']=false;
						$response['message1']="INSUFFICIENT FUND!"; 
						$response['message2']="Kindly load your wallet to continue."; 
					
					}// End if 2

				}else{// else 1
						$response['response']=182;
						$response['result']=false;
						$response['message1']="TRANSACTION ERROR!"; 
						$response['message2']="Transaction cannot proceed"; 
				}// End if 1
			break;



			
			case 'fetch_transaction_history_api':
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
					(SELECT COUNT(f.payment_id) FROM payment_tab f WHERE f.user_id='$login_user_id' AND (date(f.date) BETWEEN '$db_day30' AND '$db_today')) as count_all
					FROM payment_tab a, setup_transaction_type_tab b, setup_status_tab c, setup_fund_method_tab d, sub_topic_tab e 
					WHERE a.sub_topic_id=e.sub_topic_id AND a.transaction_type_id=b.transaction_type_id AND a.fund_method_id=d.fund_method_id AND a.status_id=c.status_id  AND a.user_id='$login_user_id'";		

											
					if($payment_id==''){
						
						$pay_query=mysqli_query($conn,$select_query. "AND (date(a.date) BETWEEN '$db_day30' AND '$db_today') ORDER BY a.date DESC")or die (mysqli_error($conn));
						$count=mysqli_num_rows($pay_query);
						if ($count>0){
							$response['response']=185;
							$response['result']=true;
							while($fetch_query=mysqli_fetch_all($pay_query, MYSQLI_ASSOC)){
								$response['data']=$fetch_query;
							}
						}else{
							$response['response']=186;
							$response['result']=false;
							$response['message']='NO RECORD FOUND!';
						}
								
					}else{///else 2
						
						$pay_query=mysqli_query($conn,$select_query. " AND a.payment_id='$payment_id'")or die (mysqli_error($conn));
						$response['response']=187;
						$response['result']=true;
						while($fetch_query=mysqli_fetch_assoc($pay_query)){
							$response['data']=$fetch_query;
						}

						$query=mysqli_query($conn,"SELECT sub_topic_id,status_id FROM payment_tab WHERE payment_id='$payment_id' AND user_id='$login_user_id'");
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
						
						LEFT JOIN user_subscription_tab b ON a.sub_topic_id = b.sub_topic_id AND b.user_id='$login_user_id'
						
						LEFT JOIN topic_tab e ON a.topic_id= e.topic_id
						
						LEFT JOIN exam_subject_tab h ON a.subject_id= h.subject_id 
						
						LEFT JOIN subject_tab d ON h.subject_id= d.subject_id
						
						LEFT JOIN exam_tab c ON e.exam_id = c.exam_id AND h.exam_id=c.exam_id
						
						LEFT JOIN payment_tab g ON g.sub_topic_id = b.sub_topic_id AND b.user_id=g.user_id 
						
						LEFT JOIN setup_status_tab f ON b.status_id = f.status_id WHERE";


							$pay_query=mysqli_query($conn,$select_query2. " a.sub_topic_id='$sub_topic_id'LIMIT 1")or die (mysqli_error($conn));
							$response['response']=188;
							$response['result']=true;
							while($fetch_query=mysqli_fetch_assoc($pay_query)){
								$response['data2']=$fetch_query;
							}
		
					} //enf if 2
			break;
















		}
	
	}/// End if check

}

echo json_encode($response);

?>





