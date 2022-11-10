<?php 
	session_start();
	error_reporting(0);
?>
<html>
<?php include'head.php'; ?>
<body> 

	<div class="login_main">
		<div class="login_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="login_middle">
			<form action="login1.html" autocomplete="off" method="post">
				<fieldset id="fieldset">
					<legend> Login: </legend>
					<select id="login_select" name="select_user">
						<option value="Student"> Student </option>
						<option value="Faculty"> Faculty </option>
						<option value="School"> Institute </option>
					</select>
					<input type="text" id="login_textbox" placeholder="Mobile Number" value="<?php echo $_SESSION['mobile_number']; ?>" maxlength="10" name="mobile_number">
					<input type="password" id="login_textbox" placeholder="Password" value="<?php echo $_SESSION['password']; ?>" maxlength="32" name="password">
					<p id="login_forgot_pass"><a href="password_reset.html"> Forgot Password </a> </p>
					<input id="login_button" type="submit" value="Login" name="login">
					<p style="text-align:center;margin:0px;"> <a href="register.html"> Register </a> </p>
				</fieldset>
			</form>
			<?php 
				if(isset($_SESSION['login_mobile_error']) || isset($_SESSION['login_password_error']) || isset($_SESSION['login_error'])){
			?>
			<p id="login_error">
				 <?php 
						echo $_SESSION['login_mobile_error'];
						?>
						<br>
						<?php 
						echo $_SESSION['login_password_error'];
						echo $_SESSION['login_error'];
						?>
			</p>
				<?php } ?>
			<p id="login_success">
				<?php 
						echo $_SESSION['pass_change_success'];
						echo $_SESSION['sign_up_success'];
				?>
			</p>
		</div>
	</div>
	
</body>
</html>
<?php 
session_destroy();
?>