<?php 
	session_start();
	error_reporting(0);
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="signup_main">
		<div class="signup_logo">
			<?php include 'logo.php'; ?>
		</div>
		<div class="signup_middle">
			<form action="school_register_valid.html" method="post" enctype="multipart/form-data">
				<fieldset id="signup_fieldset">
					<legend> School Details: </legend>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['SCHOOL_NAME'])){echo $_SESSION['SCHOOL_NAME'];} ?>" placeholder="Institute Name" name="SCHOOL_NAME">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['school_name_error'])){ echo $_SESSION['school_name_error'];} ?> </p>
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
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['ADDRESS'])){echo $_SESSION['ADDRESS'];} ?>" placeholder="Address" name="ADDRESS">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['sign_up_address_error'])){ echo $_SESSION['sign_up_address_error'];} ?> </p>
						</div>
					</div>
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<select id="signup_textbox" name="STATE">
								<?php 
									if(isset($_SESSION['STATE'])){
								?>
								<option value="<?php echo $_SESSION['STATE']; ?>"> <?php echo $_SESSION['STATE']; ?> </option>
								<?php } else {?>
								<option value="select_state"> Select State </option>
								<option value="Andhra Pradesh">Andhra Pradesh</option>
								<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
								<option value="Arunachal Pradesh">Arunachal Pradesh</option>
								<option value="Assam">Assam</option>
								<option value="Bihar">Bihar</option>
								<option value="Chandigarh">Chandigarh</option>
								<option value="Chhattisgarh">Chhattisgarh</option>
								<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
								<option value="Daman and Diu">Daman and Diu</option>
								<option value="Delhi">Delhi</option>
								<option value="Lakshadweep">Lakshadweep</option>
								<option value="Puducherry">Puducherry</option>
								<option value="Goa">Goa</option>
								<option value="Gujarat">Gujarat</option>
								<option value="Haryana">Haryana</option>
								<option value="Himachal Pradesh">Himachal Pradesh</option>
								<option value="Jammu and Kashmir">Jammu and Kashmir</option>
								<option value="Jharkhand">Jharkhand</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Kerala">Kerala</option>
								<option value="Madhya Pradesh">Madhya Pradesh</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Manipur">Manipur</option>
								<option value="Meghalaya">Meghalaya</option>
								<option value="Mizoram">Mizoram</option>
								<option value="Nagaland">Nagaland</option>
								<option value="Odisha">Odisha</option>
								<option value="Punjab">Punjab</option>
								<option value="Rajasthan">Rajasthan</option>
								<option value="Sikkim">Sikkim</option>
								<option value="Tamil Nadu">Tamil Nadu</option>
								<option value="Telangana">Telangana</option>
								<option value="Tripura">Tripura</option>
								<option value="Uttar Pradesh">Uttar Pradesh</option>
								<option value="Uttarakhand">Uttarakhand</option>
								<option value="West Bengal">West Bengal</option>
								<?php } ?>
							</select>
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['sign_up_state_error'])){ echo $_SESSION['sign_up_state_error'];} ?> </p>
						</div>
					</div>
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_SESSION['CITY'])){ echo $_SESSION['CITY'];} ?>" placeholder="City" name="CITY">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['city_error'])){ echo $_SESSION['city_error'];} ?> </p>
						</div>
					</div>
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<input type="text" id="signup_textbox" value="<?php if(isset($_POST['PINCODE'])){ echo $_SESSION['PINCODE'];} ?>" placeholder="Pin Code" name="PINCODE">
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['pincode_error'])){ echo $_SESSION['pincode_error'];} ?> </p>
						</div>
					</div>
					

				</fieldset>
				
				<fieldset id="signup_fieldset">
					<legend> Other Details: </legend>
					
					<div class="sign_up">
						<div class="signup_textbox">
							<select id="signup_textbox" name="BOARD">
								<?php 
									if(isset($_SESSION['BOARD'])){
										
								?>
								<option value="<?php echo $_SESSION['BOARD']; ?>"> <?php echo $_SESSION['BOARD']; ?> </option>
								<?php } else { ?>
								<option value="board"> Select Board </option>
								<option value="CBSC"> CBSC </option>
								<option value="RBSC"> RBSC </option>
								<option value="Other">Other</option>
								<?php } ?>
							</select>
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['board_error'])){ echo $_SESSION['board_error'];} ?> </p>
						</div>
					</div>
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<select id="signup_textbox" name="MEDIUM">
								<?php 
									if(isset($_SESSION['MEDIUM'])){
										
								?>
								<option value="<?php echo $_SESSION['MEDIUM']; ?>"> <?php echo $_SESSION['MEDIUM']; ?> </option>
								<?php } else { ?>
								<option value="medium"> Select Medium </option>
								<option value="English"> English </option>
								<option value="Hindi"> Hindi </option>
								<option value="Both(Hindi And English)"> Both Hindi and English </option>
								<?php } ?>
							</select>
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['medium_error'])){ echo $_SESSION['medium_error'];} ?> </p>
						</div>
					</div>
					
					
					
					<div class="sign_up">
						<div class="signup_textbox">
							<select id="signup_textbox" name="SCHOOL_TYPE">
								<?php 
									if(isset($_SESSION['SCHOOL_TYPE'])){
										
								?>
								<option value="<?php echo $_SESSION['SCHOOL_TYPE']; ?>"> <?php echo $_SESSION['SCHOOL_TYPE']; ?> </option>
								<?php } else { ?>
								<option value="school_type"> Select Institute Type </option>
								<option value="Goverment"> Goverment </option>
								<option value="Private"> Private </option>
								<?php } ?>
							</select>
						</div>
						<div class="signup_error">
							<p> <?php if(isset($_SESSION['school_type_error'])){ echo $_SESSION['school_type_error'];} ?> </p>
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