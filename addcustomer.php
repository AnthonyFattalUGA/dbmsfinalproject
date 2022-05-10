<?php
include('db_conn.php');
$info = $show = $show1 = '';
if (isset($_REQUEST['add'])) { 
    $cname = $_REQUEST['cname'];
    $zip = $_REQUEST['zip'];
    $phone_number = $_REQUEST['phone_number'];
    $email = $_REQUEST['email'];

    $sql2 = "SELECT * FROM `customers` WHERE `cid` = 0";
    $result = mysqli_query($conn,$sql2);
    if (mysqli_num_rows($result)) {
        $info = "Customer Already Exists!"; 
    }else{ //adds customer
        $sql = "INSERT INTO `customers` (`cname`,`zip`,`phone_number`,`email`) VALUES ('$cname','$zip','$phone_number','$email')";
        $check = mysqli_query($conn,$sql);
        if ($check) {
            $info = "Customer Added!";
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
            Add Customer
        </h2>
        <?php echo $info; ?>
        <div class="flex">
            <aside class="right">
                <form action="addcustomer.php" method="post">
                    <table>
                        <td>Customer Name:</td>
                            <td>
                                <input type="text" name="cname" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code:</td>
                            <td>
                            <input type="number" min="0" step="1" name="zip" required>
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
                                <button type="submit" name="add">Add Customer</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <a href="customerview.php">View Customer List</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>