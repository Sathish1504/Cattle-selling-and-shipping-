<?php
	session_start();
  if($_SESSION["logged"]!="buyer")
    header("location: auction.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auction Home</title>
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
<div class="header">
  <h1>Auction</h1>
</div>
<div class="container">
  <div class="nav">
    <a href="#" class="active">Home</a>
    <a href="Listings.php">Search Products</a>
    <a href="userOrders.php">My Orders</a>
    <a href="auction.php">Login</a>
  </div>
  <div class="content">
    <form method="POST" action="newOrder.php">
      <table>
        <tr>
          <th>Product Name</th>
          <th>Minimum Bid</th>
          <th>Current Bid</th>
          <th>Description</th>
          <th>Stock</th>
          <th>Seller</th>
          <th>Time Left</th>
          <th>Action</th>
        </tr>
        <?php
        $query="SELECT * FROM product;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['productName'].'</td>';
          echo '<td>'.$row['minbid'].'</td>';
          if($row['currBid']==0)
            echo '<td>NEW</td>';
          else
            echo '<td>'.$row['currBid'].'</td>';
          echo '<td>'.$row['descp'].'</td>';
          if($row['quantity']>5)
            echo '<td>Available</td>';
          else if($row['quantity']>0)
            echo '<td>Few Left</td>';
          else
            echo '<td>Out of Stock</td>';
          echo '<td>'.$row['sellerUsr'].'</td>';
          $d1=date_create($row['expiry']);
          $d2=date_create(date('d-m-Y'));
          $diff=date_diff($d2,$d1);
          if($diff->format("%R%a")<0){
            echo '<td>Expired</td>';
            $row['productId']=-1;
          }
          else if($diff->format("%R%a")==0)
            echo '<td>Last Day</td>';
          else
            echo '<td>'.$diff->format("%a").' days left</td>';
          $_SESSION['timeleft']=$diff->format("%a");
          echo "<td><button type='submit' name='NewBid' value=".$row['productId'].">Bid</button></td>";
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        ?>
      </form>
  </div>
</div>
</body>
</html>
