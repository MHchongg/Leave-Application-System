<?php

    session_start();

	include'db_conn.php'; 
	if (isset($_POST['chgPwd'])){
        $newPwd = $_POST['newPwd'];
        $confirmPwd = $_POST['confirmPwd'];
		$email = $_SESSION['email'];

        if($newPwd !== $confirmPwd || $confirmPwd === $email) {
            header("Location:changePwd.php?error");
            exit();
        }
        else {
            $encryptedPwd = password_hash($confirmPwd, PASSWORD_DEFAULT);
            $sql = "UPDATE employee SET password = '$encryptedPwd',FirstTime = 0 WHERE email = '$email'";
            $run = mysqli_query($conn,$sql);
            if($run == true){
                $_SESSION['FirstTime'] = 0;
                header("Location:home.php?success");
                exit();
                
            }else{

                header("Location:changePwd.php?error");
                exit();
                
            }
        }
	}
    else {
        header("Location:changePwd.php?error");
        exit();
    }
?>