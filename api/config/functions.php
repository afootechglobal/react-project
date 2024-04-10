<?php
class allClass{
/////////////////////////////////////////

function stringToSecret($string){
    $length = strlen($string);
    $visibleCount = (int) round($length / 4);
    $hiddenCount = $length - ($visibleCount * 2);
	
    return substr($string, 0, $visibleCount) . str_repeat('*', $hiddenCount) . substr($string, ($visibleCount * -1), $visibleCount);
}

   	
function _get_setup_backend_settings_detail($conn, $backend_setting_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_backend_settings_tab WHERE backend_setting_id='$backend_setting_id'");
	$fetch=mysqli_fetch_array($query);
		$smtp_host=$fetch['smtp_host'];
		$smtp_username=$fetch['smtp_username'];
		$smtp_password=$fetch['smtp_password'];
		$smtp_port=$fetch['smtp_port'];
		$sender_name=$fetch['sender_name'];
		$support_email=$fetch['support_email'];
		$payment_key=$fetch['payment_key'];
		$currency_id=$fetch['currency_id'];
      
		return '[{"smtp_host":"'.$smtp_host.'","smtp_username":"'.$smtp_username.'","smtp_password":"'.$smtp_password.'","afootech_email":"'.$afootech_email.'",
		"smtp_port":"'.$smtp_port.'","sender_name":"'.$sender_name.'","support_email":"'.$support_email.'",
        "payment_key":"'.$payment_key.'", "currency_id":"'.$currency_id.'"}]';

}


function _get_sequence_count($conn, $counter_id){
		 $count=mysqli_fetch_array(mysqli_query($conn,"SELECT counter_value FROM setup_counter_tab WHERE counter_id = '$counter_id' FOR UPDATE"));
		  $num=$count[0]+1;
		  mysqli_query($conn,"UPDATE `setup_counter_tab` SET `counter_value` = '$num' WHERE counter_id = '$counter_id'")or die (mysqli_error($conn));
		  if ($num<10){$no='00'.$num;}elseif($num>=10 && $num<100){$no='0'.$num;}else{$no=$num;}
		return '[{"no":"'.$no.'"}]';
}

	
/////////////////////////////////////////
function _validate_accesskey($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE access_key='$access_key' AND  status_id=1 ")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$staff_id=$fetch_query['staff_id'];
			$role_id=$fetch_query['role_id'];
			$check=1; 
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","staff_id":"'.$staff_id.'","role_id":"'.$role_id.'"}]';
}

/////////////////////////////////////////
function _get_staff($conn, $staff_id){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE staff_id = '$staff_id'");
	$fetch_query=mysqli_fetch_array($query);
	$staff_id=$fetch_query['staff_id'];
	$access_key=$fetch_query['access_key'];
	$fullname=$fetch_query['fullname'];
	$mobile=$fetch_query['mobile'];
	$email=$fetch_query['email'];
	$address=$fetch_query['address'];
	$password=$fetch_query['password'];
	$otp=$fetch_query['otp'];
	$passport=$fetch_query['passport'];
	$role_id=$fetch_query['role_id'];
	$status_id=$fetch_query['status_id'];
	$create_time=$fetch_query['created_time'];
	$updated_time=$fetch_query['updated_time'];
	
	 return '[{"staff_id":"'.$staff_id.'","access_key":"'.$access_key.'","fullname":"'.$fullname.'","mobile":"'.$mobile.'","email":"'.$email.'",
		"address":"'.$address.'","passport":"'.$passport.'","role_id":"'.$role_id.'","status_id":"'.$status_id.'",
		"otp":"'.$otp.'","password":"'.$password.'","created_time":"'.$created_time.'","updated_time":"'.$updated_time.'"}]';
}



function _get_subject_details($conn, $subject_id){
	$query=mysqli_query($conn,"SELECT * FROM subject_tab WHERE subject_id = '$subject_id'");
	$fetch_query=mysqli_fetch_array($query);
	$subject_id=$fetch_query['subject_id'];
	$subject_name=$fetch_query['subject_name'];
	$subject_summary=$fetch_query['subject_summary'];
	$subject_passport=$fetch_query['subject_passport'];
	$status_id=$fetch_query['status_id'];
	$created_time=$fetch_query['created_time'];
	$updated_time=$fetch_query['updated_time'];

	 return '[{"subject_id":"'.$subject_id.'","subject_name":"'.$subject_name.',"subject_summary":"'.$subject_summary.',"subject_passport":"'.$subject_passport.',"status_id":"'.$status_id.',"created_time":"'.$created_time.',"updated_time":"'.$updated_time.'"}]';
}


function _alert_sequence_and_update($conn,$alert_detail,$staff_id,$fullname,$ip_address,$sysname,$role_id){
	$alertsele=mysqli_fetch_array(mysqli_query($conn,"SELECT counter_value FROM setup_counter_tab WHERE counter_id = 'ALT' FOR UPDATE"));
	$alertno=$alertsele[0]+1;
	$alertid='ALT'.$alertno;
	
	mysqli_query($conn,"INSERT INTO `alert_tab`
	(`alert_id`, `alert_detail`, `staff_id`, `fullname`, `ipaddress`, `computer`, `role_id`, `seen_status`, `date`) VALUES
	('$alertid', '$alert_detail', '$staff_id', '$fullname', '$ip_address', '$sysname', '$role_id', 0, NOW())")or die (mysqli_error($conn));
	
	mysqli_query($conn,"UPDATE setup_counter_tab SET counter_value='$alertno' WHERE counter_id = 'ALT'")or die (mysqli_error($conn));
}





//////////// USER FUNCTIONS//////////////////////
function _get_user_detail($conn, $user_id){
	$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE user_id='$user_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
			$wallet_balance=$fetch['wallet_balance'];
			$user_id=$fetch['user_id'];
			$fullname=$fetch['fullname'];
			$mobile=$fetch['mobile'];
			$email=$fetch['email'];
			$address=$fetch['address'];
			$passport=$fetch['passport'];
			$reg_otp=$fetch['reg_otp'];
			$otp=$fetch['otp'];
			$status_id=$fetch['status_id'];
			$last_login=$fetch['last_login'];
	return '[{"user_id":"'.$user_id.'","wallet_balance":"'.$wallet_balance.'","fullname":"'.$fullname.'","mobile":"'.$mobile.'",
		"email":"'.$email.'","address":"'.$address.'","passport":"'.$passport.'","otp":"'.$otp.'","reg_otp":"'.$reg_otp.'", "status_id":"'.$status_id.'", "last_login":"'.$last_login.'"}]';
}	
	


function _get_sub_topic_detail($conn, $sub_topic_id){
	$query=mysqli_query($conn,"SELECT * FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
	$subject_id=$fetch['subject_id'];
	$topic_id=$fetch['topic_id'];
	$sub_topic_id=$fetch['sub_topic_id'];
	$sub_topic_name=$fetch['sub_topic_name'];
	$sub_topic_url=$fetch['sub_topic_url'];
	$subscription_price=$fetch['subscription_price'];
	$seo_keywords=$fetch['seo_keywords'];
	$seo_description=$fetch['seo_description'];
	$subscription_duration_id=$fetch['subscription_duration_id'];
	$sub_topic_passport=$fetch['sub_topic_passport'];
	$status_id=$fetch['status_id'];
	$created_time=$fetch['created_time'];
	$updated_time=$fetch['updated_time'];
			
		return '[{"subject_id":"'.$subject_id.'","topic_id":"'.$topic_id.'","sub_topic_id":"'.$sub_topic_id.'","sub_topic_name":"'.$sub_topic_name.'","subscription_price":"'.$subscription_price.'","subscription_duration_id":"'.$subscription_duration_id.'"}]';
	
}	


function _get_topic_detail($conn, $topic_id){
	$query=mysqli_query($conn,"SELECT * FROM topic_tab WHERE topic_id='$topic_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
	$exam_id=$fetch['exam_id'];
	$subject_id=$fetch['subject_id'];
	$topic_id=$fetch['topic_id'];
	$topic_name=$fetch['topic_name'];
	$status_id=$fetch['status_id'];
	$created_time=$fetch['created_time'];
	$updated_time=$fetch['updated_time'];
			
	return '[{"exam_id":"'.$exam_id.'","subject_id":"'.$subject_id.'","topic_id":"'.$topic_id.'","topic_name":"'.$topic_name.'",
		"status_id":"'.$status_id.'","created_time":"'.$created_time.'"}]';
}	



/////////////////////////////////////////
function _get_user_wallet_detail($conn, $user_id){
	/////// credit 
	$query = mysqli_query($conn, "SELECT COALESCE(SUM(amount), 0) AS amount_received FROM user_wallet_tab WHERE user_id='$user_id' AND transaction_type_id='CR' AND status_id=5") or die(mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
	$amount_received=$fetch['amount_received'];
	/////// debit 
	$query=mysqli_query($conn,"SELECT COALESCE(SUM(amount), 0) AS amount_withdraw FROM user_wallet_tab WHERE user_id='$user_id' AND transaction_type_id='DB' AND status_id=5")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
	$amount_withdraw=$fetch['amount_withdraw'];

	return '[{"amount_received":"'.$amount_received.'","amount_withdraw":"'.$amount_withdraw.'"}]';
}



/////////////////////////////////////////
function _user_validate_accesskey($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE access_key='$access_key' AND  status_id=1 ")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$user_id=$fetch_query['user_id'];
			$check=1; 
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","user_id":"'.$user_id.'"}]';
}


/////////////////////////////////////////
function _get_payment_details($conn, $payment_id ){
	$query=mysqli_query($conn,"SELECT * FROM payment_tab WHERE payment_id  = '$payment_id '");
	$fetch_query=mysqli_fetch_array($query);
	$user_id=$fetch_query['user_id'];
	$payment_id=$fetch_query['payment_id'];
	$payment_gateway_id=$fetch_query['payment_gateway_id'];
	$sub_topic_id=$fetch_query['sub_topic_id'];
	$transaction_type_id=$fetch_query['transaction_type_id'];
	$fund_method_id=$fetch_query['fund_method_id'];
	$amount=$fetch_query['amount'];
	$status_id=$fetch_query['status_id'];
	$staff_id=$fetch_query['staff_id'];
	$date=$fetch_query['date'];
	
	
	return '[{"user_id":"'.$user_id.'","payment_id":"'.$payment_id.'","payment_gateway_id":"'.$payment_gateway_id.'","sub_topic_id":"'.$sub_topic_id.'",
		"transaction_type_id":"'.$transaction_type_id.'","fund_method_id":"'.$fund_method_id.'","amount":"'.$amount.'","status_id":"'.$status_id.'","staff_id":"'.$staff_id.'","date":"'.$date.'"}]';
}


function _get_payment_purpose_details($conn, $payment_purpose_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_payment_purpose_tab WHERE payment_purpose_id = '$payment_purpose_id'");
	$fetch_query=mysqli_fetch_array($query);
	$payment_purpose_id=$fetch_query['payment_purpose_id'];
	$payment_purpose_name=$fetch_query['payment_purpose_name'];
	
	 return '[{"payment_purpose_id":"'.$payment_purpose_id.'","payment_purpose_name":"'.$payment_purpose_name.'"}]';
}





















}//end of class
$callclass=new allClass();
?>