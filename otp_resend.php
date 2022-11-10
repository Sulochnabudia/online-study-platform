<?php 

	session_start();
	error_reporting(0);
	include 'config.php';
	
	if(!isset($_SESSION['user_type'],$_SESSION['registered_mobile'])){
		header("location:password_reset.html");
		exit();
	}
	
		else{
			
			if($_SESSION['user_type']=='Student'){
				$mobile_number = $_SESSION['registered_mobile'];
				$otp = rand(100000,999999);
	
				$query = "UPDATE student SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
				mysqli_query($db,$query);
		
				$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
				$message = urlencode($message); 
				$ch=curl_init(); 
				curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
				$output =curl_exec($ch); 
				curl_close($ch);
	
				header("location:otp_verify.html");
				exit();
			}
			
				//if faculty
				elseif($_SESSION['user_type']=='Faculty'){
					
							$mobile_number = $_SESSION['registered_mobile'];
							$otp = rand(100000,999999);
	
							$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
							mysqli_query($db,$query);
		
							$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
							$message = urlencode($message); 
							$ch=curl_init(); 
							curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
							$output =curl_exec($ch); 
							curl_close($ch);
	
							header("location:otp_verify.html");
							exit();
					
				}
				
				
				
				//if school
				elseif($_SESSION['user_type']=='School'){
					
					$mobile_number = $_SESSION['registered_mobile'];
							$otp = rand(100000,999999);
	
							$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$mobile_number'";//it is used to store otp in database
							mysqli_query($db,$query);
		
							$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
							$message = urlencode($message); 
							$ch=curl_init(); 
							curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile_number."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
							$output =curl_exec($ch); 
							curl_close($ch);
	
							header("location:otp_verify.html");
							exit();
							
					
				}
				
				
				
				
				
				
					else{
						$_SESSION['otp_resend_success']="OTP resend Successfully our mobile number.";
						header("location:password_reset.html");
						exit();
					}
			
			
		}
	
	
?>