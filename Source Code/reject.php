<?php

	include'db_conn.php'; 
	if (isset($_POST['reject'])){
        $rejectID = $_GET['id'];
		$sql = "UPDATE leaves SET status = 'Rejected' WHERE id = '$rejectID'";
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