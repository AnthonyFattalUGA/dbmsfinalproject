<?php 
include('db_conn.php');
$info = $show2 = $show1 = '';
if (isset($_REQUEST['dlt_id'])) { // for delete function 
    $dlt_id = $_REQUEST['dlt_id'];
    $sql = "DELETE FROM `orders` WHERE `oid` = '$dlt_id'";
    $check = mysqli_query($conn,$sql);
    if ($check) {
        $sql2 = "DELETE FROM `orders` WHERE `oid` = '$dlt_id'";
        $info = "Order Deleted";  
    }
    else {
        $info = "An error occurred";
    }
}

$sql2 = "select orders.*, customers.cname, employees.ename, products.pname, products.price from orders
left outer join customers on orders.cid = customers.cid
left outer JOIN employees on orders.eid = employees.eid
left outer JOIN products on products.pid = orders.pid;";
$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if(!empty($row1)) {
    do {
        $total = $row1['count'] * $row1['price'];
        $show2 .= '
        <tr>
            <td>'.$row1['oid'].'</td>
            <td>'.$row1['odate'].'</td>
            <td>'.$row1['pid'].'</td>
            <td>'.$row1['cid'].'</td>
            <td>'.$row1['eid'].'</td> 
            <td>'.$row1['count'].'</td>
            <td>'.$row1['pname'].'</td>
            <td>'.$row1['cname'].'</td>
            <td>'.$row1['ename'].'</td> 
            <td>'.$total.'</td>
            <td><button onclick="location.href=\'orderview.php?dlt_id='.$row1['oid'].'\';">Delete</button></td> 
        </tr>';
    } 
    while($row1 = mysqli_fetch_assoc($result1));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Manager</title>
    <link rel="stylesheet" href="dtstyle.css">
    <link rel="stylesheet" href="formstyle.css">
</head>

<body>
    <header>
        <h1>
            Order Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Order List 
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="orderview.php">Order Home</a></h3>
                <h3 class="title"><a href="index.php">Home Page</a></h3>
                <ul class="nav">
                    <!----php-->
                </ul> 
            </aside>
        <!---no need for dropdowns-->
        


        <aside class="right">
            <h4 class="title"><?php echo "All Orders"?> </h4>
            <?php echo $info; ?>
            <table class="list">
                <tr>
                    <th>Order id</th>
                    <th>Order date</th>
                    <th>Product id</th>
                    <th>Customer id</th>
                    <th>Employee id</th>
                    <th>Count</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Employee</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <?php echo $show2; ?>
            </table>
            <a href="orderchooseemployee.php">Place Order</a>
        </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>
