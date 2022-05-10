<?php
include('db_conn.php');

if (isset($_POST['amount'])) {
    $currentamount = $_POST['amount'];
    $currentdate = date("Y-m-d");
    $currentpid = $_REQUEST["pid"];
    $currentcid = $_REQUEST["cid"];
    $currenteid = $_REQUEST["eid"];
    $insertsql = "INSERT INTO `orders` (`oid`, `odate`, `pid`, `cid`, `eid`, `count`) VALUES (NULL, '$currentdate', '$currentpid', '$currentcid', '$currenteid', '$currentamount'); ";
    mysqli_query($conn,$insertsql);
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
            Submit order?
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
                <?php //echo $info; ?>
                PRODUCT
                <?php include('producttable.php'); ?>
                CUSTOMER
                <?php include('customertable.php'); ?>
                EMPLOYEE
                <?php include('employeetable.php'); ?>
                QUANTITY:
                (in stock: <?php echo $row3['stock']; ?>)
                <form method="post">
                    <input type="number" value="1" min="0" max = "<?php echo $row3['stock']; ?>" step="1" name="amount">
                    <button type="submit" name="submitamount">Submit</button>
                </form>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>
</html>