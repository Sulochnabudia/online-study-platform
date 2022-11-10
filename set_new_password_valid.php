<?php 
	session_start();
	include "config.php";
	
	$new_password = $_POST['new_password'];
	$error=0;
	
	if(!isset($_SESSION['user_type'],$_SESSION['registered_mobile'])){
		header("location:password_reset.html");
	}
	
	if(isset($_POST['reset_password'])){
		
		if(empty($_POST['new_password'])){
			$_SESSION['new_password_error']="Password is not valid.";
			$error=1;
		}
			elseif(strlen($_POST['new_password'])<6){
				$_SESSION['new_password_error']="56656";
				$error=1;
			}
				else{
					$_SESSION['new_password']=$_POST['new_password'];
				}
	}
	
	if($error){
		header("location:new_password.html");
	}
		else{
			
			if(isset($_SESSION['user_type'],$_SESSION['registered_mobile'])){
				

			// if student 
			if($_SESSION['user_type']=='Student'){
				
				$user_check_query = "SELECT * FROM student WHERE  mobile='$_SESSION[registered_mobile]' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
				
				
				if ($user) { // if user exists
						
						// if old and new password same 
						if($user['password'] == md5($_POST['new_password'])){
							$_SESSION['new_password_error']="New password cannot be same as old password";
							header("location:new_password.html");
						}
							else{// if old and new password not same 
								$password = md5($_POST['new_password']);
								$query = "UPDATE student SET password = '$password' WHERE mobile = '$_SESSION[registered_mobile]'";//it is used to store new password in database
								if(!mysqli_query($db,$query)){//sql update error detection
									$_SESSION['new_password_error']="Please try again.";
									header("location:new_password.html");
									exit();
								}
								$_SESSION['pass_change_success']="Password Changed Successfully";
								header("location:login.html");
								exit();
							}
						
			}
				else{
					header("location:password_reset.html");
					exit();
				}
			}
			
				
				// if faculty
				elseif($_SESSION['user_type']=='Faculty'){
				
						$faculty_check_query = "SELECT * FROM faculty WHERE  mobile='$_SESSION[registered_mobile]' LIMIT 1";
						$result_1 = mysqli_query($db, $faculty_check_query);
						$faculty = mysqli_fetch_assoc($result_1);
				
				
				if ($faculty) { // if user exists
			
						if($faculty['password'] == md5($_POST['new_password'])){
							$_SESSION['new_password_error']="New password cannot be same as old password";
							header("location:new_password.html");
						}
							else{
								$password = md5($_POST['new_password']);
								$query = "UPDATE faculty SET password = '$password' WHERE mobile = '$_SESSION[registered_mobile]'";//it is used to store new password in database
								if(!mysqli_query($db,$query)){
									$_SESSION['new_password_error']="Please try again.";
									header("location:new_password.html");
									exit();
								}
								$_SESSION['pass_change_success']="Password Changed Successfully";
								header("location:login.html");
								exit();
							}
						
			}
				else{// faceuly not exists
					header("location:password_reset.html");
					exit();
				}
				
				}
					
					
					
					
					
				// if school
				elseif($_SESSION['user_type']=='School'){
				
						$school_check_query = "SELECT * FROM school WHERE  mobile='$_SESSION[registered_mobile]' LIMIT 1";
						$result_1 = mysqli_query($db, $school_check_query);
						$school = mysqli_fetch_assoc($result_1);
				
				
				if ($school) { // if user exists
			
						if($school['password'] == md5($_POST['new_password'])){
							$_SESSION['new_password_error']="New password cannot be same as old password";
							header("location:new_password.html");
						}
							else{
								$password = md5($_POST['new_password']);
								$query = "UPDATE school SET password = '$password' WHERE mobile = '$_SESSION[registered_mobile]'";//it is used to store new password in database
								if(!mysqli_query($db,$query)){
									$_SESSION['new_password_error']="Please try again.";
									header("location:new_password.html");
									exit();
								}
								$_SESSION['pass_change_success']="Password Changed Successfully";
								header("location:login.html");
								exit();
							}
						
			}
				else{// faceuly not exists
					header("location:password_reset.html");
					exit();
				}
				
				}
					
					
					
					
					
					
					else{  // if user not student and faculty
						header("location:password_reset.html");
						exit();
					}
  
			
			
			}
				else{// if session not set
					header("location:password_reset.html");
					exit();
				}
		}
?>