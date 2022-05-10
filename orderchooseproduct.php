<?php
include('db_conn.php');
$info = $show2 = $show1 = '';

$sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where products.sid=suppliers.sid;";

$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if (!empty($row1)) {
    do {
        $show2 .= '
        <tr>
            <td>'.$row1['pid'].'</td>
            <td>'.$row1['pname'].'</td>
            <td>'.$row1['stock'].'</td>
            <td>'.$row1['price'].'</td>
            <td>'.$row1['category'].'</td>
            <td>'.$row1['sname'].'</td>
            <td>'.$row1['color'].'</td>
            <td>'.$row1['psize'].'</td>
            <td><button onclick="location.href=\'placeorder.php?eid='.$_REQUEST["eid"].'&cid='.$_REQUEST["cid"].'&pid='.$row1['pid'].'\';">Choose</button></td>
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
            Choose Product
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
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Color</th>
                        <th>Size</th>
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