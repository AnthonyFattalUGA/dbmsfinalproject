<!doctype HTML>
<html lang="english">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Manager</title>
	<link rel="stylesheet" href="dtstyle.css">
	<link rel="stylesheet" href="formstyle.css">	
</head>

<body>
	<div class = "page-title-container">
		<h1 class = "page-title">Dank Threads</h1>
	</div>
	<table> 
		<tr>
			<td>View Products</td>
			<td>
				<button onclick = "location.href = 'productview.php';" id = product_button class = "productbutton"> HERE</button>
			</td>
		</tr>
		<tr>
			<td>View Orders</td>
			<td>
				<button onclick = "location.href = 'orderview.php';" id = order_button class = "orderbutton"> HERE</button>
			</td>
		</tr>
		<tr>
			<td>View Customers</td>
			<td>
				<button onclick = "location.href = 'customerview.php';" id = customer_button class = "customerbutton"> HERE</button>
			</td>
		</tr>
		<tr>
			<td>View Employees</td>
			<td>
				<button onclick = "location.href = 'employeeview.php';" id = employee_button class = "employeebutton"> HERE</button>
			</td>
		</tr>
	</table>
</body>