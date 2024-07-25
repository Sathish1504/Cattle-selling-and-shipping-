
<?php
	session_start();
    if($_SESSION["logged"]!="buyer") {
        header("location: auction.php");
        exit(); // Ensure script stops execution after redirect
    }

    $pId = isset($_POST['NewBid']) ? $_POST['NewBid'] : -1;
    $_SESSION['pId'] = $pId;

	$name = $_SESSION['Name'];
	echo "<title> Complete Your Order, $name </title>";
	$db = mysqli_connect('localhost', 'root', '', 'auction') or die("connection failed");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Order, <?php echo $name; ?></title>
    <style>
        * {
            margin: 4px;
        }
        body {
            margin: 70px;
            font-family: sans-serif;
            background-color: powderblue;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        input[type='text'], textarea {
            background: #f2f2f2;
            border: none;
            border-radius: 5px;
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
        }
        input[type='radio'] {
            margin-right: 5px;
        }
        button[type='submit'] {
            background: #2196F3;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type='submit']:hover {
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
        <li><a class="active" href="Listings.php">Search Products</a></li>
        <li><a href="userOrders.php">My Orders</a></li>
        <li><a href="auction.php">Logout</a></li>
    </ul>

    <?php if($pId == -1): ?>
        <p>Product Expired</p>
        <form action="Listings.php">
            <button type="submit">Go Back</button>
        </form>
    <?php else: ?>
        <form method="get" action="newOrder.php">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Minimum Bid</th>
                    <th>Current Bid</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Seller</th>
                </tr>
                <?php
                $query = "SELECT * FROM product where productId=$pId;";
                $result = mysqli_query($db, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>'.$row['productName'].'</td>';
                    echo '<td>'.$row['minbid'].'</td>';

                    if($row['currBid'] == 0) {
                        echo '<td>NEW</td>';
                    } else {
                        echo '<td>'.$row['currBid'].'</td>';
                    }

                    $_SESSION['CB'] = $row['currBid'];
                    $_SESSION['MB'] = $row['maxbid'];
                    $_SESSION['MinBid'] = $row['minbid'];
                    $_SESSION['Q'] = $row['quantity'];

                    echo '<td>'.$row['descp'].'</td>';

                    if($row['quantity'] > 5) {
                        echo '<td>Available</td>';
                    } else if($row['quantity'] > 0) {
                        echo '<td>Few Left</td>';
                    } else {
                        echo '<td>Out of Stock</td>';
                    }

                    echo '<td>'.$row['sellerUsr'].'</td>';
                    $_SESSION['Seller'] = $row['sellerUsr'];
                    $_SESSION['pid'] = $row['productId'];
                }
                echo '</table>';
                echo "<br>";
                echo '</tr>';

                mysqli_close($db);
                ?>
            </table>
            <br>
            <input type="text" name="Bid" placeholder="Enter your Bid">
            <input type="text" name="Qty" placeholder="Enter Quantity">
            <textarea rows="4" columns="10" name="addr" placeholder="Enter Address"></textarea>
            <br>
            <label for="payment">Payment Method:</label>
            <input type="radio" name="payment" id="payment" checked>Cash On Delivery
            <br>
            <button type="submit" name="submit" value="4">Place Bid</button>
        </form>
    <?php endif; ?>
</body>
</html>
