<?php 
	session_start();
	error_reporting(0);
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="login_main">
		<div class="login_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="login_middle">
			<form action="register_valid.html" autocomplete="off" method="post">
				<fieldset id="fieldset">
					<legend> Register: </legend>
					<select id="login_select" name="select_user">
						<option value="Student"> Student </option>
						<option value="Faculty"> Faculty </option>
						<option value="School"> Institute </option>
					</select>
					<input id="login_button" type="submit" value="NEXT" name="NEXT">
				</fieldset>
			</form>
		</div>
	</div>
	
</body>
</html>
<?php 
session_destroy();
?>