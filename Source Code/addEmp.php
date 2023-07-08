<?php

	include'db_conn.php'; 
	if (isset($_POST['addEmp'])){
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $contactNo = $_POST['contactNo'];
        $pass = $_POST['email'];
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $checkEmail = "SELECT email FROM employee";
        $result = $conn->query($checkEmail);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($email === $row['email']) {
                    header("Location:manager.php?sameEmail");
                    exit();
                }
            }
        }

        $sql = "INSERT INTO employee (name,gender,email,department,contactNo,password,FirstTime) VALUES ('$name','$gender','$email','$department','$contactNo','$hashedPassword',1);";
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