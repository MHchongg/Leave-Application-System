<?php

	include'db_conn.php'; 
	if (isset($_POST['deleteEmp'])){
		$empID = $_GET['id'];
		$empEmail = $_GET['email'];
		$sql = "DELETE FROM employee WHERE id = '$empID'";
		$sql2 = "DELETE FROM leaves WHERE email = '$empEmail'";
		$run = mysqli_query($conn,$sql);
		$run2 = mysqli_query($conn,$sql2);
		if($run == true && $run2 == true){

			header("Location:manager.php?successful");
			
		}else{

			header("Location:manager.php?failure");
			
		}
	}
	else {
        header("Location:index.php");
    }
	
?>