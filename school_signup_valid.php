<?php
session_start();
include 'config.php';
$error=0;

$mobile = $_POST['MOBILE'];
	
	
	if(isset($_POST['sign_up_submit'])){
		
		
		//full name name validation
		if(empty($_POST["SCHOOL_NAME"])){
			$_SESSION["school_name_error"]="Institute Name is not valid.";
			$error=1;
		}
		
			elseif(!preg_match("/^([a-zA-Z' ]+)$/",$_POST['SCHOOL_NAME'])) {
					$_SESSION['SCHOOL_NAME']=$_POST['SCHOOL_NAME'];
					$_SESSION["school_name_error"] = "Institute Name is not valid.";
					$error=1;
			}
				else{
					$_SESSION['SCHOOL_NAME']=$_POST['SCHOOL_NAME'];
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
				
		
		
		// Board validation 
		if($_POST['BOARD']=='board'){
			$_SESSION["board_error"]="Board is not valid.";
			$error=1;
		}
			else{
				$_SESSION['BOARD']=$_POST['BOARD'];
			}
		
		// medim validation 
		if($_POST['MEDIUM']=='medium'){
			$_SESSION["medium_error"]="Medium is not valid.";
			$error=1;
		}
			else{
				$_SESSION['MEDIUM']=$_POST['MEDIUM'];
			}
		
		
		// school type validation 
		if($_POST['SCHOOL_TYPE']=='school_type'){
			$_SESSION["school_type_error"]="Institute type is not valid.";
			$error=1;
		}
			else{
				$_SESSION['SCHOOL_TYPE']=$_POST['SCHOOL_TYPE'];
			}
		
		
		
		// terms and condition 
		if($_POST['CHECKBOX']==''){
			$_SESSION['checbox_error']="Please accept terms and condition.";
			$error=1;
		}
		
	if($error){
		header("location:school_register.html");
		exit();
	}
		else{

				$user_check_query = "SELECT * FROM faculty WHERE  mobile='$_POST[MOBILE]' OR email='$_POST[EMAIL]' LIMIT 1";
				$result = mysqli_query($db, $user_check_query);
				$user = mysqli_fetch_assoc($result);
				
				if ($user) { // if user exists
						if ($user['mobile'] == $_POST['MOBILE']) {
							$_SESSION['sign_up_mobile_error']="Mobile number already exists";
							header("location:school_register.html");
							exit();
						}

							if ($user['email'] == $_POST['EMAIL']) {
								$_SESSION['sign_up_email_error']="Email already exists.";
								header("location:school_register.html");
								exit();
							}
				}
					else{
							$otp = rand(100000,999999); //generate otp
							$school_id = "SCHO".rand(10000000,99999999);
							$password = md5($_POST["PASSWORD"]);
							$query = "INSERT INTO faculty(school_id,name,email,mobile,password,address,state,city,pincode,board,medium,otp,status,verify,type,acc_type)VALUES('$school_id','$_POST[SCHOOL_NAME]','$_POST[EMAIL]','$_POST[MOBILE]','$password','$_POST[ADDRESS]','$_POST[STATE]','$_POST[CITY]','$_POST[PINCODE]','$_POST[BOARD]','$_POST[MEDIUM]','$otp','0','0','$_POST[SCHOOL_TYPE]','SCHOOL')";
							if(!mysqli_query($db,$query)){
								$_SESSION['technical_error']="Technical issue. Please try again.";
								header("location:school_register.html");
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
									
									$_SESSION['SEND_NAME']=$_POST['SCHOOL_NAME'];
									$_SESSION['SEND_PASS']=$_POST['PASSWORD'];
									$_SESSION['ACCOUNT_TYPE']='SCHOOL';
									$_SESSION['school_mobile']=$_POST['MOBILE'];
									header("location:verify.html");
									exit();
								
							}
							
					}
				
			}
	}
		else{
			header("location:school_register.html");
			exit();
		}
?>