<?php 

session_start();

if (isset($_SESSION['name'])) {
    include "logout.php";
}
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application System</title>
    <link rel="stylesheet" href="css/index.css"></link>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>

    <div class="container">

      <div class="title">

        <h2>Welcome for using this Leave Application System</h2>
        
        <img src="images/indeximage.png">
      
      </div>

      <div class="login">

        <div class="switchBtn">
            <button class="usrBtn">Employee</button>
            <button class="adBtn">Manager</button>
        </div>

        <form class="userLoginForm" method="post" action="userlogin.php">

          <div class="card">
              <p>Employee Log in</p>

              <div class="inputBox">
                  <input type="text" required="required" id="email" name="email">
                  <span class="email">Email</span>
              </div>
    
              <div class="inputBox">
                  <input type="password" required="required" id="password" name="password">
                  <span>Password</span>
              </div>
                
              <p>
                  <input type="submit" value="Submit" name="submit" class="btns">
                  <input type="reset" value="Clear" name="reset" class="btns">
              </p>

          </div>

          
  
        </form>

        <form class="managerLoginForm" method="post" action="managerlogin.php">

          <div class="card">
              <p>Manager Log in</p>

              <div class="inputBox">
                  <input type="text" required="required" id="email" name="email">
                  <span class="email">Email</span>
              </div>
    
              <div class="inputBox">
                  <input type="password" required="required" id="password" name="password">
                  <span>Password</span>
              </div>
                
              <p>
                  <input type="submit" value="Submit" name="submit" class="btns">
                  <input type="reset" value="Clear" name="reset" class="btns">
              </p>

          </div>
  
        </form>

        <?php if (isset($_GET['error'])) { ?>

        <p class="error">
            <script>
                Swal.fire({
                    title: 'Login Failed',
                    text: "Your email or password is incorrect. Please try again.",
                    icon: 'error',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/index.php"
                    }
                })
            </script>
        </p>

        <?php } ?>

      </div>  

    </div>

    <p id="copyright">&copy; Leave Application System, All Right Reserved. Designed By Chong Ming Hong</p>
    
    <script src="javascript/index.js"></script>
</body>

</html>

<?php }?>