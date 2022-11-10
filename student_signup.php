<?php 
	session_start();
	error_reporting(0);
	include 'config.php';
	
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="signup_main">
		<div class="signup_logo">
			<?php include 'logo.php'; ?>
		</div>
		<div class="signup_middle">
			<form action="student_register_valid.html" method="post" enctype="multipart/form-data">
				<fieldset id="signup_fieldset">
					<legend> Personal Details: </legend>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['FULL_NAME'])){echo $_SESSION['FULL_NAME'];} ?>" placeholder="Full Name" name="FULL_NAME">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['full_name_error'])){ echo $_SESSION['full_name_error'];} ?> </p>
						</div>
					</div>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['EMAIL'])){echo $_SESSION['EMAIL'];} ?>" placeholder="Email Address" name="EMAIL">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['sign_up_email_error'])){ echo $_SESSION['sign_up_email_error'];} ?> </p>
						</div>
					</div>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['MOBILE'])){echo $_SESSION['MOBILE'];} ?>" placeholder="Mobile Number" name="MOBILE">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['sign_up_mobile_error'])){ echo $_SESSION['sign_up_mobile_error'];} ?> </p>
						</div>
					</div>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="password" id="signup_textbox" value="<?php if(isset($_SESSION['PASSWORD'])){echo $_SESSION['PASSWORD'];} ?>" placeholder="Password " name="PASSWORD">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['sign_up_password_error'])){ echo $_SESSION['sign_up_password_error'];} ?> </p>
						</div>
					</div>
	
				
					
					
					<?php 
					/*<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['REFERAL'])){ echo $_SESSION['REFERAL'];} ?>" placeholder="Referal Code (Optional)" name="REFERAL">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['referal_error'])){ echo $_SESSION['referal_error'];} ?> </p>
						</div>
					</div>
					*/?>
					
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['JOIN_CODE'])){ echo $_SESSION['JOIN_CODE'];} ?>" placeholder="Join Code (Optional)" name="JOIN_CODE">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['join_code_error'])){ echo $_SESSION['join_code_error'];} ?> </p>
						</div>
					</div>
					

					
					<div class="sign_up">
						<div class="signup_textbox">
							<select id="signup_textbox" name="QUALIFICATION">
								<?php 
									if(isset($_SESSION['QUALIFICATION'])){
										
								?>
								<option value="<?php echo $_SESSION['QUALIFICATION']; ?>"> <?php if($_SESSION['QUALIFICATION']=='6' || $_SESSION['QUALIFICATION']=='7' || $_SESSION['QUALIFICATION']=='8' || $_SESSION['QUALIFICATION']=='9' || $_SESSION['QUALIFICATION']=='10'){ echo $_SESSION['QUALIFICATION']; echo"Th";} elseif($_SESSION['QUALIFICATION']=='11_1'){echo "11 Th (Arts)";} elseif($_SESSION['QUALIFICATION']=='11_2'){echo "11 Th (Commerce)";} elseif($_SESSION['QUALIFICATION']=='11_3'){echo "11 Th (Science)";}elseif($_SESSION['QUALIFICATION']=='12_1'){echo "12 Th (Arts)";} elseif($_SESSION['QUALIFICATION']=='12_2'){echo "12 Th (Commerce)";}elseif($_SESSION['QUALIFICATION']=='12_3'){echo "12 Th (Science)";} else{echo $_SESSION['QUALIFICATION'];} ?> </option>
								<?php } else { ?>
								<option value="qualification"> Select Course </option>
								<option value="1St"> 1St </option>
								<option value="2nd"> 2nd </option>
								<option value="3rd"> 3rd </option>
								<option value="4th"> 4th </option>
								<option value="5th"> 5th </option>
								<option value="6"> 6 TH </option>
								<option value="7"> 7 TH </option>
								<option value="8"> 8 TH </option>
								<option value="9"> 9 TH </option>
								<option value="10"> 10 Th </option>
								<option value="11_1"> 11 Th (Arts) </option>
								<option value="11_2"> 11 Th (Commerce) </option>
								<option value="11_3"> 11 Th (Science) </option>
								<option value="12_1"> 12 Th (Arts) </option>
								<option value="12_2"> 12 Th (Commerce) </option>
								<option value="12_3"> 12 Th (Science) </option>
								<option value="REET">REET</option>
								<option value="Rajasthan Police">Rajasthan Police</option>
								<option value="Rajasthan Patwar">Rajasthan Patwar</option>
								<option value="RPSC">RPSC</option>
								<option value="RSMSSB">RSMSSB</option>
								<option value="PTET">PTET</option>
								<option value="BSTC">BSTC</option>
								<option value="(UPSC) CIVIL SERVICES EXAM">(UPSC) CIVIL SERVICES EXAM</option>
								<option value="(UPSC) NDA AND NA">(UPSC) NDA AND NA</option>
								<option value="SSC CGL">SSC CGL</option>
								<option value="SSC CPO">SSC CPO</option>
								<option value="SSC JE">SSC JE</option>
								<option value="SSC JHT">SSC JHT</option>
								<option value="SSC MTS">SSC MTS</option>
								<option value="SSC SCIENTIFIC ASSISTANT">SSC SCIENTIFIC ASSISTANT</option>
								<option value="SSC CHSL">SSC CHSL</option>
								<option value="SSC GD">SSC GD</option>
								<option value="SSC STENOGRAPHER">SSC STENOGRAPHER</option>
								<option value="SBI PO">SBI PO</option>
								<option value="SBI SO">SBI SO</option>
								<option value="SBI CLERK">SBI CLERK</option>
								<option value="IBPS PO">IBPS PO</option>
								<option value="IBPS SO">IBPS SO</option>
								<option value="IBPS CLERK">IBPS CLERK</option>
								<option value="IBPS (RRB)">IBPS (RRB)</option>
								<option value="(UPSC) CDS">(UPSC) CDS</option>
								<option value="RBI ASSISTANT">RBI ASSISTANT</option>
								<option value="RBI GRADE B OFFICER">RBI GRADE B OFFICER</option>
								<option value="CTET">CTET</option>
								<option value="RRB ALP">RRB ALP</option>
								<option value="RRB JE | SSC">RRB JE</option>
								<option value="RRB NTPC">RRB NTPC</option>
								<option value="RRC GROUP D">RRC GROUP D</option>
								<option value="DRDO">DRDO</option>
								<option value="ISRO">ISRO</option>
								<option value="ESIC">ESIC</option>
								<option value="FCI">FCI</option>
								<option value="LIC AAO">LIC AAO</option>
								<option value="Other"> Other </option>
								<?php } ?>
							</select>
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['qualification_error'])){ echo $_SESSION['qualification_error'];} ?> </p>
						</div>
					</div>
					
					
				
					
				</fieldset>
				
				
				<fieldset id="signup_fieldset">
					<legend> Photograph: </legend>
					<div class="photograph">
						<div class="photograph_left">
							<input id="fileupload" type="file" name="USER_PROFILE">
						</div>
						<div class="photograph_right">
							<div id="dvPreview">
							</div>
						</div>
					</div>
				</fieldset>
				<div class="terms_and_conditon">
				<input type="checkbox" value="terms_and_conditon" name="CHECKBOX"><label> I accept <a href="Terms And Condition.txt">Terms and condition.</a> </label>
				</div>
				<input type="reset" id="sign_up_reset" value="Reset">
				<input type="submit" id="sign_up_button" value="Submit" name="sign_up_submit">
				<?php if(isset($_SESSION['checbox_error'])){ ?>
				<p id="profile_error"> <?php echo $_SESSION['checbox_error']; ?></p>
				<?php } ?>
				<?php if(isset($_SESSION['profile_error'])){ ?>
				<p id="profile_error"> <?php echo $_SESSION['profile_error']; ?></p>
				<?php } ?>
				<?php if(isset($_SESSION['technical_error'])){ ?>
				<p id="profile_error"> <?php echo $_SESSION['technical_error']; ?></p>
				<?php } ?>
				
			</form>
		</div>
	</div>
	
</body>
</html>
<?php
	session_destroy();
?>