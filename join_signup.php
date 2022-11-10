<?php 
	session_start();
	error_reporting(0);
	include 'config.php';
	
	
	if(!isset($_SESSION['JOIN'])){
		header("location:register.html"); //sign_up.php ->  register.html
		exit();
	}
	
	if(isset($_POST['NEXT2'])){
		
		if($_POST['ID']=='Select_faculty' || $_POST['ID']=='Select_school'){
	
		}
		else{
		$id = $_POST['ID'];
		$type = $_POST['TYPE'];
		header("location:student_register.html?id=$id&type=$type"); // student_signup.php -> student_register.html
		exit();
		}
	}
	
	
?>
<html>
<?php include "head.php"; ?>
<body> 

	<div class="login_main">
		<div class="login_logo">
			<?php include "logo.php"; ?>
		</div>
		
		<div class="login_middle">
			<form action="" autocomplete="off" method="post">
				<fieldset id="fieldset">
					<legend> Register: </legend>
					
					<select id="login_select" name="select_user">
						<option value="Student"> Student </option>
					</select>
					
					<?php if($_SESSION['JOIN']=='School'){ ?>
					
					<select id="login_select" name="TYPE">
						<option value="School"> Institute </option>
					</select>
					
					
					<select id="login_select" name="ID">
					<option value="Select_school"> Select Institute </option>
						<?php 
							$school = "SELECT * FROM faculty WHERE status='1' AND acc_type='SCHOOL'";
							$result = mysqli_query($db,$school);
							while($row = mysqli_fetch_array($result)){
						?>
						<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> (<?php echo $row['school_id']; ?>) </option>
							<?php } ?>
					</select>
					
					<?php } if($_SESSION['JOIN']=='Faculty'){ ?>
					
					<select id="login_select" name="TYPE">
						<option value="Faculty"> Faculty </option>
					</select>
					
					<select id="login_select" name="ID">
						<option value="Select_faculty"> Select Faculty </option>
						<?php 
							$school = "SELECT * FROM faculty WHERE status='1' AND acc_type='FACULTY'";
							$result = mysqli_query($db,$school);
							while($row = mysqli_fetch_array($result)){
						?>
						<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?>(<?php echo $row['id']; ?>) </option>
							<?php } ?>
					</select>
					
					<?php } ?>

					<input id="login_button" type="submit" value="NEXT" name="NEXT2">
				</fieldset>
			</form>
		</div>
	</div>
	
</body>
</html>