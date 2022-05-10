<?php
include('db_conn.php');
$info = $show2 = $show1 = '';

$sql2 = "SELECT * FROM `employees`;";

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
            <td><button onclick="location.href=\'orderchoosecustomer.php?eid='.$row1['eid'].'\';">Choose</button></td>
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
    <title>Product Manager</title>
    <link rel="stylesheet" href="dtstyle.css">
    <link rel="stylesheet" href="formstyle.css">
</head>

<body>
    <header>
        <h1>
            Make Order
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Choose Employee
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="index.php">Home</a></h3>
                <ul class="nav">
                    <?php //echo $show1; ?>
                </ul>
            </aside>
            <aside class="right">
                <h1><?php //echo $tango ?></h1>
                <?php echo $info; ?>
                <table class="list">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    <?php echo $show2; ?>
                </table>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>