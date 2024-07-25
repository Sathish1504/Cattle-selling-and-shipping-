<?php
	session_start();
    if($_SESSION["logged"]!="seller")
    header("location: auction.php");
	$name=$_SESSION['Name'];
	echo "<title>Welcome $name</title>";
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .container {
      max-width: 800px;
      margin: 70px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    form {
      margin-top: 20px;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="date"],
    textarea {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background-color: #45a049;
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
    <li><a class="active" href="Seller_portal.php">Add Product</a></li>
    <li><a href="Seller_orders.php">My Orders</a></li>
    <li><a href="MyProducts.php">My Products</a></li>
    <li><a href="auction.php">Logout</a></li>
  </ul>
  <div class="container">
    <form name="add_product" method="POST" action="landing_page.php">
      <label for="name">Name of your Product:</label>
      <input type="text" id="name" name="name" required><br>
      <label for="minbid">Minimum Bid:</label>
      <input type="text" id="minbid" name="minbid" required><br>
      <label for="maxbid">Maximum Bid:</label>
      <input type="text" id="maxbid" name="maxbid" required><br>
      <label for="qty">Quantity Available:</label>
      <input type="text" id="qty" name="qty" required><br>
      <label for="desc">Item Description:</label>
      <textarea id="desc" name="desc" rows="4" required></textarea><br>
      <label for="expiry">Expiry Date:</label>
      <input type="date" id="expiry" name="expiry" required><br>
      <button type="submit" name="submit" value="1">Add Product</button>
    </form>
  </div>
</body>
</html>
