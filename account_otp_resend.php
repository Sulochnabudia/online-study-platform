<?php 

	session_start();
	error_reporting(0);
	include 'config.php';
	
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
	
		
		
		if(isset($_SESSION['ACCOUNT_TYPE'])){
			
			if($_SESSION['ACCOUNT_TYPE']=='STUDENT'){
				$mobile_number = $registered_mobile;
				$otp = rand(100000,999999);
	
				$query = "UPDATE student SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
				mysqli_query($db,$query);
		
				$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
				$message = urlencode($message); 
				$ch=curl_init(); 
				curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
				$output =curl_exec($ch); 
				curl_close($ch);
	
				
				$_SESSION['otp_resend_success']="OTP resend Successfully our mobile number.";
				header("location:verify.html");
				exit();
			}
			
				//if faculty
				elseif($_SESSION['ACCOUNT_TYPE']=='FACULTY'){
					
							$mobile_number = $registered_mobile;
							$otp = rand(100000,999999);
	
							$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
							mysqli_query($db,$query);
		
							$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
							$message = urlencode($message); 
							$ch=curl_init(); 
							curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
							$output =curl_exec($ch); 
							curl_close($ch);
							
							
							$_SESSION['otp_resend_success']="OTP resend Successfully our mobile number.";
							header("location:verify.html");
							exit();
					
				}
				
				
					//if school
				elseif($_SESSION['ACCOUNT_TYPE']=='SCHOOL'){
					
							$mobile_number = $registered_mobile;
							$otp = rand(100000,999999);
	
							$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
							mysqli_query($db,$query);
		
							$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
							$message = urlencode($message); 
							$ch=curl_init(); 
							curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
							$output =curl_exec($ch); 
							curl_close($ch);
							
							
							$_SESSION['otp_resend_success']="OTP resend Successfully our mobile number.";
							header("location:verify.html");
							exit();
					
				}
				
							else{
									header("location:login.html");
									exit();
							}
			
			
		}
	}
	else{
			header("location:login.html");
			exit();
		}
	
?>