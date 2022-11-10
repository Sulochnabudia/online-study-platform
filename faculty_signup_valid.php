<?php
session_start();
include 'config.php';
$error=0;
	
	
	
	if(isset($_POST['sign_up_submit'])){
		
	if($_FILES['USER_PROFILE']["name"] == ''){
		$_SESSION['profile_error']="Select Profile Image";
		$error=1;
	}
		else{
			// image validation 
				$temp = rand(1004544545,1000545454545);
				$target_file = $temp.basename($_FILES["USER_PROFILE"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$user_profile = $temp.".".$imageFileType;
				
				// Check file size
				if ($_FILES["USER_PROFILE"]["size"] > 500000) {
					$_SESSION['profile_error']="Your file is too large.";
					$error = 1;
					}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$_SESSION['profile_error']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$error = 1;
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
		
		
		// address validation 
		if(empty($_POST['ADDRESS'])){
			$_SESSION["sign_up_address_error"]="Address is not valid.";
			$error=1;
		}
			else{
				$_SESSION['ADDRESS']=$_POST['ADDRESS'];
			}
		
		// state validation 
		if($_POST['STATE']=='select_state'){
			$_SESSION["sign_up_state_error"]="State is not valid.";
			$error=1;
		}
			else{
				$_SESSION['STATE']=$_POST['STATE'];
			}
			
		

		//city validation
		if(empty($_POST["CITY"])){
			$_SESSION["city_error"]="City is not vlaid.";
			$error=1;
		}
		
			elseif(!preg_match("/^([a-zA-Z' ]+)$/",$_POST['CITY'])) {
					$_SESSION['CITY']=$_POST['CITY'];
					$_SESSION["city_error"] = "City is not valid.";
					$error=1;
			}
				else{
					$_SESSION['CITY']=$_POST['CITY'];
				}
		
		//pincode validation
		if(empty($_POST["PINCODE"])){
			$_SESSION["pincode_error"]="Pincode is not valid.";
			$error=1;
		}
		
			elseif(!preg_match("/^[0-9]*$/",$_POST['PINCODE'])) {
					$_SESSION['PINCODE']=$_POST['PINCODE'];
					$_SESSION["pincode_error"] = "Pincode is not valid 55.";
					$error=1;
			}
				elseif(strlen($_POST['PINCODE'])!=6){
					$_SESSION['PINCODE']=$_POST['PINCODE'];
					$_SESSION["pincode_error"] = "Pincode is not valid200.";
					$error=1;
				}
				else{
					$_SESSION['PINCODE']=$_POST['PINCODE'];
				}
				
		// referal code validation
		if(empty($_POST['REFERAL_CODE'])){
			$join_id=0;
		}
			else{
				$faculty = "SELECT * FROM faculty WHERE promo_code='$_POST[REFERAL_CODE]' AND super_acc='1'";
				$faculty_result = mysqli_query($db,$faculty);
				$faculty_row = mysqli_fetch_array($faculty_result);
				if(!$faculty_row){
					$_SESSION['referal_code_error']="Referal Code is not valid.";
					$error=1;
				}
					else{
						$join_id = $faculty_row['id'];
					}
				$_SESSION['REFERAL_CODE'] = $_POST['REFERAL_CODE'];
			}
		
		// qualification validation 
		if($_POST['QUALIFICATION']=='qualification'){
			$_SESSION["qualification_error"]="Qualification is not valid.";
			$error=1;
		}
			else{
				$_SESSION['QUALIFICATION']=$_POST['QUALIFICATION'];
			}
		
		
		// join faculty validation 
		if($_POST['MEDIUM']=='medium'){
			$_SESSION["medium_error"]="Medium is not valid.";
			$error=1;
		}
			else{
				$_SESSION['MEDIUM']=$_POST['MEDIUM'];
			}	
			
		// exprience valiation
		if($_POST['EXPRIENCE']=='Exprience'){
			$_SESSION['exp_error']="Exprience is not valid.";
			$error=1;
		}
			else{
				$_SESSION['EXPRIENCE']=$_POST['EXPRIENCE'];
			}
		
		
		
		// terms and condition 
		if($_POST['CHECKBOX']==''){
			$_SESSION['checbox_error']="Please accept terms and condition.";
			$error=1;
		}
		
	if($error){
		header("location:faculty_register.html");
		exit();
	}
		else{

				$user_check_query = "SELECT * FROM faculty WHERE  mobile='$_POST[MOBILE]' OR email='$_POST[EMAIL]' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
				
				if ($user) { // if user exists
						if ($user['mobile'] == $_POST['MOBILE']) {
							$_SESSION['sign_up_mobile_error']="Mobile number already exists";
							header("location:faculty_register.html");
							exit();
						}

							if ($user['email'] == $_POST['EMAIL']) {
								$_SESSION['sign_up_email_error']="Email already exists.";
								header("location:faculty_register.html");
								exit();
							}
				}
					else{
							$promo_code = "INST".rand(1000000000,9999999999);
							$otp = rand(100000,999999); //generate otp
							$password = md5($_POST["PASSWORD"]);
							$query = "INSERT INTO faculty(name,email,mobile,password,exprience,image,qualification,address,otp,state,city,pincode,status,verify,medium,acc_type,join_id,super_acc,promo_code)VALUES('$_POST[FULL_NAME]','$_POST[EMAIL]','$_POST[MOBILE]','$password','$_POST[EXPRIENCE]','$user_profile','$_POST[QUALIFICATION]','$_POST[ADDRESS]','$otp','$_POST[STATE]','$_POST[CITY]','$_POST[PINCODE]','1','0','$_POST[MEDIUM]','FACULTY','$join_id','0','$promo_code')";
							if(!mysqli_query($db,$query)){
								$_SESSION['technical_error']="Technical issue. Please try again.";
								header("location:faculty_register.html");
								exit();
							}
							
							else{
									move_uploaded_file($_FILES["USER_PROFILE"]["tmp_name"], "faculty/img/faculty/".$temp.".".$imageFileType);
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
									$_SESSION['ACCOUNT_TYPE']='FACULTY';
									$_SESSION['faculty_mobile']=$_POST['MOBILE'];
									header("location:verify.html");
									exit();
								
							}
							
					}
				
			}
	}
		else{
			header("location:faculty_register.html");
			exit();
		}
?>