<?php

$sql4 = "SELECT * FROM `customers` where cid=".$_REQUEST["cid"].";"; //make table with all customers and info

$result4 = mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_assoc($result4);

echo '
<table class="list">
    <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Zip Code</th>
        <th>Phone</th>
        <th>Email</th>
    </tr>
    <tr>
        <td>'.$row4['cid'].'</td>
        <td>'.$row4['cname'].'</td>
        <td>'.$row4['zip'].'</td>
        <td>'.$row4['phone_number'].'</td>
        <td>'.$row4['email'].'</td>
    </tr>
</table>';
?>