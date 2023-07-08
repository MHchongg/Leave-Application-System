<?php 

session_start();

if ($_SESSION['name'] === 'manager' && isset($_SESSION['name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Home Page</title>
    <link rel="stylesheet" href="css/manager.css"></link>
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
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/manager.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <header>
        <p class="title">Leave Application System</p>

        <div class="avatar">
            <img src="images/admin.png">
            <p>Hello, Manager</p>

            <button onclick="showMenu()">
                <i class="fa-solid fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="logout.php">Log Out</a>
                </div>
            </button>
        </div>
    </header>

    <div class="container">

        <h1>All Pending Leaves Applications</h1>

        <div class="records">

            <?php
                include "db_conn.php";
                            
                $email = $_SESSION['email'];

                $sql = "SELECT * FROM leaves WHERE status = 'Pending' ORDER BY leavedate; ";

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
                            <th></th>
                        </tr>

                        <?php 
                            while($result = mysqli_fetch_assoc($que)) {
                        ?>
    
                        <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><?php echo $result['department'];?></td>
                            <td><?php echo $result['email'];?></td>
                            <td><?php echo $result['contactNo'];?></td>
                            <td><?php echo $result['leavedate'];?></td>
                            <td><?php echo $result['leavetype'];?></td>
                            <td><?php echo $result['status'];?></td>
                            <td><button title="Approve"><i class="fa-regular fa-circle-check approveBtn" value="<?php echo $result['id']; ?>"></i></button></td>
                            <td><button title="Reject"><i class="fa-regular fa-circle-xmark rejectBtn" value="<?php echo $result['id']; ?>"></i></button></td>
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
                <h3>No Pending Leaves Record Found</h3>
            </div>

            <?php }?>

            <div class="viewAll">
                <button class="viewLeavesBtn">View All Leaves</button>
            </div>

        </div>

        <div class="employees">
            <button class="viewEmployeesBtn">View All Employees</button>
            <button class="addEmployeesBtn">Add Employees</button>
        </div>

        <dialog class="viewEmployeesDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeViewEmployeesDialog"></i></button>

            <h2>All Employees</h2>

            <?php
                include "db_conn.php";

                $sql = "SELECT * FROM employee;";

                $que = mysqli_query($conn, $sql);

                $num = 1;
                if($que->num_rows > 0) {            
            ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th></th>
                </tr>

                <?php 
                    while($result = mysqli_fetch_assoc($que)) {
                ?>

                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['gender']; ?></td>
                    <td><?php echo $result['department']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['contactNo']; ?></td>
                    <td><button title="Delete"><i class="fa-solid fa-trash-can deleteBtn" value="<?php echo $result['id'] . '|' . $result['email']; ?>"></i></button></td>
                </tr>
                <?php $num++;}?> 
            </table>

            <?php 
                }
                else {
            ?>
            <h1>No Existing Employee</h1>
            <?php } ?>

        </dialog>

        <script>
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('deleteBtn')) {
                    let value = event.target.getAttribute('value');
                    let arr = value.split("|")
                    let id = arr[0]
                    let email = arr[1]
                    let form = document.querySelector('.deleteForm');
                    form.action = 'deleteEmp.php?id=' + encodeURIComponent(id) + '&' + 'email=' + encodeURIComponent(email);
                }
            });
        </script>

        <dialog class="deleteDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeDeleteDialog"></i></button>

            <h2>Are you sure you want to delete?</h2>

            <div class="deleteBtns">
                <form method="post" class="deleteForm">
                    <button type="submit" name="deleteEmp">Yes</button>
                </form>

                <div>
                    <button class="closeDeleteDialog">Cancel</button>
                </div>
            </div>
        </dialog>

        <dialog class="addEmployeesDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeAddEmployeesDialog"></i></button>
        
            <h2>Add New Employee</h2>

            <form action="addEmp.php" method="post" class="addEmployeesForm" name="addEmpForm" onsubmit="return validateForm()">

                <div>
                    <p>Name:*</p>
                    <input type="text" name="name" placeholder="Name" required>
                </div> 

                <div>
                    <p>Gender:*</p>
                    <div>
                        <input type="radio" id="male" name="gender" value="Male" required>
                        <label for="male">Male</label><br>
                    </div>
    
                    <div>
                        <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label><br>
                    </div>
                </div>

                <div>
                    <p>Email:*</p>
                    <input type="text" name="email" placeholder="format: xxxx@company.com" required>
                </div> 
                
                <div>
                    <p>Department:*</p>
                    <select name="department" required>
                        <option value="IT">IT</option>
                        <option value="Marketing">Marketing</option>
                        <option value="HR">HR</option>
                        <option value="Sales">Sales</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Administration">Administration</option>
                        <option value="Customer Service">Customer Service</option>
                    </select>
                </div>

                <div>
                    <p>Contact No:*</p> 
                    <input type="text" name="contactNo" placeholder="format: 0123456789" required>
                </div>

                <div>
                    <button type="submit" name="addEmp">Add</button>
                    <button type="reset">Clear</button>
                </div>

            </form>
        </dialog>

        <dialog class="viewLeavesDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeViewDialog"></i></button>

            <h2>All Leaves</h2>

            <?php
                include "db_conn.php";
                            
                $email = $_SESSION['email'];

                $sql = "SELECT * FROM leaves ORDER BY name,leavedate; ";

                $que = mysqli_query($conn, $sql);

                $num = 1;
                if($que->num_rows > 0) {            
            ?>

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
                </tr>

                <?php 
                    while($result = mysqli_fetch_assoc($que)) {
                ?>

                <tr>
                    <td><?php echo $num; ?></td>
                    <td><?php echo $result['name'];?></td>
                    <td><?php echo $result['department'];?></td>
                    <td><?php echo $result['email'];?></td>
                    <td><?php echo $result['contactNo'];?></td>
                    <td><?php echo $result['leavedate'];?></td>
                    <td><?php echo $result['leavetype'];?></td>
                    <td><?php echo $result['status'];?></td>
                </tr>
                <?php $num++;}?>
            </table>

            <?php
            }
            else {
            ?>
            <h1>No Record Found</h1>
            <?php } ?>
        </dialog>

        <script>
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('approveBtn')) {
                    let id = event.target.getAttribute('value');
                    let form = document.querySelector('.approveForm');
                    form.action = 'approve.php?id=' + encodeURIComponent(id);
                }

                if (event.target.classList.contains('rejectBtn')) {
                    let id = event.target.getAttribute('value');
                    let form = document.querySelector('.rejectForm');
                    form.action = 'reject.php?id=' + encodeURIComponent(id);
                }
            });
        </script>

        <dialog class="approveDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeApproveDialog"></i></button>

            <h2>Application Approval Confirmation</h2>

            <div class="approveBtns">
                <form method="post" class="approveForm">
                    <button type="submit" name="approve">Approve</button>
                </form>

                <div>
                    <button class="closeApproveDialog">Cancel</button>
                </div>
            </div>

        </dialog>

        <dialog class="rejectDialog">
            <button class="exitBtn"><i class="fa-solid fa-xmark fa-2xl closeRejectDialog"></i></button>

            <h2>Application Rejection Confirmation</h2>

            <div class="rejectBtns">
                <form method="post" class="rejectForm">
                    <button type="submit" name="reject">Reject</button>
                </form>

                <div>
                    <button class="closeRejectDialog">Cancel</button>
                </div>
            </div>

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
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/manager.php"
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
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/manager.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <?php if (isset($_GET['sameEmail'])) { ?>

    <p class="sameEmail">
        <script>
            Swal.fire({
                    icon: 'error',
                    title: 'Repeated Email Address',
                    text:'Please enter another email address',
                    showConfirmButton: true,
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost/1AL_LeaveApplicationSystem/manager.php"
                    }
                })
        </script>
    </p>

    <?php }?>

    <footer id="copyright"><p>&copy; Leave Application System, All Right Reserved. Designed By Chong Ming Hong</p></footer>
    
    <script type="text/javascript" src="javascript/manager.js"></script>
</body>
</html>

<?php 
}
else{
    include "logout.php";
}
?>