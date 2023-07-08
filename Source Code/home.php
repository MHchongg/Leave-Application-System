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
    <title>Employee Home Page</title>
    <link rel="stylesheet" href="css/home.css"></link>
    <script src="https://kit.fontawesome.com/4c23cd91aa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>

    <?php if (isset($_GET['success'])) { ?>

    <p class="success">
        <script>
            Swal.fire({
                    title: 'Login successfully',
                    icon: 'success',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/home.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <header>
        <p class="title">Leave Application System</p>

        <div class="avatar">

            <img src="images/<?php echo $_SESSION['gender'] ?>.png">
    
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
    
    <div class="container">

        <h1>Leave Application Records</h1>

        <div class="records">

            <?php
                include "db_conn.php";
                            
                $email = $_SESSION['email'];

                $sql = "SELECT * FROM leaves WHERE email = '$email' ORDER BY leavedate DESC ";

                $que = mysqli_query($conn, $sql);

                $num = 1;
                if($que->num_rows > 0) {            
            ?>

            <div class="gotRecord">

                <div class="recordTable">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Leave Date</th>
                            <th>Leave Type</th>
                            <th>Status</th>
                            <th></th>
                        </tr>

                        <?php 
                            while($result = mysqli_fetch_assoc($que)) {
                        ?>
    
                        <tr>
                            <td><?php echo $num;?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><?php echo $result['department'];?></td>
                            <td><?php echo $result['email'];?></td>
                            <td><?php echo $result['contactNo'];?></td>
                            <td><?php echo $result['leavedate'];?></td>
                            <td><?php echo $result['leavetype'];?></td>
                            <td><?php echo $result['status'];?></td>
                            <?php if($result['status'] === 'Pending') { ?>
                            <td><button title="Edit"><i class="fa-solid fa-pen-to-square editBtn" value="<?php echo $result['id'] . '|' . $result['leavedate'] . '|' . $result['leavetype']; ?>"></i></button></td>
                            <?php } ?>
                        </tr>

                    <?php $num++;}?>
                    </table>
                </div>
            </div>

            <?php 
                }
                else {
            ?>

            <div class="noRecord">
                <img src="images/norecord.svg">
                <h3>No Record Found</h3>
            </div>

            <?php }?>

            <div class="addNew">
                <button class="newBtn">+ New</button>
            </div>
        </div>

        <script>
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('editBtn')) {
                    let value = event.target.getAttribute('value');
                    let arr = value.split("|")
                    let editLeaveID = arr[0]
                    let leaveDate = arr[1]
                    let leaveType = arr[2]
                    let form = document.querySelector('#edit');
                    form.action = 'editLeave.php?editLeaveID=' + encodeURIComponent(editLeaveID);
                    document.querySelector('.outputDate').innerHTML = leaveDate
                    document.querySelector('.outputType').innerHTML = leaveType
                }
            });
        </script>

        <dialog class="editDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeEditDialog"></i></button>
            <h2>Edit Information</h2>

            <form action="" method="post" id="edit">
                <div class="editForm">

                    <div>
                        <p>Current Leave Date:</p>
                        <p class="outputDate"></p>

                        <i class="fa-solid fa-arrow-down"></i>

                        <input type="date" name="leaveDate" required>

                    </div>

                    <div>
                        <p>Current Leave Type:</p>
                        <p class="outputType"></p>

                        <i class="fa-solid fa-arrow-down"></i>

                        <select name="leaveType" required>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Unpaid Leave">Unpaid Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Bereavement Leave">Bereavement Leave</option>
                            <option value="Others">Others</option>
                        </select>

                    </div>

                    <div>
                        <button type="submit" name="editLeave">Submit</button>
                        <button type="reset">Clear</button>
                    </div>
                </div>
                                    
            </form>
        </dialog>

        <dialog class="applyDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeApplyDialog"></i></button>
            <h2>New Leave Application</h2>

            <form action="applyLeave.php" method="post" class="applyForm">

                <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                <input type="hidden" name="department" value="<?php echo $_SESSION['department']; ?>">
                <input type="hidden" name="contactNo" value="<?php echo $_SESSION['contactNo']; ?>">

                <div>
                    <p>Leave Date:*</p>
                    <input type="date" name="leaveDate" required>
                </div>

                <div>
                    <p>Leave Type:*</p>
                    <select name="leaveType" required>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Annual Leave">Annual Leave</option>
                        <option value="Maternity Leave">Maternity Leave</option>
                        <option value="Unpaid Leave">Unpaid Leave</option>
                        <option value="Bereavement Leave">Bereavement Leave</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div>
                    <button type="submit" name="applyLeave">Apply</button>
                    <button type="reset">Clear</button>
                </div>

            </form>
        </dialog>

    </div>

    <?php if (isset($_GET['successful'])) { ?>

    <p class="successful">
        <script>
            Swal.fire({
                    title: 'Successfully',
                    icon: 'success',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/home.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <?php if (isset($_GET['failure'])) { ?>

    <p class="failure">
        <script>
            Swal.fire({
                    title: 'Something wrong. Please try again.',
                    icon: 'error',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/home.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <footer id="copyright"><p>&copy; Leave Application System, All Right Reserved. Designed By Chong Ming Hong</p></footer>
    
    <script src="javascript/home.js"></script>
</body>
</html>

<?php 

}else{
    include "logout.php";
}
?>