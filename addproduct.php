<?php
include('db_conn.php');
$info = $show = $show1 = '';
if (isset($_REQUEST['add'])) { //add product query
    $category = $_REQUEST['category'];
    $stock = $_REQUEST['stock'];
    $pname = $_REQUEST['pname'];
    $color = $_REQUEST['color'];
    $category = $_REQUEST['category'];
    $sname = $_REQUEST['sname'];
    $psize = $_REQUEST['psize'];
    $price = $_REQUEST['price'];

    $sid = 0;
    $sql5 = "SELECT * FROM `suppliers` WHERE `sname` = '$sname'";
    $result2 = mysqli_query($conn,$sql5);
    if (mysqli_num_rows($result2)) { // case that supplier exists
        $sqlfetch = mysqli_fetch_row($result2);
        $sid = $sqlfetch[0];
    } else {
        $sql6 = "INSERT INTO `suppliers` (`sname`) VALUES ('$sname');"; //adds supplier to list in case it does not exist
        mysqli_query($conn,$sql6);
        //$sql5 = "SELECT * FROM `suppliers` WHERE `sname` = '$sname'";
        $result2 = mysqli_query($conn,$sql5);
        $sqlfetch = mysqli_fetch_row($result2);
        $sid = $sqlfetch[0];
    }

    $sql2 = "SELECT * FROM `products` WHERE `pid` = 0";
    $result = mysqli_query($conn,$sql2);
    if (mysqli_num_rows($result)) {
        $info = "Product Already Exists!"; // case product exists already
    }else{ //adds product
        $sql = "INSERT INTO `products` (`pname`,`stock`,`price`,`category`,`sid`,`color`,`psize`) VALUES ('$pname','$stock','$price','$category','$sid','$color','$psize')";
        $check = mysqli_query($conn,$sql);
        if ($check) {
            $info = "Product Added!";
        }else{
            $info = "An error occurred!";
        }
    }
}


$sql1 = "SELECT category FROM `products` GROUP BY category"; //grab categories
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);
if (!empty($row)) {
    do {
        $show .= '
        <option value="'.$row['category'].'">'.$row['category'].'</option>';
    } while ($row = mysqli_fetch_assoc($result));
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
            Product Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Add Product
        </h2>
        <?php echo $info; ?>
        <div class="flex">
            <aside class="right">
                <form action="addproduct.php" method="post">
                    <table>
                        <td>Category:</td>
                            <td>
                                <input type="text" name="category" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Product Name:</td>
                            <td>
                                <input type="text" name="pname" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Stock:</td>
                            <td>
                            <input type="number" min="0" step="1" name="stock" required>
                            </td>
                        </tr>
                        <tr>
                            <td>List Price:</td>
                            <td>
                                <input type="number" min="0" step="0.01" name="price" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Supplier:</td>
                            <td>
                                <input type="text" name="sname" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Color:</td>
                            <td>
                                <input type="text" name="color" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Product Size:</td>
                            <td>
                                <input type="text" name="psize" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" name="add">Add Product</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <a href="productview.php">View Product List</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>