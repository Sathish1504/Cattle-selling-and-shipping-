<?php
session_start();
if ($_SESSION["logged"] != "seller") {
    header("location: auction.php");
    exit(); // Ensure script stops execution after redirect
}
$name = $_SESSION['Name'];
echo "<title> Welcome $name </title>";
$db = mysqli_connect('localhost', 'root', '', 'auction');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		* {
        	margin: 4px;
        	padding: 0;
    	}
    	body {
        	margin: 70px;
        	font-family: sans-serif;
        	background-color: white;
    	}
    	table {
        	border-collapse: collapse;
        	width: 100%;
    	}
    	th, td {
        	border: 1px solid #ddd;
        	padding: 8px;
        	text-align: left;
    	}
    	th {
        	background-color: #4CAF50;
        	color: white;
    	}
    	tr:nth-child(even) {
        	background-color: #f2f2f2;
    	}
    	input, button {
        	background: #2196F3;
        	border: none;
        	color: #fff;
        	border-radius: 5px;
        	padding: 8px 16px;
        	cursor: pointer;
        	transition: background-color 0.3s;
    	}
    	input[type="submit"]:hover, button:hover {
        	background-color: #0b7dda;
    	}
    	ul {
        	list-style-type: none;
        	margin: 0;
        	padding: 0;
        	overflow: hidden;
        	background-color: #333;
        	position: fixed;
        	top: 0;
        	width: 100%;
    	}
    	li {
        	float: left;
    	}
    	li a {
        	display: block;
        	color: white;
        	text-align: center;
        	padding: 14px 16px;
        	text-decoration: none;
    	}
    	li a:hover:not(.active) {
        	background-color: #111;
    	}
    	.active {
        	background-color: #4CAF50;
    	}
	</style>
</head>
<body>
	<ul>
		<li><a href="Seller_portal.php">Add Product</a></li>
		<li><a href="Seller_orders.php">My Orders</a></li>
		<li><a class="active"  href="MyProducts.php">My Products</a></li>
		<li><a href="auction.php">Logout</a><li>
	</ul>

	<fieldset>
		<table>
			<tr>
				<th>Product Id</th>
				<th>Product Name</th>
				<th>Minimum Bid</th>
				<th>Maximum Bid</th>
				<th>Current Bid</th>
				<th>Stock</th>
				<th>Description</th>
				<th>Time Left</th>
				<th>Action</th>
			</tr>
			<?php
			$query="SELECT * FROM product where sellerUsr='$name';";
			$result=mysqli_query($db,$query);
			while($row=mysqli_fetch_array($result)){
				echo '<tr>';
				echo '<td>'.$row['productId'].'</td>';
				echo '<td>'.$row['productName'].'</td>';
				echo '<td>'.$row['minbid'].'</td>';
				echo '<td>'.$row['maxbid'].'</td>';
				echo '<td>'.$row['currBid'].'</td>';
				echo '<td>'.$row['quantity'].'</td>';
				echo '<td>'.$row['descp'].'</td>';
				$d1=date_create($row['expiry']);
				$d2=date_create(date('d-m-Y'));

				$diff=date_diff($d2,$d1);

				if($diff->format("%R%a")<0){
					echo '<td>Expired<td>';
					$row['productId']=-1;
				}
				else if($diff->format("%R%a")==0)
					echo '<td>Last Day<td>';
				else
					echo '<td>'.$diff->format("%a").' days left<td>';
				
				// Delete button
				echo "<td> <form method='POST' action='DeleteProduct.php'>
						<input type='hidden' name='Delete' value='".$row['productId']."'>
						<button type='submit'>Delete</button>
					  </form> </td>";
				echo '</tr>';
			}
			mysqli_close($db);
			?>
		</table>
	</fieldset>
</body>
</html>
