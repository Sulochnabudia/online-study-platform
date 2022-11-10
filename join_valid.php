<?php 
session_start();
include 'config.php';
	
	if(isset($_POST['NEXT1'])){
		
		$_SESSION['JOIN']=$_POST['JOIN'];
		if($_SESSION['JOIN']=='Other'){
			$type = $_POST['JOIN'];
			header("location:student_register.html?id=0&type=$type"); // student_signup.php -> student_register.html
			exit();
		}
		
		elseif($_POST['JOIN']=='Faculty' || $_POST['JOIN']=='School'){
		header("location:register_step2.html"); // join_signup.php -> register_step2.html
		exit();
		}
			else{
				header("location:register_step1.html");
				exit();
			}
	}
	
	
		else{
			header("location:register_step1.html"); // join.php -> register_step1.html
			exit();
		}
	
?>