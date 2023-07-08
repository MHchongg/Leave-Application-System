<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    $sql = "SELECT * FROM manager WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['email'] === $email && password_verify($pass, $row['password'])) {


            $_SESSION['email'] = $row['email'];

            $_SESSION['name'] = $row['name'];

            $_SESSION['id'] = $row['id'];

            header("Location: manager.php?success");

            exit();

        }
        else{

            header("Location: index.php?error");

            exit();

        }

    }
    else{

        header("Location: index.php?error");

        exit();

    }
}
else{
    header("Location: index.php");
    exit();
}
?>