<?php

	include'db_conn.php'; 
	if (isset($_POST['approve'])){
        $approveID = $_GET['id'];
		$sql = "UPDATE leaves SET status = 'Approved' WHERE id = '$approveID'";
		$run = mysqli_query($conn,$sql);
		if($run == true){

			header("Location:manager.php?successful");
			
		}else{

			header("Location:manager.php?failure");
			
		}
	}
	else {
        header("Location:index.php");
    }
	
?>