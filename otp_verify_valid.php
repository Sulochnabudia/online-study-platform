<?php 
	session_start();
	include "config.php";
	$registered_mobile = $_SESSION['registered_mobile'];
	$error=0;
	
	if(!isset($_SESSION['user_type'],$_SESSION['registered_mobile'])){
		header("location:password_reset.html");
	}
	
	if(isset($_POST['otp_verify'])){
		
		if(empty($_POST['otp'])){
			$_SESSION['otp_error']="Invalid Otp.";
			$error=1;
		}
		
	}
	if($error){
		header("location:otp_verify.html");
	}
		else{
			
			if(isset($_POST['otp_verify'],$_SESSION['user_type'],$_SESSION['registered_mobile'])){
			
			if($_SESSION['user_type']=='Student'){
				
				$user_check_query = "SELECT otp FROM student WHERE  mobile='$registered_mobile' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
  
			if ($user) { // if user exists
					
					if($user['otp'] == $_POST['otp']){
						header("location:new_password.html");
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:otp_verify.html");
					
					}
					
				}
				
			}
				elseif($_SESSION['user_type']=='Faculty'){
					
					$faculty_check_query = "SELECT otp FROM faculty WHERE  mobile='$registered_mobile' LIMIT 1";
					$result_1 = mysqli_query($db, $faculty_check_query);
					$faculty = mysqli_fetch_assoc($result_1);
  
					if ($faculty) { // if user exists
					
					if($faculty['otp'] == $_POST['otp']){
						header("location:new_password.html");
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:otp_verify.html");
					
					}
					
				}
				
				}
					
				


				
				elseif($_SESSION['user_type']=='School'){
					
					$faculty_check_query = "SELECT otp FROM faculty WHERE  mobile='$registered_mobile' LIMIT 1";
					$result_1 = mysqli_query($db, $faculty_check_query);
					$faculty = mysqli_fetch_assoc($result_1);
  
					if ($faculty) { // if user exists
					
					if($faculty['otp'] == $_POST['otp']){
						header("location:new_password.html");
					}
						else{
								$_SESSION['otp_error']="Incorrect OTP,please try again";
								$_SESSION['otp']=$_POST['otp'];
								header("location:otp_verify.html");
					
					}
					
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