<?php
include('db_conn.php');
$info = $show2 = $show1 = '';
if (isset($_REQUEST['dlt_id'])) { //delete action
    $dlt_id = $_REQUEST['dlt_id'];
    $sql = "DELETE FROM `customers` WHERE `cid` = '$dlt_id'";
    $check = mysqli_query($conn,$sql); // check query to ensure good
    if ($check) { //customer found
        $sql2 = "DELETE FROM `customers` WHERE `cid` = '$dlt_id'";
        $info = "Customer Deleted!";
    }else{
        $info = "An error occurred!";
    }
}

$sql2='';
if (isset($_REQUEST["edit_cid"])) {//$tango != "") { //query for products in specified category
    $editcid = $_REQUEST["edit_cid"];
    $sql2 = "SELECT * FROM `customers` WHERE `cid` = '$editcid'"; 
    $result3 = mysqli_query($conn,$sql2);
    $row3 = mysqli_fetch_assoc($result3);
}

$cid = 0;
$cname = ''; 
$zip = 0;
$phone_number = '';
$email = '';
$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if (!empty($row1)) { //original values
    $cid = $row1['cid'];
    $cname = $row1['cname'];
    $zip = $row1['zip'];
    $phone_number = $row1['phone_number'];
    $email = $row1['email'];
    do {
        $show2 .= '
        <tr>
            <td>Current</td>
            <td>'.$cid.'</td>
            <td>'.$cname.'</td>
            <td>'.$zip.'</td>
            <td>'.$phone_number.'</td>
            <td>'.$email.'</td>
            </tr>';
    } while ($row1 = mysqli_fetch_assoc($result1));
}



if (isset($_REQUEST['edit'])) { //add customer query
    if (isset($_REQUEST['zip']) ) {
        $newzip = $_REQUEST['zip'];

        $sql7 = "UPDATE `customers` SET `zip` = '$newzip' WHERE `customers`.`cid` = $cid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Customer Updated";
    }
    if (isset($_REQUEST['phone_number'])) {
        $newphonenumber = $_REQUEST['phone_number'];

        $sql7 = "UPDATE `customers` SET `phone_number` = '$newphonenumber' WHERE `customers`.`cid` = $cid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Customer Updated";
    }
    if (isset($_REQUEST['email']) ) {
        $newemail = $_REQUEST['email'];

        $sql7 = "UPDATE `customers` SET `email` = '$newemail' WHERE `customers`.`cid` = $cid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Customer Updated";
    }
    header('Location:editcustomer.php?edit_cid='.$cid);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Manager</title>
    <link rel="stylesheet" href="dtstyle.css">
    <link rel="stylesheet" href="formstyle.css">
</head>
<body>
    <header>
        <h1>
            Customer Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Customer List
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="customerview.php">Customer Home</a></h3>
                <ul class="nav">
                    <?php //echo $show1; ?>
                </ul>
            </aside>
            <aside class="right">
                <h1><?php //echo $tango ?></h1>
            <h3 class="title"><?php 
                    echo "Edit : ".$cname;
            ?>
            </h3>
                <?php echo $info; ?>
                <table class="list">
                    <tr>
                        <th></th>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Zip Code</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                    </tr>
                    <?php echo $show2; ?>
                    <form method="post">
                        <tr>
                            <td>New</td>
                            <td><?php echo $cid; ?></td>
                            <td><?php echo $cname; ?></td>
                            <td><input type="text" value="<?php echo $zip; ?>" name="zip"></td>
                            <td><input type="text" value="<?php echo $phone_number; ?>" name="phone_number"></td>
                            <td><input type="text" value="<?php echo $email; ?>" name="email"></td>
                            <td><button type="submit" name="edit">Submit</button></td>
                        </tr>
                    </form>
                </table>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>
