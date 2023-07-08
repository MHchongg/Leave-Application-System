<?php

	include'db_conn.php'; 
	if (isset($_POST['applyLeave'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $contactNo = $_POST['contactNo'];
        $leaveDate = $_POST['leaveDate'];
        $leaveType = $_POST['leaveType'];
        
		$sql = "INSERT INTO leaves (name,email,contactNo,department,leavedate,leavetype,status) VALUES ('$name','$email','$contactNo','$department','$leaveDate','$leaveType','Pending');";
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