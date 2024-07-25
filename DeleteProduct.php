<?php
	session_start();
	$name=$_SESSION['Name'];
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
	$pid=$_POST['Delete'];
	
	// Delete the product from the database
	$query = "DELETE FROM product WHERE productId=$pid;";
	$result = mysqli_query($db, $query);

	if ($result) {
		echo "Product deleted successfully";
	} else {
		echo "Error deleting product: " . mysqli_error($db);
	}

	// Redirect back to the product page
	header("Location: MyProducts.php");
	exit();
?>
