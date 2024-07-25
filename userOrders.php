<?php
	session_start();
    if($_SESSION["logged"]!="buyer")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title>Welcome $name</title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
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
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    .header {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }
    .header h1 {
      margin: 0;
    }
    .nav {
      background-color: #444;
      overflow: hidden;
      border-radius: 10px;
      margin-top: 20px;
    }
    .nav a {
      float: left;
      display: block;
      color: #fff;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .nav a:hover {
      background-color: #555;
    }
    .nav a.active {
      background-color: #4CAF50;
    }
    .content {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    tr:hover {
      background-color: #f5f5f5;
    }
    button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 8px 16px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>My Orders</h1>
  </div>
  <div class="nav">
    <a href="Front.html">Home</a>
    <a href="Listings.php">Search Products</a>
    <a class="active" href="userOrders.php">My Orders</a>
    <a href="auction.php">Logout</a>
  </div>
  <div class="content">
    <table>
      <tr>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Seller Name</th>
        <th>Bid</th>
        <th>Quantity</th>
        <th>Address</th>
        <th>Status</th>
      </tr>
      <?php
      $query="SELECT * FROM orders where BuyerUsr='$name';";
      mysqli_query($db,$query) or die("Query Failed");
      $result=mysqli_query($db,$query);
      while($row=mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row['OrderId'].'</td>';
        echo '<td>'.$row['productId'].'</td>';
        echo '<td>'.$row['SellerUsr'].'</td>';
        echo '<td>'.$row['Amount'].'</td>';
        echo '<td>'.$row['Quantity'].'</td>';
        echo '<td>'.$row['Address'].'</td>';
        if ($row['status']==0)
          echo '<td>Not Confirmed</td>';
        else
          echo '<td>Confirmed</td>';
        echo '</tr>';
      }
      ?>
    </table>
    <form action="Listings.php">
      <button type="submit">Go Back</button>
    </form>
  </div>
</div>
</body>
</html>
