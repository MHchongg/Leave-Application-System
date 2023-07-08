<?php

	include'db_conn.php'; 
	if (isset($_POST['editLeave'])){
        $edldate = $_POST['leaveDate'];
        $edltype = $_POST['leaveType'];
		$edlid = $_GET['editLeaveID'];
		$sql = "UPDATE leaves SET leavedate = '$edldate', leavetype = '$edltype', status = 'Pending' WHERE id = '$edlid'";
		$run = mysqli_query($conn,$sql);
		if($run == true){

			header("Location:home.php?successful");
			
		}else{

			header("Location:home.php?failure");
			
		}
	}
	else {
        header("Location:index.php");
    }
	
?>