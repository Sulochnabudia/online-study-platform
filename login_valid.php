<?php 
	session_start();
	include "config.php";// database connect
	$error=0;
	
	$mobile_number = $_POST['mobile_number'] ;//store mobile number
	$password = md5($_POST['password']); // store password
	$user_type = $_POST['select_user'];
	

	// PHP code to get the MAC address of Client 
$MAC = exec('getmac'); 
  
// Storing 'getmac' value in $MAC 
$MAC = strtok($MAC, ' '); 
	
	//check mobile and password validation
	if(isset($_POST['login'])){
		
		if(empty($_POST['mobile_number'])){
			$error=1;
			$_SESSION['login_mobile_error']="Mobile number is not valid.";
		}
		
		if(empty($_POST['password'])){
			$error=1;
			$_SESSION['login_password_error']="Password is not valid.";
		}
	
	}

	if($error){
		header("location:login.html");
	}
		else{
			
			if($user_type == 'Student'){
				
				$student_check_query = "SELECT * FROM student WHERE  mobile='$mobile_number' AND password='$password' AND verify='1' LIMIT 1";
				$result = mysqli_query($db,$student_check_query);
				$student = mysqli_fetch_assoc($result);
			
			
				$student_check_query1 = "SELECT * FROM student WHERE  mobile='$mobile_number' AND password='$password' AND verify='0' LIMIT 1";
				$result5 = mysqli_query($db,$student_check_query1);
				$student1 = mysqli_fetch_assoc($result5);
				
				
				if ($student) { // if student exists	
				
						if($student['type']=='School'){
							if($student['account_status']!=1){
								$_SESSION['login_error']="Your account is not approved Please Contact Your Institute";
								$_SESSION['mobile_number']=$_POST['mobile_number'];
								$_SESSION['password']=$_POST['password'];
								header("location:login.html");
								exit();
							}
								else{
										
										
										$query = "UPDATE student SET MAC = '$MAC' WHERE mobile = '$mobile_number'";
										if(!mysqli_query($db,$query)){
											$_SESSION['login_error']="Technical Problem";
											$_SESSION['mobile_number']=$_POST['mobile_number'];
											$_SESSION['password']=$_POST['password'];
											header("location:login.html");
											exit();
										}
										else{
												$exists=0;
												
												$student78 = "SELECT * FROM student WHERE mobile='$_POST[mobile_number]'";
												$result78 = mysqli_query($db,$student78);
												$row78 = mysqli_fetch_array($result78);
											
												$form = "SELECT * FROM form WHERE status='1' AND school_id='$row78[join_id]' AND course='$row78[course]'";
												$form_result = mysqli_query($db,$form);
						
												while($form_row = mysqli_fetch_array($form_result)){
							
												$form_submit = "SELECT * FROM form_submt WHERE student_id='$row78[id]' AND form_id='$form_row[id]' AND status='1'";
												$form_submit_result = mysqli_query($db,$form_submit);
												$form_submit_row = mysqli_fetch_array($form_submit_result);
													if(!$form_submit_row){
														$exists = 1;
														$_SESSION['FORM_ID']= $form_row['id'];
														if($exists){
															$_SESSION['id']=$student['id'];
															$_SESSION['LIAME']=$student['email'];
															header("location:user/form.html");
															exit();
														}
										
															else{
																	$_SESSION['id']=$student['id'];
																	$_SESSION['LIAME']=$student['email'];
																	header("location:user/home.html");
																	exit();
														}
														
													}
												}
											$_SESSION['id']=$student['id'];
											$_SESSION['LIAME']=$student['email'];
											header("location:user/home.html");
											exit();	
												
										
										}
								}
						}
						else{
							
								$query = "UPDATE student SET MAC = '$MAC' WHERE mobile = '$mobile_number'";
										if(!mysqli_query($db,$query)){
											$_SESSION['login_error']="Technical Problem";
											$_SESSION['mobile_number']=$_POST['mobile_number'];
											$_SESSION['password']=$_POST['password'];
											header("location:login.html");
											exit();
										}
										else{
												$_SESSION['id']=$student['id'];
												$_SESSION['LIAME']=$student['email'];
												header("location:user/home.html");
												exit();
										}
							
						}
				}
					
					

					elseif($student1){
									$otp = rand(100000,999999);
									$mobile = $mobile_number;
									
									$query ="UPDATE student SET otp='$otp' WHERE mobile='$mobile'";
									if(!mysqli_query($db,$query)){
										header("location:login.html");
										exit();
									}
									else{
									
									$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
									$message = urlencode($message); 
									$ch=curl_init(); 
									curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
									$output =curl_exec($ch); 
									curl_close($ch);
									
									
									$_SESSION['SEND_NAME']=$student1['full_name'];
									$_SESSION['SEND_PASS']=$_POST['password'];
									$_SESSION['ACCOUNT_TYPE']='STUDENT';
									$_SESSION['student_mobile']=$mobile;
									header("location:verify.html");
									exit();
								}
					}
				
					
						else{
							
											$_SESSION['login_error']="Please check your logins credentials";
											$_SESSION['mobile_number']=$_POST['mobile_number'];
											$_SESSION['password']=$_POST['password'];
											header("location:login.html");
											exit();
				}
		}
				
				elseif($user_type=='Faculty'){ // if user type is faculty
					
					$faculty_check_query = "SELECT * FROM faculty WHERE  mobile='$mobile_number' AND password='$password' AND verify='1' AND acc_type='FACULTY' LIMIT 1";
					$result_1 = mysqli_query($db,$faculty_check_query);
					$faculty = mysqli_fetch_assoc($result_1);
					
					$faculty_check_query1 = "SELECT * FROM faculty WHERE  mobile='$mobile_number' AND password='$password' AND verify='0' AND acc_type='FACULTY' LIMIT 1";
					$result_11 = mysqli_query($db,$faculty_check_query1);
					$faculty1 = mysqli_fetch_assoc($result_11);
				
					if ($faculty) { // if faculty exists	
							$_SESSION['faculty_id']=$faculty['id'];
							$_SESSION['FACULTY_LIAME']=$faculty['email'];
							$_SESSION['mobile']=$faculty['mobile'];
							header("location:faculty/home.html");
							exit();

					}
					
					
					elseif($faculty1){
									$otp = rand(100000,999999);
									$mobile = $mobile_number;
									
									
									$query ="UPDATE faculty SET otp='$otp' WHERE mobile='$mobile'";
									if(!mysqli_query($db,$query)){
										header("location:login.html");
										exit();
									}
									else{
									
									
									$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
									$message = urlencode($message); 
									$ch=curl_init(); 
									curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
									$output =curl_exec($ch); 
									curl_close($ch);
									
									$_SESSION['SEND_NAME']=$faculty1['name'];
									$_SESSION['SEND_PASS']=$_POST['password'];
									$_SESSION['ACCOUNT_TYPE']='FACULTY';
									$_SESSION['faculty_mobile']=$mobile;
									header("location:verify.html");
									exit();
								}
					}
											else{
												$_SESSION['login_error']="Please check your logins credentials";
												$_SESSION['mobile_number']=$_POST['mobile_number'];
												$_SESSION['password']=$_POST['password'];
												header("location:login.html");
												exit();
											}
					
				}
				
				
				
				
				
				
				
				elseif($user_type=='School'){ // if user type is faculty
					
					$faculty_check_query = "SELECT * FROM faculty WHERE  mobile='$mobile_number' AND password='$password' AND verify='1' AND acc_type='SCHOOL' LIMIT 1";
					$result_1 = mysqli_query($db,$faculty_check_query);
					$faculty = mysqli_fetch_assoc($result_1);
					
					$faculty_check_query1 = "SELECT * FROM faculty WHERE  mobile='$mobile_number' AND password='$password' AND verify='0' AND acc_type='SCHOOL' LIMIT 1";
					$result_11 = mysqli_query($db,$faculty_check_query1);
					$faculty1 = mysqli_fetch_assoc($result_11);
				
					if ($faculty) { // if faculty exists	
					
							if($faculty['type']=='Goverment'&&$faculty['status']==0){
												$_SESSION['login_error']="Your account is not approve.";
												$_SESSION['mobile_number']=$_POST['mobile_number'];
												$_SESSION['password']=$_POST['password'];
												header("location:login.html");
												exit();
							}
								else{
										$_SESSION['faculty_id']=$faculty['id'];
										$_SESSION['FACULTY_LIAME']=$faculty['email'];
										$_SESSION['mobile']=$faculty['mobile'];
										header("location:faculty/home.html");
										exit();
								}
					}
					
					
					elseif($faculty1){
									$otp = rand(100000,999999);
									$mobile = $mobile_number;
									
									
									$query ="UPDATE faculty SET otp='$otp' WHERE mobile='$mobile'";
									if(!mysqli_query($db,$query)){
										header("location:login.html");
										exit();
									}
									else{
									
									
									$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
									$message = urlencode($message); 
									$ch=curl_init(); 
									curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
									$output =curl_exec($ch); 
									curl_close($ch);
									
									$_SESSION['SEND_NAME']=$faculty1['name'];
									$_SESSION['SEND_PASS']=$_POST['password'];
									$_SESSION['ACCOUNT_TYPE']='FACULTY';
									$_SESSION['faculty_mobile']=$mobile;
									header("location:verify.html");
									exit();
								}
					}
											else{
												$_SESSION['login_error']="Please check your logins credentials";
												$_SESSION['mobile_number']=$_POST['mobile_number'];
												$_SESSION['password']=$_POST['password'];
												header("location:login.html");
												exit();
											}
					
				}
				
				
				
				
				
					
							else{
							header("location:login.html");
							exit();
						}
				
			
			
				
					
		}
	
?>