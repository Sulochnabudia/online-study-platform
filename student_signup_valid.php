<?php
session_start();
include 'config.php';
$error=0;
if($_POST['JOIN_CODE']==''){
	$id =0;
}
	else{
		$id = $_POST['JOIN_CODE'];
	}
	
	
	
	if(isset($_POST['sign_up_submit'])){
				
			
			if($_FILES['USER_PROFILE']["name"] == ''){
			$_SESSION['profile_error']="Select Profile Image";
			$error=1;
		}
			
			
				else{
						if($_FILES['USER_PROFILE']["name"] != ''){

						// image validation 
						$temp = rand(1004544545,1000545454545);
						$target_file = $temp.basename($_FILES["USER_PROFILE"]["name"]);
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						$user_profile = $temp.".".$imageFileType;
				
				
				
						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						$_SESSION['profile_error']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$error = 1;
						}
					}
				}
				
				
		//full name name validation
		if(empty($_POST["FULL_NAME"])){
			$_SESSION["full_name_error"]="Fullname is not vlaid.";
			$error=1;
		}
		
			elseif(!preg_match("/^([a-zA-Z' ]+)$/",$_POST['FULL_NAME'])) {
					$_SESSION['FULL_NAME']=$_POST['FULL_NAME'];
					$_SESSION["full_name_error"] = "Fullname is not valid.";
					$error=1;
			}
				else{
					$_SESSION['FULL_NAME']=$_POST['FULL_NAME'];
				}
		
		// email validation 
		if(empty($_POST["EMAIL"])){
			$_SESSION["sign_up_email_error"]="Email address in not valid.";
			$error=1;
		}
			elseif(!filter_var($_POST["EMAIL"], FILTER_VALIDATE_EMAIL)){
				$_SESSION['EMAIL']=$_POST['EMAIL'];
				$_SESSION["sign_up_email_error"]="Email address is not valid.";
				$error=1;
			}
				else{
					$_SESSION['EMAIL']=$_POST['EMAIL'];
				}
				
		// mobile number validation
		if(empty($_POST["MOBILE"])){
			$_SESSION["sign_up_mobile_error"]="Mobile number is not valid.";
			$error=1;
		}
			elseif(strlen($_POST["MOBILE"])!=10){
					$_SESSION['MOBILE']=$_POST['MOBILE'];
					$_SESSION["sign_up_mobile_error"]="Mobile number is not valid.";
					$error=1;
			}
				elseif(!preg_match("/^[0-9]*$/",$_POST['MOBILE'])){
					$_SESSION['MOBILE']=$_POST['MOBILE'];
					$_SESSION["sign_up_mobile_error"] = "Mobile number is not valid.";
					$error=1;
				}
					else{
						$_SESSION['MOBILE']=$_POST['MOBILE'];
					}
				
		
		// Password validation cheking
		if(empty($_POST["PASSWORD"]) ){
			$_SESSION["sign_up_password_error"]="Password is not valid.";
			$error=1;
		}
				elseif(strlen($_POST["PASSWORD"])<6){
					$_SESSION['PASSWORD']=$_POST['PASSWORD'];
					$_SESSION["sign_up_password_error"]="Password is not valid.";
					$error=1;
				}
						else{
							$_SESSION['PASSWORD']=$_POST['PASSWORD'];
						}
		
		

			
		


		
		
		// qualification validation 
		if($_POST['QUALIFICATION']=='qualification'){
			$_SESSION["qualification_error"]="Qualification is not valid.";
			$error=1;
		}
			else{
				$_SESSION['QUALIFICATION']=$_POST['QUALIFICATION'];
			}

		

			

		// terms and condition 
		if($_POST['CHECKBOX']==''){
			$_SESSION['checbox_error']="Please accept terms and condition.";
			$error=1;
		}
		
		
		// join code validation
		if(empty($_POST['JOIN_CODE'])){
			$type="Other";
			$join_id=0;
		}
			else{
				$faculty = "SELECT * FROM faculty WHERE promo_code='$_POST[JOIN_CODE]'";
				$result = mysqli_query($db,$faculty);
				$row = mysqli_fetch_array($result);
				
				$school = "SELECT * FROM faculty WHERE school_id='$_POST[JOIN_CODE]'";
				$school_result = mysqli_query($db,$school);
				$school_row = mysqli_fetch_array($school_result);
				
				if($row){
					$type = "Faculty";
					$join_id = $row['id'];
				}
					elseif($school_row){
							$type = "School";
							$join_id = $school_row['id'];
					}
						else{
							$_SESSION['join_code_error']="Join code is not valid.";
							$error=1;
						}
				
				$_SESSION['JOIN_CODE']=$_POST['JOIN_CODE'];
			}
		
		
	}
		else{
			header("location:student_register.html?id=$id&type=$type");
			exit();
		}
		
	if($error){
		header("location:student_register.html?id=$id&type=$type");
		exit();
	}
		else{
			
				
					
				
				// generate promocode 
				$promo_code = substr($_POST['FULL_NAME'],0,2);
				$promo_code = strtoupper($promo_code);
				$rand = rand(100000,999999);
				$promo_result = $promo_code.$rand;
				
				$user_check_query = "SELECT * FROM student WHERE  mobile='$_POST[MOBILE]' OR email='$_POST[EMAIL]' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
				
				if ($user) { // if user exists
						if ($user['mobile'] == $_POST['MOBILE']) {
							$_SESSION['sign_up_mobile_error']="Mobile number already exists";
							header("location:student_register.html?id=$id&type=$type");
							exit();
						}

							if ($user['email'] == $_POST['EMAIL']) {
								$_SESSION['sign_up_email_error']="Email already exists.";
								header("location:student_register.html?id=$id&type=$type");
								exit();
							}
				}
					else{
							
							if($type=='School'){
								$status=0;
							}
								else{
									$status=1;
								}
						
							$password = md5($_POST["PASSWORD"]);
							$otp = rand(100000,999999); //generate otp
							$query = "INSERT INTO student(full_name,email,mobile,password,course,profile_img,promo_code,otp,current_status,account_status,verify,type,join_id) VALUES('$_POST[FULL_NAME]','$_POST[EMAIL]','$_POST[MOBILE]','$password','$_POST[QUALIFICATION]','$user_profile','$promo_result','$otp','1','$status','0','$type','$join_id')";
							if(!mysqli_query($db,$query)){
								$_SESSION['technical_error']="Technical issue. Please try again.";
								header("location:student_register.html?id=$id&type=$type");
								exit();
							}
							
							else{
									move_uploaded_file($_FILES["USER_PROFILE"]["tmp_name"], "user/img/user/".$temp.".".$imageFileType);
									
									$mobile = $_POST['MOBILE'];
									
									$message = "".$otp." OTP for Mobile Verification. https://mytarget.in"; 
									$message = urlencode($message); 
									$ch=curl_init(); 
									curl_setopt($ch,CURLOPT_URL,"https://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hncfgYcutgM&MobileNo=".$mobile."&SenderID=MYTARG&Message=".$message."&ServiceName=TEMPLATE_BASED"); 
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
									$output =curl_exec($ch); 
									curl_close($ch);
									
									$_SESSION['SEND_NAME']=$_POST['FULL_NAME'];
									$_SESSION['SEND_PASS']=$_POST['PASSWORD'];
									$_SESSION['ACCOUNT_TYPE']='STUDENT';
									$_SESSION['student_mobile']=$_POST['MOBILE'];
									header("location:verify.html");
									exit();
								
							}
							
					}
				
			}
		
?>