<?php
	session_start();
    if($_SESSION["logged"]!="seller")
    header("location: auction.php");
	$name=$_SESSION['Name'];
	echo "<title>Welcome $name</title>";
  $db=mysqli_connect('localhost','root','','auction');
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
      margin: 70px;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
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
    fieldset {
      margin-top: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      background-color: #fff;
    }
    form {
      display: inline-block;
    }
    select, input[type="submit"], button {
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      padding: 10px 20px;
      cursor: pointer;
      margin-right: 10px;
    }
    select {
      padding: 8px;
    }
    input[type="submit"]:hover, button:hover {
      background-color: #45a049;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    button[type="submit"] {
      background-color: #2196F3;
    }
    button[type="submit"]:hover {
      background-color: #0b7dda;
    }
  </style>
</head>
<body>
  <ul>
    <li><a href="Seller_portal.php">Add Product</a></li>
    <li><a class="active" href="Seller_orders.php">My Orders</a></li>
    <li><a href="MyProducts.php">My Products</a></li>
    <li><a href="auction.php">Logout</a></li>
  </ul>
  <fieldset>
    <form method="post" action="Seller_orders.php">
      <select name="filter">
        <option value="ALL">All Orders</option>
        <option value="Sat">Satisfied</option>
        <option value="UnSat">Unsatisfied</option>
      </select>
      <input type="submit" value="Filter">
    </form>
  </fieldset>
  <fieldset>
    <form name="myorders" method="POST" action="Finalize.php">
      <table>
        <tr>
          <th>Order Id</th>
          <th>Product Id</th>
          <th>Buyer Name</th>
          <th>Bid</th>
          <th>Quantity</th>
          <th>Address</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        if ($filter == "ALL" || !isset($_POST['filter'])) {
          $query = "SELECT * FROM orders WHERE SellerUsr='$name';";
        } elseif ($filter == "Sat") {
          $query = "SELECT * FROM orders WHERE SellerUsr='$name' AND status=1;";
        } elseif ($filter == "UnSat") {
          $query = "SELECT * FROM orders WHERE SellerUsr='$name' AND status=0;";
        }

        $result = mysqli_query($db, $query) or die("Query Failed");

        while ($row = mysqli_fetch_array($result)) {
          echo '<tr>';
          echo '<td>' . $row['OrderId'] . '</td>';
          echo '<td>' . $row['productId'] . '</td>';
          echo '<td>' . $row['BuyerUsr'] . '</td>';
          echo '<td>' . $row['Amount'] . '</td>';
          echo '<td>' . $row['Quantity'] . '</td>';
          echo '<td>' . $row['Address'] . '</td>';
          echo '<td>' . ($row['status'] == 0 ? 'Not Sold' : 'Sold') . '</td>';
          echo '<td><button type="submit" name="Final" value="' . $row['OrderId'] . '">Finalize</button></td>';
          echo '</tr>';
          }
          ?>
          </table>
          </form>
          
            </fieldset>
          </body>
          </html>
