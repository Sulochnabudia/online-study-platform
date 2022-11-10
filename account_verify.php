<?php 
	session_start();
	error_reporting(0);
	include 'config.php';
	
	if(!isset($_SESSION['ACCOUNT_TYPE'])){
		header("location:login.html");
	}
	
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="otp_verify_main">
		<div class="otp_verify_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="otp_verify_middle">
			<form action="verify_valid.html" autocomplete="off" method="post">
				<fieldset id="otp_verify_fieldset">
					<legend> OTP Verify: </legend>
					<input type="password" id="otp_verify_textbox" value="<?php echo $_SESSION['otp']; ?>" placeholder="Enter OTP" maxlength="6" name="otp">
					<p id="otp_verify_otpresend"> <a href="verify_resend.html"> Resend OTP </a> </p>
					<input id="otp_verify_button" type="submit" value="Verify" name="otp_verify">
				</fieldset>
			</form>
			<p id="otp_verify_error">
				<?php 
						echo $_SESSION['otp_error'];
				?>
			</p>
		</div>
	</div>
	
</body>
</html>
