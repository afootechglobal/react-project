<?php require_once '../config/connection.php';?>
<?php require_once '../config/functions.php';?>
<?php
header('Content-Type: application/json; charset=UTF-8');
$action=$_POST['action'];

	switch ($action){
 

		case 'fetch_cat_api':                                                                                                
			$query=mysqli_query($conn,"SELECT * FROM setup_categories_tab ");
			$response['response']=100;
			$response['result']=true;
			while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
				$response['data']=$fetch_query;
			}                                                                                                                      
		break;

		case 'fetch_index_exam_api':
			$exam_id=trim(strtoupper($_POST['exam_id']));
			$status_id=($_POST['status_id']);
			/// write sql statement and function that will return all exam here
			if ($exam_id=='') {///start if 1
				$query=mysqli_query($conn,"SELECT a.*, 
				(SELECT COUNT(b.subject_id) FROM exam_subject_tab b, subject_tab c WHERE a.exam_id=b.exam_id AND b.subject_id=c.subject_id AND c.status_id=1) AS total_exam_subject_count 
				FROM exam_tab a
				WHERE a.status_id=1 
				ORDER BY a.exam_name ASC")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 2
					$response['response']=102;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{ // Else if 1
					$response['response']=103;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 2
			}else{///else if 2
				$query=mysqli_query($conn,"SELECT * FROM exam_tab WHERE exam_id='$exam_id' AND status_id=1")or die (mysqli_error($conn));
				$response['response']=104;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
				$response['data']=$fetch_query;
				} 
			} //enf if 1
		break;

		case 'fetch_index_avail_exam_api':
			$exam_id=trim(strtoupper($_POST['exam_id']));
			$status_id=($_POST['status_id']);
			/// write sql statement and function that will return all exam here
				$query=mysqli_query($conn,"SELECT a.*, 
				(SELECT COUNT(b.subject_id) FROM exam_subject_tab b, subject_tab c WHERE a.exam_id=b.exam_id AND b.subject_id=c.subject_id AND c.status_id=1) AS total_exam_subject_count 
				FROM exam_tab a
				WHERE a.status_id=1 
				ORDER BY RAND() ASC LIMIT 6")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 1
					$response['response']=102;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
				}else{ // Else if 1
					$response['response']=103;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 1
		break;


		case 'fetch_index_exam_subject_api':
			$subject_id=$_POST['subject_id'];
			$exam_id=$_POST['exam_id'];
			$status_id=$_POST['status_id'];
			$exam_url=$_POST['exam_url'];

			if ($subject_id=='') {///start if 1
				/// write sql statement and function that will return all exam subject here
				$query=mysqli_query($conn,"SELECT a.*, 
				b.subject_name, b.subject_passport, b.subject_url,
				(SELECT COUNT(c.topic_id) FROM topic_tab c WHERE c.exam_id='$exam_id' AND a.subject_id=c.subject_id AND c.status_id=1) AS total_topic_count
				FROM exam_subject_tab a, subject_tab b
				WHERE a.subject_id=b.subject_id 
				AND a.exam_id='$exam_id' 
				AND b.status_id=1 ")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 3
					$response['response']=105;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
						$response['data']=$fetch_query;
					}
					$query=mysqli_query($conn,"SELECT exam_id, exam_url FROM exam_tab WHERE exam_id='$exam_id'") or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$exam_id=$fetch_query['exam_id'];
					$exam_url=$fetch_query['exam_url'];
					$response['exam_id']=$exam_id;
					$response['exam_url']=$exam_url;
				}else{ // Else 3
					$response['response']=106;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 3
			} else {///else 2
				$query=mysqli_query($conn,"SELECT * FROM subject_tab WHERE subject_id='$subject_id' AND status_id=1")or die (mysqli_error($conn));
				$response['response']=107;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
					$subject_name=$fetch_query['subject_name'];
					$response['subject_name']=ucwords(strtolower($subject_name));
					$response['data']=$fetch_query;
				} 
				$query=mysqli_query($conn,"SELECT * FROM exam_tab WHERE exam_id='$exam_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_array($query);
				$exam_url=$fetch_query['exam_url'];
				$response['exam_url']=$exam_url;
				
			} //enf if 1
		break;




		case 'fetch_exam_index_subject_api':
			$subject_id=trim(strtoupper($_POST['subject_id']));
			$status_id=($_POST['status_id']);

			$query=mysqli_query($conn,"SELECT a.*,
			(SELECT COUNT(b.topic_id) FROM topic_tab b WHERE a.subject_id=b.subject_id AND b.status_id=1) AS total_topic_count
			FROM subject_tab a WHERE a.status_id=1 ORDER BY RAND() LIMIT 4")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 2
				$response['response']=108;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
				$response['data']=$fetch_query;
				}
			}else{ // Else if 1
				$response['response']=109;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 2
		break;


		case 'fetch_all_index_subject_api':
			$subject_id=trim(strtoupper($_POST['subject_id']));
			$status_id=($_POST['status_id']);

			$query=mysqli_query($conn,"SELECT a.*, 
			(SELECT COUNT(b.topic_id) FROM topic_tab b WHERE b.subject_id=a.subject_id AND b.status_id=1) AS total_topic_count
			FROM subject_tab a 
			WHERE a.status_id=1 
			ORDER BY subject_name ASC")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 2
				$response['response']=110;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
				$response['data']=$fetch_query;
				}
			}else{ // Else if 1
				$response['response']=111;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 2
		break;


		case 'fetch_index_topic_api':
			$topic_id=trim(strtoupper($_POST['topic_id']));
			$exam_id=trim(strtoupper($_POST['exam_id']));
			$subject_id=trim(strtoupper($_POST['subject_id']));
			$status_id=($_POST['status_id']);
			$search_txt=($_POST['search_txt']);

			$search_like="(topic_name like '%$search_txt%')";

			/// write sql statement and function that will return all topic here
			if ($topic_id=='') {///start if 1
				$query=mysqli_query($conn,"SELECT a.*, 
				(SELECT COUNT(b.sub_topic_id) FROM sub_topic_tab b WHERE b.topic_id=a.topic_id AND b.status_id=1) AS total_sub_topic_count 
				FROM topic_tab a
				WHERE a.exam_id LIKE '%$exam_id%' 
				AND a.subject_id LIKE '%$subject_id%' 
				AND $search_like AND a.status_id=1")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 2
					$response['response']=108;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
					}
				}else{ // Else if 1
					$response['response']=109;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 2
			}else{///else if 3
				$query=mysqli_query($conn,"SELECT * FROM  topic_tab WHERE topic_id LIKE '%$topic_id%' AND status_id LIKE '%$status_id%' AND $search_like ORDER BY topic_name ASC")or die (mysqli_error($conn));
				$response['response']=110;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
				$response['data']=$fetch_query;
				} 
			} //end if 1	
		break;



		case 'fetch_index_sub_topic_api':
			$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
			$topic_id=trim(strtoupper($_POST['topic_id']));
			$exam_url=trim(strtolower($_POST['exam_url']));
			$subject_url=trim(strtolower($_POST['subject_url']));
			$status_id=($_POST['status_id']);

			/// write sql statement and function that will return all sub topic here
			if ($sub_topic_id=='') {///start if 1
				$query=mysqli_query($conn,"SELECT * FROM sub_topic_tab WHERE topic_id='$topic_id' AND status_id=1")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 2
					$response['response']=111;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
					}
					$query=mysqli_query($conn,"SELECT exam_url FROM exam_tab a, topic_tab b WHERE a.exam_id=b.exam_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$exam_url=$fetch_query['exam_url'];
					$response['exam_url']=$exam_url;

					$query=mysqli_query($conn,"SELECT subject_url FROM subject_tab a, topic_tab b WHERE a.subject_id=b.subject_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
					$fetch_query=mysqli_fetch_array($query);
					$subject_url=$fetch_query['subject_url']; 
					$response['subject_url']=$subject_url;
				}else{ // Else if 1
					$response['response']=112;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 2
			}else{///else if 2
				$query=mysqli_query($conn,"SELECT * FROM sub_topic_tab WHERE sub_topic_id='$sub_topic_id'")or die (mysqli_error($conn));
				$response['response']=113;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
				$sub_topic_name=$fetch_query['sub_topic_name'];
				$response['sub_topic_name']=ucwords(strtolower($sub_topic_name));
				$response['data']=$fetch_query;
				} 
				
				$query=mysqli_query($conn,"SELECT exam_url FROM exam_tab a, topic_tab b WHERE a.exam_id=b.exam_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_array($query);
				$exam_url=$fetch_query['exam_url'];
				$response['exam_url']=$exam_url;

				$query=mysqli_query($conn,"SELECT subject_url FROM subject_tab a, topic_tab b WHERE a.subject_id=b.subject_id AND topic_id='$topic_id'") or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_array($query);
				$subject_url=$fetch_query['subject_url']; 
				$response['subject_url']=$subject_url;
			} //end if 1		
		break;



		case 'fetch_blog_api':
			$staff_id=trim(strtoupper($_POST['staff_id']));
			$blog_id=trim(strtoupper($_POST['blog_id']));	
			$cat_id=trim(strtoupper($_POST['cat_id']));
			$status_id=($_POST['status_id']);
			$search_txt=($_POST['search_txt']);

			$search_like="(blog_title like '%$search_txt%')";

			/// write sql statement and function that will return all blog here
			if ($blog_id=='') {///start if 1
				$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE cat_id LIKE '%$cat_id%' AND status_id=1 AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 2
					$response['response']=114;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
					}
				}else{ // Else if 2
					$response['response']=115;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 2
			}else{///else if 2
				$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE blog_id LIKE '%$blog_id%' AND status_id LIKE '%$status_id%' AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
				$response['response']=116;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
				$response['data']=$fetch_query;
				}
				
				$query=mysqli_query($conn,"SELECT fullname FROM staff_tab a, blog_tab b WHERE a.staff_id=b.staff_id")or die (mysqli_error($conn));
				$fetch_query=mysqli_fetch_array($query);
				$fullname=$fetch_query['fullname'];
				$response['fullname']=ucwords(strtolower($fullname));
			} //end if 1	
		break;


		case 'fetch_index_blog_api':
			$blog_id=trim(strtoupper($_POST['blog_id']));
			$status_id=($_POST['status_id']);

			/// write sql statement and function that will return all index blog here
			if ($blog_id=='') {///start if 1
				$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE status_id=1 ORDER BY created_time DESC LIMIT 3")or die (mysqli_error($conn));
				$check_query=mysqli_num_rows($query);
				if ($check_query>0) { // start if 2
					$response['response']=117;
					$response['result']=true;
					while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;
					}
				}else{ // Else if 2
					$response['response']=118;
					$response['result']=false;
					$response['message']="NO RECORD FOUND!!!"; 
				}// End if 2
			}else{///else if 2
				$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE blog_id='$blog_id' AND status_id=1 ORDER BY created_time DESC")or die (mysqli_error($conn));
				$response['response']=119;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_assoc($query)){
				$response['data']=$fetch_query;
				} 
			} //end if 1	
		break;


		case 'fetch_faq_api':
			$faq_id=trim(strtoupper($_POST['faq_id']));
			$cat_id=($_POST['cat_id']);
			$status_id=($_POST['status_id']);
			$search_txt=($_POST['search_txt']);

			$search_like="(faq_question like '%$search_txt%')";
			
			$query=mysqli_query($conn,"SELECT * FROM faq_tab WHERE cat_id LIKE '%$cat_id%' AND status_id=1 AND $search_like ORDER BY created_time DESC")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 1
				$response['response']=117;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
				$response['data']=$fetch_query;
				}
			}else{ // Else if 2
				$response['response']=118;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 1	
		break;


		case 'fetch_index_faq_api':
			$faq_id=trim(strtoupper($_POST['faq_id']));
			$status_id=($_POST['status_id']);
		
			$query=mysqli_query($conn,"SELECT * FROM faq_tab WHERE status_id=1 ORDER BY created_time DESC LIMIT 5")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 1
				$response['response']=119;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
				$response['data']=$fetch_query;
				}
			}else{ // Else if 2
				$response['response']=120;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 1	
		break;


		case 'fetch_index_sub_topic_premium_video_api':
			$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
			$video_id=trim(strtoupper($_POST['video_id']));
			$status_id=($_POST['status_id']);

			$query=mysqli_query($conn,"SELECT a.*, b.subscription_pricing_name, c.video_volume_name FROM sub_topic_video_tab a, setup_subscription_pricing_tab b, setup_video_volume_tab c WHERE a.subscription_pricing_id=b.subscription_pricing_id AND a.video_volume_id=c.video_volume_id AND a.subscription_pricing_id=2 AND a.status_id=1 AND sub_topic_id='$sub_topic_id' ORDER BY video_volume_name ASC ")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 1
				$response['response']=121;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;	
				}
			}else{ // Else 1
				$response['response']=122;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 1
		break;

		case 'fetch_index_sub_topic_free_video_api':
			$sub_topic_id=trim(strtoupper($_POST['sub_topic_id']));
			$video_id=trim(strtoupper($_POST['video_id']));
			$status_id=($_POST['status_id']);

			$query=mysqli_query($conn,"SELECT a.*, b.subscription_pricing_name, c.video_volume_name FROM sub_topic_video_tab a, setup_subscription_pricing_tab b, setup_video_volume_tab c WHERE a.subscription_pricing_id=b.subscription_pricing_id AND a.video_volume_id=c.video_volume_id AND a.subscription_pricing_id=1 AND a.status_id=1 AND a.sub_topic_id='$sub_topic_id' ORDER BY video_volume_name ASC LIMIT 1")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 1
				$response['response']=120;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;	
				}
			}else{ // Else 1
				$response['response']=121;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 2
		break;

		
		case 'fetch_index_random_free_video_api':
			$query=mysqli_query($conn,"SELECT a.abbreviation, e.subject_url, c.sub_topic_url,
			 d.*,f.subscription_pricing_name,  
			g.video_volume_name  

			FROM 
			exam_tab a, topic_tab b, sub_topic_tab c, 
			sub_topic_video_tab d, subject_tab e, 
			setup_subscription_pricing_tab f,
			setup_video_volume_tab g
		      
			WHERE a.exam_id=b.exam_id AND b.topic_id=c.topic_id AND c.sub_topic_id=d.sub_topic_id
			AND e.subject_id=b.subject_id AND b.subject_id=c.subject_id
			AND c.sub_topic_id=c.sub_topic_id
			
			AND d.subscription_pricing_id = f.subscription_pricing_id
			AND d.video_volume_id = g.video_volume_id
			AND d.status_id = 1
			AND d.subscription_pricing_id = 1 
			ORDER BY RAND() LIMIT 1")or die (mysqli_error($conn));
			$check_query=mysqli_num_rows($query);
			if ($check_query>0) { // start if 1
				$response['response']=120;
				$response['result']=true;
				while($fetch_query=mysqli_fetch_all($query, MYSQLI_ASSOC)){
					$response['data']=$fetch_query;	
				}
			}else{ // Else 1
				$response['response']=121;
				$response['result']=false;
				$response['message']="NO RECORD FOUND!!!"; 
			}// End if 2
		break;


			


























		

}
echo json_encode($response);

?>





