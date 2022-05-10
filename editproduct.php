<?php
include('db_conn.php');
$info = $show2 = $show1 = '';
if (isset($_REQUEST['dlt_id'])) { //delete action
    $dlt_id = $_REQUEST['dlt_id'];
    $sql = "DELETE FROM `products` WHERE `pid` = '$dlt_id'";
    $check = mysqli_query($conn,$sql); // check query to ensure good
    if ($check) { //product found
        $sql2 = "DELETE FROM `products` WHERE `pid` = '$dlt_id'";
        $info = "Product Deleted!";
    }else{
        $info = "An error occurred!";
    }
}

$sql1 = "SELECT category FROM `products` GROUP BY category";
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);
if (!empty($row)) { //query categories
    do {
        $show1 .= '
        <li><a href="productview.php?category='.$row['category'].'">'.$row['category'].'</a></li>
        ';
    } while ($row = mysqli_fetch_assoc($result));
}



$sql2='';
if (isset($_REQUEST["edit_pid"])) {//$tango != "") { //query for products in specified category
    $editpid = $_REQUEST["edit_pid"];
    $sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where `pid` = '$editpid' and products.sid=suppliers.sid;"; 
    $result3 = mysqli_query($conn,$sql2);
    $row3 = mysqli_fetch_assoc($result3);
}
$pname = ''; //init variables for later usage
$pid = 0;
$pname = '';
$stock = 0;
$price = 0.00;
$category = '';
$sname = '';
$color = '';
$psize = '';
$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if (!empty($row1)) {// will list original values
    $pid = $row1['pid'];
    $pname = $row1['pname'];
    $stock = $row1['stock'];
    $price = $row1['price'];
    $category = $row1['category'];
    $sname = $row1['sname'];
    $color = $row1['color'];
    $psize = $row1['psize'];
    do {
        $show2 .= '
        <tr>
            <td>Current</td>
            <td>'.$pid.'</td>
            <td>'.$pname.'</td>
            <td>'.$stock.'</td>
            <td>'.$price.'</td>
            <td>'.$category.'</td>
            <td>'.$sname.'</td>
            <td>'.$color.'</td>
            <td>'.$psize.'</td>
            </tr>';
    } while ($row1 = mysqli_fetch_assoc($result1));
}

// fix for this page --------------

if (isset($_REQUEST['edit'])) { //add product query
    if (isset($_REQUEST['stock']) ) {
        $newstock = $_REQUEST['stock'];

        $sql7 = "UPDATE `products` SET `stock` = '$newstock' WHERE `products`.`pid` = $pid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Product Updated";
    }
    if (isset($_REQUEST['price'])) {
        $newprice = $_REQUEST['price'];

        $sql7 = "UPDATE `products` SET `price` = '$newprice' WHERE `products`.`pid` = $pid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Product Updated";
    }
    header('Location:editproduct.php?edit_pid='.$pid);
}
//-------------------------------------

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
            Product Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Product List
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="productview.php">Product Home</a></h3>
                <ul class="nav">
                    <?php //echo $show1; ?>
                </ul>
            </aside>
            <aside class="right">
                <h1><?php //echo $tango ?></h1>
            <h3 class="title"><?php 
                    echo "Edit : ".$pname;
            ?>
            </h3>
                <?php echo $info; ?>
                <table class="list">
                    <tr>
                        <th></th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Stock(warehouse)</th>
                        <th>Price($USD)</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Color</th>
                        <th>Size</th> 
                    </tr>
                    <?php echo $show2; ?>
                    <form method="post">
                        <tr>
                            <td>New</td>
                            <td><?php echo $pid; ?></td>
                            <td><?php echo $pname; ?></td>
                            <td><input type="number" value="<?php echo $stock; ?>" min="0" step="1" name="stock"></td>
                            <td><input type="number" value="<?php echo $price; ?>" min="0" step="0.01" name="price"></td>
                            <td><?php echo $category; ?></td>
                            <td><?php echo $sname; ?></td>
                            <td><?php echo $color; ?></td>
                            <td><?php echo $psize; ?></td>
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
