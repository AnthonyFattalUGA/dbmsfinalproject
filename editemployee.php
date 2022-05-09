<?php
include('db_conn.php');
$info = $show2 = $show1 = '';
if (isset($_REQUEST['dlt_id'])) { //delete action
	$dlt_id = $_REQUEST['dlt_id'];
	$sql = "DELETE FROM `employees` WHERE `eid` = '$dlt_id'";
	$check = mysqli_query($conn,$sql); // check query to ensure good
	if ($check) { //product found
		$sql2 = "DELETE FROM `employees` WHERE `eid` = '$dlt_id'";
		$info = "Employee Deleted!";
	}else{
		$info = "An error occurred!";
	}
}

$sql2='';
if (isset($_REQUEST["edit_eid"])) {//$tango != "") { //query for products in specified category
	$editeid = $_REQUEST["edit_eid"];
	$sql2 = "SELECT * FROM `employees` where `eid` = '$editeid'"; 
	$result3 = mysqli_query($conn,$sql2);
	$row3 = mysqli_fetch_assoc($result3);
}
$ename = ''; //init variables for later usage
$eid = 0;
$phone_number = '';
$email = '';
$result1 = mysqli_query($conn,$sql2);
$row1 = mysqli_fetch_assoc($result1);
if (!empty($row1)) {// will list original values
	$eid = $row1['eid'];
	$ename = $row1['ename'];
	$phone_number = $row1['phone_number'];
	$email = $row1['email'];
	do {
		$show2 .= '
		<tr>
			<td>Current</td>
			<td>'.$eid.'</td>
			<td>'.$ename.'</td>
			<td>'.$phone_number.'</td>
			<td>'.$email.'</td>
			</tr>';
	} while ($row1 = mysqli_fetch_assoc($result1));
}

if (isset($_REQUEST['edit'])) { //add product query
    if (isset($_REQUEST['ename']) ) {
        $newname = $_REQUEST['ename'];

        $sql7 = "UPDATE `employees` SET `ename` = '$newname' WHERE `employees`.`eid` = $eid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Employee Updated";
    }
    if (isset($_REQUEST['phone_number'])) {
        $newphone_number = $_REQUEST['phone_number'];

        $sql7 = "UPDATE `employees` SET `phone_number` = '$newphone_number' WHERE `employees`.`eid` = $eid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Employee Updated";
    }
	if (isset($_REQUEST['email'])) {
        $new_email = $_REQUEST['email'];

        $sql7 = "UPDATE `employees` SET `email` = '$new_email' WHERE `employees`.`eid` = $eid; ";
        $result2 = mysqli_query($conn,$sql7);

        $info = "Employee Updated";
    }
    header('Location:editemployee.php?edit_eid='.$eid);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employee Manager</title>
	<link rel="stylesheet" href="dtstyle.css">
	<link rel="stylesheet" href="formstyle.css">
</head>

<body>
	<header>
		<h1>
			Employee Manager
		</h1>
	</header>
	<main>
		<h2 class="page_title">
			Employee List
		</h2>
		<div class="flex">
			<aside class="left">
				<h3 class="title"><a href="employeeview.php">Employee Home</a></h3>
				<ul class="nav">
					<?php //echo $show1; ?>
				</ul>
			</aside>
			<aside class="right">
				<h1><?php //echo $tango ?></h1>
			<h3 class="title"><?php 
					echo "Edit : ".$ename;
			?>
			</h3>
				<?php echo $info; ?>
				<table class="list">
					<tr>
						<th></th>
						<th>Employee id</th>
						<th>Employee name</th>
						<th>Phone number</th>
						<th>Email</th>
						<th></th>
					</tr>
					<!---still need to change--->
					<?php echo $show2; ?>
					<form method="post">
						<tr>
							<td>New</td>
							<td><?php echo $eid; ?></td>
							<td><input type="text" value="<?php echo $ename; ?>" name="ename"></td>
							<td><input type="tel" value="<?php echo $phone_number; ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone_number"></td>
							<td><input type="email" value="<?php echo $email; ?>" name="email"></td>
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