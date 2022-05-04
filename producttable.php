<?php

$sql3 = "SELECT *, suppliers.sname FROM `products` inner join suppliers where products.sid=suppliers.sid and pid=".$_REQUEST["pid"].";";

$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);

echo '
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
    </tr>
    <tr>
        <td>'.$row3['pid'].'</td>
        <td>'.$row3['pname'].'</td>
        <td>'.$row3['stock'].'</td>
        <td>'.$row3['price'].'</td>
        <td>'.$row3['category'].'</td>
        <td>'.$row3['sname'].'</td>
        <td>'.$row3['color'].'</td>
        <td>'.$row3['psize'].'</td>
    </tr>
</table>';

?>