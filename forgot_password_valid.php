<?php 
	session_start();
	include "config.php"; //connect database
	$error=0;
	
	$registered_mobile = $_POST['registered_mobile'] ;//store mobile number
	$user_type = $_POST['select_user'];
	
	//check mobile
	if(isset($_POST['send_otp'])){
		
		if(empty($_POST['registered_mobile'])){
			$error=1;
			$_SESSION['registered_mobile_error']="Mobile number is not valid.";
		}
	
	}

	if($error){
		header("location:password_reset.html");
		exit();
	}
		else{
			
			if(isset($_POST['registered_mobile'])){
				
				if($user_type=='Student'){
					
					$user_check_query = "SELECT * FROM student WHERE  mobile='$registered_mobile' LIMIT 1";
					$result = mysqli_query($db, $user_check_query);
					$user = mysqli_fetch_assoc($result);
				
				if ($user) { // if user exists
						
						$otp = rand(100000,999999); //generate otp
						
						$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch); 
	
						$query = "UPDATE student SET otp = '$otp' WHERE mobile = '$_POST[registered_mobile]'";//it is used to store otp in database
						mysqli_query($db,$query);
						
						$_SESSION['registered_mobile']=$_POST['registered_mobile'];
						$_SESSION['user_type'] = "Student";
						$_SESSION['otp_send_success']="OTP has been sent to mobile.";
						header("location:otp_verify.html");
						exit();
				}
						else{
								$_SESSION['mobile_not_exists_error']="Mobile number is not registered.";
								$_SESSION['registered_mobile']=$_POST['registered_mobile'];
								header("location:password_reset.html");
					
				}
					
				}
					elseif($user_type=='Faculty'){
						
							$faculty_check_query = "SELECT * FROM faculty WHERE  mobile='$registered_mobile' AND acc_type!='SCHOOL' LIMIT 1";
							$result_1 = mysqli_query($db, $faculty_check_query);
							$faculty = mysqli_fetch_assoc($result_1);
				
						if ($faculty) { // if user exists
						
						$otp = rand(100000,999999); //generate otp
						
						$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch); 
	
						$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$_POST[registered_mobile]'";//it is used to store otp in database
						mysqli_query($db,$query);
						
						$_SESSION['registered_mobile']=$_POST['registered_mobile'];
						$_SESSION['user_type'] = "Faculty";
						$_SESSION['otp_send_success']="OTP has been sent to mobile.";
						header("location:otp_verify.html");
						exit();
				}
						else{
								$_SESSION['mobile_not_exists_error']="Mobile number is not registered.";
								$_SESSION['registered_mobile']=$_POST['registered_mobile'];
								header("location:password_reset.html");
								exit();
					
				}
					}
						
					elseif($user_type=='School'){
						
							$faculty_check_query = "SELECT * FROM faculty WHERE  mobile='$registered_mobile' AND acc_type='SCHOOL' LIMIT 1";
							$result_1 = mysqli_query($db, $faculty_check_query);
							$faculty = mysqli_fetch_assoc($result_1);
				
						if ($faculty) { // if user exists
						
						$otp = rand(100000,999999); //generate otp
						
						$message = "".$otp." is your OTP to forgot password to https://mytarget.in"; 
						$message = urlencode($message); 
						$ch=curl_init(); 
						curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$registered_mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						$output =curl_exec($ch); 
						curl_close($ch); 
	
						$query = "UPDATE faculty SET otp = '$otp' WHERE mobile = '$_POST[registered_mobile]'";//it is used to store otp in database
						mysqli_query($db,$query);
						
						$_SESSION['registered_mobile']=$_POST['registered_mobile'];
						$_SESSION['user_type'] = "Faculty";
						$_SESSION['otp_send_success']="OTP has been sent to mobile.";
						header("location:otp_verify.html");
						exit();
				}
						else{
								$_SESSION['mobile_not_exists_error']="Mobile number is not registered.";
								$_SESSION['registered_mobile']=$_POST['registered_mobile'];
								header("location:password_reset.html");
								exit();
					
				}
					}
						
						
						
						
						
						
						
										else{
												header("location:password_reset.html");
												exit();
										}
				
			}
				else{
					header("location:password_reset.html");
					exit();
				}
				
					
	}
?>