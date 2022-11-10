<?php 
	session_start();
	include "config.php";
	
	if(isset($_SESSION['ACCOUNT_TYPE'])){
		if($_SESSION['ACCOUNT_TYPE']=='SCHOOL'){
			$registered_mobile=$_SESSION['school_mobile'];
		}
			elseif($_SESSION['ACCOUNT_TYPE']=='FACULTY'){
				$registered_mobile=$_SESSION['faculty_mobile'];
			}
				elseif($_SESSION['ACCOUNT_TYPE']=='STUDENT'){
					$registered_mobile=$_SESSION['student_mobile'];
				}
					else{
						header("location:login.html");
						exit();
					}
	}
		else{
			header("location:login.html");
			exit();
		}
	
	
	$error=0;
	
	if(!isset($_SESSION['ACCOUNT_TYPE'])){
		header("location:login.html");
		exit();
	}
	
	if(isset($_POST['otp_verify'])){
		
		if(empty($_POST['otp'])){
			$_SESSION['otp_error']="Invalid Otp.";
			$error=1;
		}
		
	}
	if($error){
		header("location:verify.html");
	}
		else{
			
			if(isset($_POST['otp_verify'],$_SESSION['ACCOUNT_TYPE'])){
			
			if($_SESSION['ACCOUNT_TYPE']=='STUDENT'){
				
				$user_check_query = "SELECT otp FROM student WHERE  mobile='$registered_mobile' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
  
			if ($user) { // if user exists
					
					if($user['otp'] == $_POST['otp']){
						
						$student_query = "UPDATE student SET verify='1' WHERE mobile='$registered_mobile'";
						if(!mysqli_query($db,$student_query)){
							header("location:login.html");
							exit();
						}
						
						$name = $_SESSION['SEND_NAME'];
						$pass = $_SESSION['SEND_PASS'];						
						
						$message = "Dear ".$name.",Thank for registering with mytarget.in. Your Password is ".$pass."";
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch);
						$_SESSION['sign_up_success']="Your account create successfully. You can login now";
						header("location:login.html");
						exit();
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:verify.html");
								exit();
					
					}
					
				}
				
			}
				elseif($_SESSION['ACCOUNT_TYPE']=='FACULTY'){
					
					$faculty_check_query = "SELECT otp FROM faculty WHERE  mobile='$registered_mobile' LIMIT 1";
					$result_1 = mysqli_query($db, $faculty_check_query);
					$faculty = mysqli_fetch_assoc($result_1);
  
					if ($faculty) { // if user exists
					
					if($faculty['otp'] == $_POST['otp']){
						
						$faculty_query = "UPDATE faculty SET verify='1' WHERE mobile='$registered_mobile'";
						if(!mysqli_query($db,$faculty_query)){
							header("location:login.html");
							exit();
						}
						
						$name = $_SESSION['SEND_NAME'];
						$pass = $_SESSION['SEND_PASS'];						
						
						$message = "Dear ".$name.",Thank for registering with mytarget.in. Your Password is ".$pass."";
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch);
						$_SESSION['sign_up_success']="Your account create successfully. You can login now";
						header("location:login.html");
						exit();
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:verify.html");
								exit();
					
					}
					
				}
				
				}
				
				
				elseif($_SESSION['ACCOUNT_TYPE']=='SCHOOL'){
					
					$school_check_query = "SELECT otp FROM faculty WHERE  mobile='$registered_mobile' LIMIT 1";
					$result_2 = mysqli_query($db, $school_check_query);
					$school = mysqli_fetch_assoc($result_2);
  
					if ($school) { // if user exists
					
					if($school['otp'] == $_POST['otp']){
						
						$school_query = "UPDATE faculty SET verify='1' WHERE mobile='$registered_mobile'";
						if(!mysqli_query($db,$school_query)){
							header("location:login.html");
							exit();
						}
						
						$name = $_SESSION['SEND_NAME'];
						$pass = $_SESSION['SEND_PASS'];						
						
						$message = "Dear ".$name.",Thank for registering with mytarget.in. Your Password is ".$pass."";
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch);
						
						$_SESSION['sign_up_success']="Your account create successfully. You can login now";
						header("location:login.html");
						exit();
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:verify.html");
								exit();
					
					}
					
				}
				
				}
				
							else{
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