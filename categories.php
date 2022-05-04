<?php
include('db_conn.php');
$info = $show = '';
if (isset($_REQUEST['add'])) { //request check
    $name = $_REQUEST['name'];
    $sql = "INSERT INTO `categories` (`categoryName`) VALUES ('$name')"; //insert category
    $check = mysqli_query($conn,$sql);
    if ($check) { //check success
        $info = "Category Added!";
    }else{
        $info = "An error occurred!";
    }
}

if (isset($_REQUEST['dlt_id'])) { //delete category
    $dlt_id = $_REQUEST['dlt_id'];
    $sql = "DELETE FROM `categories` WHERE `categoryID` = '$dlt_id'";
    $check = mysqli_query($conn,$sql);
    if ($check) {
        $sql1 = "DELETE FROM `products` WHERE `categoryID` = '$dlt_id'";
        $info = "Category Deleted!";
    }else{
        $info = "An error occurred!";
    }
}

$sql1 = "SELECT category FROM `products` GROUP BY category"; //grab categories
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);
if (!empty($row)) {
    do {
        $show .= '
        <tr>
            <td>'.$row['category'].'</td>
            <td><button onclick="location.href=\'categories.php?dlt_id='.$row['category'].'\';">Delete</button></td>
        </tr>';
    } while ($row = mysqli_fetch_assoc($result)); //loop through every category and display with delete button
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
</head>

<body>
    <header>
        <h1>
            Product Manager
        </h1>
    </header>
    <main>
        <h2 class="page_title">
            Category List
        </h2>
        <div class="flex">
            <aside class="right">
                <?php echo $info; ?>
                <table class="list">
                    <tr>
                        <th>Name</th>
                        <td></td>
                    </tr>
                    <?php echo $show; ?>
                </table>
                <h2 class="title">
                    Add Category
                </h2>
                <form action="categories.php" method="post">
                    <table>
                        <tr>
                            <td>Name:</td>
                            <td>
                                <input type="text" name="name" required>
                            </td>
                            <td>
                                <button type="submit" name="add">Add</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <a href="index.php">View Product List</a>
            </aside>
        </div>
    </main>
    <footer>
        <p>&copy; 2022 My Guitar Shop, Inc</p>
    </footer>
</body>

</html>