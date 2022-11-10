<?php 
session_start();
include 'config.php';
	
	if(isset($_POST['NEXT'])){
		
		if($_POST['select_user']=='Student'){
			header("location:student_register.html");// join.php -> register_step1.html
			exit();
		}
			elseif($_POST['select_user']=='Faculty'){
				header("location:faculty_register.html"); //faculty_signup.php -> faculty_register.html
				exit();
			}
				elseif($_POST['select_user']=='School'){
					header("location:school_register.html"); // school_signup.php -> school_register.html
					exit();
				}
					else{
						header("location:register.html");
						exit();
					}
	}
	
	
		else{
			header("location:register.html");
			exit();
		}
	
?>