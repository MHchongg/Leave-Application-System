<?php 

session_start();

if ($_SESSION['FirstTime'] == 1) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Time Login</title>
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
            height: fit-content;
            display:flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        h1 {
            width:50%;
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        .changePwdBox {
            width:60%;
            height:350px;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 10px;
            display:grid;
            grid-template-columns: repeat(10,10%);
            grid-template-rows: repeat(10,10%);
            margin-top: 50px;
        }

        .cancel {
            width:100%;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            margin-top: 40px;
        }

        .cancel a {
            text-decoration: none;
            color:white;
            font-size: x-large;
        }

        .changePwdBox p:first-child {
            grid-row: 2/3;
            grid-column: 2/5;
        }

        .changePwdBox p:nth-child(3) {
            grid-row: 5/6;
            grid-column: 2/5;
        }

        #newPwd {
            grid-row: 3/4;
            grid-column: 2/10;
            padding-left: 10px;
        }

        #confirmPwd {
            grid-row: 6/7;
            grid-column: 2/10;
            padding-left: 10px;
        }

        .btns {
            grid-row:9/10;
            grid-column: 2/10;
            display: flex;
            justify-content: space-around;
        }

        .btns button {
            background: linear-gradient(to right, #6f5ce8, #bc68c6);
            color:white;
            padding:20px;
            cursor: pointer;
            border:none;
            border-radius: 5px;
        }

        .btns button:hover {
            background: linear-gradient(to right, #5e4ab7, #9252a1); ;
        }

        @media screen and (max-width:680px) {
            .changePwdBox {
                width:90%;
            }
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>

    <h1>First Time Login user needs to change your password to secure your account</h1>

    <form action="pwdChange.php" method="post" class="changePwdBox">
        <p>New Password:</p>
        <input type="password" name="newPwd" id="newPwd" placeholder="Enter your new password" required>

        <p>Confirm Password:</p>
        <input type="password" name="confirmPwd" id="confirmPwd" placeholder="Confirm your new password" required>

        <div class="btns">
            <button type="submit" name="chgPwd">Submit</button>
            <button type="reset">Clear</button>
        </div>
    </form>

    <div class="cancel">
        <a href="logout.php">Cancel</a>
    </div>

    <?php if (isset($_GET['error'])) { ?>

    <p class="error">
        <script>
            Swal.fire({
                    title: 'Failed',
                    icon: 'error',
                    text: 'Please make sure the passwords you enter are the same (Case Sensitive) & the password should not be same as your email ',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/changePwd.php"
                    }
                })
        </script>
    </p>

    <?php }?>
    
</body>
</html>

<?php 

}else{
    include "logout.php";
}
?>