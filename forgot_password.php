<?php 
	session_start();
	error_reporting(0);
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="forgot_main">
		<div class="forgot_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="forgot_middle">
			<form action="password_reset_valid.html" autocomplete="off" method="post">
				<fieldset id="forgot_fieldset">
					<legend> Forgot Password: </legend>
					<select id="forgot_select" name="select_user">
						<option value="Student"> Student </option>
						<option value="Faculty"> Faculty </option>
						<option value="School"> Institute </option>
					</select>
					<input type="text" id="forgot_textbox" placeholder="Registered Mobile Number" value="<?php echo $_SESSION['registered_mobile']; ?>" maxlength="10" name="registered_mobile">
					<input id="forgot_button" type="submit" value="Send OTP" name="send_otp">
				</fieldset>
			</form>
			<p id="forgot_password_error">
				<?php 
						echo $_SESSION['registered_mobile_error'];
						echo $_SESSION['mobile_not_exists_error'];
				?>
			</p>
		</div>
	</div>
	
</body>
</html>
<?php 
session_destroy();
?>