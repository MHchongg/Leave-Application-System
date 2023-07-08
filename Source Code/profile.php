<?php 

session_start();

if ($_SESSION['name'] !== 'manager' && isset($_SESSION['name'])) {

    if ($_SESSION['FirstTime'] == 1) {
        header("Location: changePwd.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&family=Quicksand:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Quicksand, Poppins;
        }

        body {
            background: linear-gradient(to right, #6f5ce8, #bc68c6);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            width:100%;
            height:60px;
            background-color: white;
            display:flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        header .title {
            width:80%;
            transform: translateX(20px);
            font-weight: bold;
            font-size: 18px;
        }

        header .avatar {
            width:20%;
            display:flex;
            align-items: center;
            justify-content: space-evenly;
            transform: translateX(-10px);
        }

        .avatar img {
            height:40px;
        }

        .avatar p {
            text-align: center;
        }

        .avatar button {
            width:10%;
            background-color: transparent;
            border:none;
            cursor:pointer;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            transform: translate(-150px,10px);
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1
        }
        
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        h1 {
            text-align: center;
            color: white;
            margin-top:30px;
        }

        .container {
            width:100%;
            height: fit-content;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .proInfo {
            width:60%;
            height:fit-content;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border-radius: 10px;
            display:flex;
            flex-wrap: wrap;
        }

        .left {
            width:30%;
            height:300px;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
            border-right: 4px dashed black;
            align-items: center;
        }

        .left img {
            width:80%;
            max-height: 200px;
        }

        .left h1 {
            color:black;
            width: 100%;
            margin:0;
        }

        .right {
            width:64%;
            margin-left: 25px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .right div {
            width: 50%;
        }

        .right p {
            font-weight: bold;
        }

        .right p:last-child {
            color:#bc68c6;
        }

        .ctg {
            font-size: 20px;
        }

        footer {
            width:100%;
            height:60px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: auto;
        }

        @media screen and (max-width:900px) {
            .proInfo {
                width:85%;
            }
        }

        @media screen and (max-width:820px) {
            header .avatar {
                width:35%;
            }
            header .title {
                width:65%;
            }

            .container {
                margin-bottom: 30px;
            }

            .proInfo {
                width:85%;
            }

            .left {
                width:100%;
                border-bottom: 4px dashed black;
                border-right: none;
            }

            .left img {
                width:45%;
            }

            .right {
                width:100%;
                font-size: 21px;
            }
        }

        @media screen and (max-width:550px) {
            #semail {
                font-size: small;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/4c23cd91aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <p class="title">Leave Application System</p>

        <div class="avatar">

            <img src="images/<?php echo $_SESSION['gender']; ?>.png">
    
            <p>Hello, <?php echo $_SESSION['name']; ?></p>

            <button onclick="showMenu()">
                <i class="fa-solid fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="home.php">Home</a>
                    <a href="profile.php">Profile Info</a>
                    <a href="logout.php">Log Out</a>
                </div>
            </button>
        </div>
    </header>

    <h1>Profile Info <i class="fa-solid fa-address-card"></i> </h1>

    <div class="container">
        <div class="proInfo">
            <div class="left">
                <img src="images/<?php echo $_SESSION['gender']; ?>.png">
                <h1><?php echo $_SESSION['name']; ?></h1>
            </div>

            <div class="right">
                <div>
                    <p class="ctg">Name <i class="fa-solid fa-circle-user"></i> :</p>
                    <p><?php echo $_SESSION['name'] ?></p>
                </div>

                <div>
                    <p class="ctg">Gender <i class="fa-solid fa-venus-mars"></i> :</p>
                    <p><?php echo $_SESSION['gender']; ?>
                        <?php 
                            if ($_SESSION['gender'] === 'male') {
                        ?> 
                        <i class="fa-solid fa-mars"></i>
                        <?php 
                            }
                            else if ($_SESSION['gender'] === 'female') {
                        ?>
                        <i class="fa-solid fa-venus"></i>
                        <?php } ?>
                    </p>
                </div>

                <div>
                    <p class="ctg">Email <i class="fa-solid fa-envelope"></i> :</p>
                    <p id="semail"><?php echo $_SESSION['email']; ?></p>
                </div>

                <div>
                    <p class="ctg">Department <i class="fa-solid fa-layer-group"></i> :</p>
                    <p>
                        <?php echo $_SESSION['department']; ?> 
                        <?php 
                            if ($_SESSION['department'] === 'HR') {
                                echo '<i class="fa-solid fa-person-rays"></i>';
                            }
                            else if ($_SESSION['department'] === 'IT') {
                                echo '<i class="fa-solid fa-laptop-code"></i>';
                            }
                            else if ($_SESSION['department'] === 'Marketing') {
                                echo '<i class="fa-solid fa-store"></i>';
                            }
                            else if ($_SESSION['department'] === 'Accounting') {
                                echo '<i class="fa-solid fa-calculator"></i>';
                            }
                            else if ($_SESSION['department'] === 'Sales') {
                                echo '<i class="fa-solid fa-comments-dollar"></i>';
                            }
                            else if ($_SESSION['department'] === 'Administration') {
                                echo '<i class="fa-solid fa-person-chalkboard"></i>';
                            }
                            else if ($_SESSION['department'] === 'Customer Service') {
                                echo '<i class="fa-solid fa-handshake-angle"></i>';
                            }
                        ?>
                    </p>
                </div>

                <div>
                    <p class="ctg">Contact No <i class="fa-solid fa-phone"></i> :</p>
                    <p><?php echo $_SESSION['contactNo'] ?></p>
                </div>

                <div>
                    <p class="ctg">Total Leave Applications <i class="fa-solid fa-file-invoice"></i> :</p>
                    <p>
                        <?php 
                            include "db_conn.php";
                            $email = $_SESSION['email'];
                            $sql = "SELECT * FROM leaves WHERE email = '$email';";

                            $que = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($que);
                            echo $count;
                            mysqli_free_result($que);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer id="copyright"><p>&copy; Leave Application System, All Right Reserved. Designed By Chong Ming Hong</p></footer>

    <script>
        let dropdownContent = document.querySelector('.dropdown-content')
        let dropdown = document.querySelector('header button')
        let dropbtn = document.querySelector('.fa-caret-down')

        function showMenu() {

            dropbtn.style.transition = '0.4s'

            if(dropbtn.style.transform === 'rotate(90deg)' || dropdownContent.style.display === 'block') {
                dropbtn.style.transform = 'rotate(0deg)'
                dropdownContent.style.display = 'none'
            }
            else {
                dropbtn.style.transform = 'rotate(90deg)'
                dropdownContent.style.display = 'block'
            }
        }
    </script>
</body>
</html>

<?php
}else{
    include "logout.php";
}
?>