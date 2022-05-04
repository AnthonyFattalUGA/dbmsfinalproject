<?php

$sql5 = "SELECT * FROM `employees` where eid=".$_REQUEST["eid"].";"; // grabs table for employee selected

$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_assoc($result5);

echo '
<table class="list">
    <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
    </tr>
    <tr>
        <td>'.$row5['eid'].'</td>
        <td>'.$row5['ename'].'</td>
        <td>'.$row5['phone_number'].'</td>
        <td>'.$row5['email'].'</td>
    </tr>
</table>';
?>