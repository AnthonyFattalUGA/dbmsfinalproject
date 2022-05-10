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



$supplier_id = '';

if (isset($_REQUEST["category"])) {//$tango != "") { //query for products in specified category
    $cat_id = $_REQUEST["category"];
    $sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where `category` = '$cat_id' and products.sid=suppliers.sid;"; 
    $sql3 = "SELECT category FROM `products` WHERE `category` = '$cat_id'";
    if (isset($_REQUEST["supplier"])) {
        $supplier_id = $_REQUEST["supplier"];
        $sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where `category` = '$cat_id' and `sname` = '$supplier_id' and products.sid=suppliers.sid;"; 
        $sql3 = "SELECT category FROM `products` WHERE `category` = '$cat_id'";
    }
    $result3 = mysqli_query($conn,$sql2);
    $row3 = mysqli_fetch_assoc($result3);
    if (isset($_REQUEST["supplier"])) {
        $title = "Category: ".$_REQUEST["category"]." Supplier: ".$_REQUEST["supplier"];
    } else {
        $title = "Category: ".$_REQUEST["category"];
    }
} else if (isset($_REQUEST["supplier"])) {
    $supplier_id = $_REQUEST["supplier"];
    $sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where `sname` = '$supplier_id' and products.sid=suppliers.sid;"; 
    $sql3 = "SELECT category FROM `products`;";
    $result3 = mysqli_query($conn,$sql2);
    $row3 = mysqli_fetch_assoc($result3);
    $title = "Supplier: ".$_REQUEST["supplier"];
} else {
    $sql2 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where products.sid=suppliers.sid; ";
    $title = "All Products";
}


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
            <td><button onclick="location.href=\'editproduct.php?edit_pid='.$row1['pid'].'\';">edit</button></td>
            <td><button onclick="location.href=\'productview.php?dlt_id='.$row1['pid'].'\';">Delete</button></td>
        </tr>';
    } while ($row1 = mysqli_fetch_assoc($result1));
}

$catddquery="SELECT category FROM `products` GROUP BY category";
$categorylistdd=mysqli_query($conn,$catddquery);
$ddcat = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

$supplierddquery="SELECT suppliers.sname FROM `products` inner join suppliers where products.sid=suppliers.sid group by suppliers.sname;";
$supplierlistdd=mysqli_query($conn,$supplierddquery);
$ddsupplier = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

if (isset($_POST['categorydd'])) {
    if ($_POST['categorydd'] == "none"){
        if (isset($_POST['supplierdd'])  && $_POST['supplierdd']!= "none") {
            header('Location:productview.php?supplier='.$_REQUEST['supplierdd']);
        }else{
        header('Location:productview.php');
        }
    }
    else if (isset($_POST['supplierdd'])  && $_POST['supplierdd']!= "none") {
        header('Location:productview.php?category='.$_REQUEST['categorydd'].'&supplier='.$_REQUEST['supplierdd']);
    } else {
        header('Location:productview.php?category='.$_REQUEST['categorydd']);
    }
} else if (isset($_POST['supplierdd'])  && $_POST['supplierdd']!= "none") {
    if ($_POST['supplierdd'] == "none") {
        header('Location:productview.php');
    } else {
        header('Location:productview.php?supplier='.$_REQUEST['supplierdd']);
    }
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
            Product List
        </h2>
        <div class="flex">
            <aside class="left">
                <h3 class="title"><a href="productview.php">Product Home</a></h3>
                <h3 class="title"><a href="index.php">Home Page</a></h3>
                <ul class="nav">
                    <?php //echo $show1; ?>
                </ul>
            </aside>
        <form method="post">
            <aside class="left">
                <p>Choose category</p>
                <select name="categorydd" id="czsfgdrgategorydd">
                <option value="none">all</option>
                    <?php foreach ($categorylistdd as $currentcategory):?>
                        <option value="<?php echo $currentcategory['category']?>"><?php echo $currentcategory['category']?></option>
                    <?php endforeach; ?>
                </select>
            </aside>
            <aside class="left">
            <p>Choose supplier</p>
                <select name="supplierdd" id="suppliersedjgnwegdd">
                    <option value="none">all</option>
                    <?php foreach ($supplierlistdd as $currentsupplier):?>
                        <option value="<?php echo $currentsupplier['sname']?>"><?php echo $currentsupplier['sname']?></option>
                    <?php endforeach; ?>
                </select>
                <button id="submit" name="submit" type="submit" value="Search"></button>
            </aside>
        </form>
            <aside class="right">
                <h1><?php //echo $tango ?></h1>
            <h3 class="title"><?php 
                if (isset($_REQUEST["category"])) {
                    if (isset($_REQUEST["supplier"])) {
                        echo "Category: ".$_REQUEST["category"]."<br>";
                        echo "Supplier: ".$_REQUEST["supplier"];
                    } else {
                        echo "Category: ".$_REQUEST["category"];
                    } 
                } else if (isset($_REQUEST["supplier"])) {
                    echo "Supplier: ".$_REQUEST["supplier"];
                } else {
                    echo "All Products";
                }
            ?>
            </h3>
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
                        <th></th>
                    </tr>
                    <?php echo $show2; ?>
                </table>
                <a href="addproduct.php">Add Product</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 Dank Threads, Inc</p>
    </footer>
</body>

</html>
