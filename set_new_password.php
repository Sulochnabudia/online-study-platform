<?php 
	session_start();
	error_reporting(0);
		
		if(!isset($_SESSION['user_type'],$_SESSION['registered_mobile'])){
		header("location:password_reset.html");
	}
	
	?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="set_new_password_main">
		<div class="set_new_password_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="set_new_password_middle">
			<form action="new_password_valid.html" autocomplete="off" method="post">
				<fieldset id="set_new_password_fieldset">
					<legend> New Password: </legend>
					<input type="password" id="set_new_password_textbox" value="<?php echo $_SESSION['new_password']; ?>" placeholder="Enter Password" maxlength="32" name="new_password">
					<input id="set_new_password_button" type="submit" value="Reset Password" name="reset_password">
				</fieldset>
			</form>
			<p id="set_new_password_error">
				<?php 
						echo $_SESSION['new_password_error'];
				?>
			</p>
		</div>
	</div>
	
</body>
</html>