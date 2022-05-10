<?php
include('db_conn.php');
$info = $show = $show1 = '';
if (isset($_REQUEST['add'])) { 
    $ename = $_REQUEST['ename'];
    $phone_number = $_REQUEST['phone_number'];
    $email = $_REQUEST['email'];

    $sql2 = "SELECT * FROM `employees` WHERE `eid` = 0";
    $result = mysqli_query($conn,$sql2);
    if (mysqli_num_rows($result)) {
        $info = "Employee Already Exists!"; 
    }else{ //adds employee
        $sql = "INSERT INTO `employees` (`ename`,`phone_number`,`email`) VALUES ('$ename','$phone_number','$email')";
        $check = mysqli_query($conn,$sql);
        if ($check) {
            $info = "Employee Added!";
        }else{
            $info = "An error occurred!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Manager</title>
    <link rel="stylesheet" href="dtstyle.css">
    <link rel="stylesheet" href="formstyle.css">
</head>

<body>
    <header>
        <h1>
            Employee Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Add Employee
        </h2>
        <?php echo $info; ?>
        <div class="flex">
            <aside class="right">
                <form action="addemployee.php" method="post">
                    <table>
                        <td>Employee Name:</td>
                            <td>
                                <input type="text" name="ename" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td>
                            <input type="text" name="phone_number" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" name="email" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" name="add">Add Employee</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <a href="employeeview.php">View Employee List</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>