<!DOCTYPE html>
<?php
  session_start();
  $_SESSION["logged"]="";
  $_SESSION["Name"]="";
  $db=mysqli_connect('localhost','root','','auction') or die("Connection Failed");
  if (isset($_GET["err"]) and $_GET["err"]==1)
      echo "Please Login";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login and More</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
      }

      .container {
        max-width: 400px;
        margin: 100px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      }

      .title {
        text-align: center;
        color: #333;
      }

      .form-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
      }

      .form-group {
        margin-bottom: 15px;
      }

      input[type="text"],
      input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      input[type="radio"] {
        margin-right: 5px;
      }

      label {
        color: #666;
      }

      button {
        width: 100%;
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      button:hover {
        background-color: #45a049;
      }

      .error {
        color: red;
        margin-top: 10px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="title">Auction/
      <a href="Front.html">Home</a></h1>
      <?php
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
          $usr=$_POST['usr'];
          $pass=$_POST['passwd'];
          if(isset($_POST['category']))
              $cat=$_POST['category'];

          $query="select username from users where username='$usr' and pass='$pass' and role='$cat';";
          $result=mysqli_query($db,$query) or die("failed");
          $count=mysqli_num_rows($result);
          if($count!=1)
          {
            $error="Wrong username, password, or category.";
          }
          else
          {
            $_SESSION["logged"]=$cat;
            $_SESSION["Name"]=$usr;
            if($cat=="buyer")
              header("location: Listings.php");
            else if($cat=="seller")
              header("location: Seller_portal.php");
            else
              header("location: svp.php");
          }
        }
       ?>
      <form id="login" method="post" action="">
        <p class="form-title">Log in</p>
        <div class="form-group">
          <input type="radio" name='category' value="buyer" id="buyer">
          <label for="buyer">Buyer</label>
        </div>
        <div class="form-group">
          <input type="radio" name='category' value="seller" id="seller">
          <label for="seller">Seller</label>
        </div>
        <div class="form-group">
          <input type="radio" name='category' value="svp" id="svp">
          <label for="svp">Service Provider</label>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Username" id='usr' name='usr' autofocus required>
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" id='passwd' name='passwd' required>
        </div>
        <?php
          if(isset($error) && !empty($error))
          {
            echo "<p class='error'> $error </p>";
          }
          mysqli_close($db);
         ?>
        <button type="submit" id='lgin'>Log In</button>
      </form>
    </div>
  </body>
</html>
