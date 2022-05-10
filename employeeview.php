<?php
include('db_conn.php');
$info = $show2 = $show1 = '';
if (isset($_REQUEST['dlt_id'])) { //delete action
    $dlt_id = $_REQUEST['dlt_id'];
    $sql = "DELETE FROM `employees` WHERE `eid` = '$dlt_id'";
    $check = mysqli_query($conn,$sql); // check query to ensure good
    if ($check) { //employee found
        $sql2 = "DELETE FROM `employees` WHERE `eid` = '$dlt_id'";
        $info = "Employee Deleted!";
    }else{
        $info = "An error occurred!";
    }
}

$sql2 = "SELECT * FROM `employees`";
$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if (!empty($row1)) {
    do {
        $show2 .= '
        <tr>
            <td>'.$row1['eid'].'</td>
            <td>'.$row1['ename'].'</td>
            <td>'.$row1['phone_number'].'</td>
            <td>'.$row1['email'].'</td>
            <td><button onclick="location.href=\'editemployee.php?edit_eid='.$row1['eid'].'\';">Edit</button></td>
            <td><button onclick="location.href=\'employeeview.php?dlt_id='.$row1['eid'].'\';">Delete</button></td>
        </tr>';
    } while ($row1 = mysqli_fetch_assoc($result1));
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
            Employee List
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="employeeview.php">Employee Home</a></h3>
                <h3 class="title"><a href="index.php">Home Page</a></h3>
                <ul class="nav">
                    <?php //echo $show1; ?>
                </ul>
            </aside>
            <aside class="right">
                <h1><?php //echo $tango ?></h1>
            <h3 class="title"><?php echo "All Employees"?>
            </h3>
                <?php echo $info; ?>
                <table class="list">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php echo $show2; ?>
                </table>
                <a href="addemployee.php">Add Employee</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>
