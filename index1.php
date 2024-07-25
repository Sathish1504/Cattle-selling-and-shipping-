<!DOCTYPE html> 
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title> Cattle Selling and Shipping </title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);
    
    .table-container {
        overflow-x: auto;
    }
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .styled-table th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
        text-transform: uppercase;
    }
    .styled-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .styled-table tbody tr:hover {
        background-color: #f2f2f2;
    }
    .styled-table tbody td img {
        max-width: 100px;
        max-height: 100px;
        border-radius: 50%;
    }

    html,body{
      background: #f2f2f2;
      font-family: 'Open Sans', sans-serif;
      margin: 0; /* Added to remove default body margin */
      padding: 0; /* Added to remove default body padding */
      height: 100vh;
      overflow-y: auto;
    }

    .search {
      width: 75%;
      position: fixed; /* Changed to fixed */
      top: 15; /* Changed to 0 */
      display: flex;
      background-color: #fff; /* Added background color */
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Added box shadow */
      z-index: 999; /* Added z-index to ensure it's above other content */
    }

    .searchTerm {
      width: calc(100% - 50px); /* Adjusted width to accommodate the button */
      border: 3px solid #00B4CC;
      border-right: none;
      padding: 5px;
      height: 36px; /* Adjusted height to match button */
      border-radius: 5px 0 0 5px;
      outline: none;
      color: #9DBFAF;
      font-size: 16px; /* Adjusted font size */
    }

    .searchButton {
      width: 50px; /* Adjusted width */
      height: 33px;
      border: none; /* Removed border */
      background: #00B4CC url('search.jpg') no-repeat center; /* Add the image URL here */
      background-size: 100%; /* Adjust the size of the background image */
      text-align: center;
      color: #fff;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 0; /* Set font size to 0 to hide any potential text */
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="logo_content">
    <div class="logo">
      <div class="logo_name">Cattle Bovine</div>
    </div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav_list">
    <li>
      <i class='bx bx-search'></i>
      <input type="text" placeholder="Search...">
      <span class="tooltip">Search</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Home</span>
      </a>
      <span class="tooltip">Home</span>
    </li>
    <li>
      
         </div>
  </div>
</div>
<div class="home_content">
  <h1>Cattle Breeds</h1>  
  <div class="wrap">
    <div class="search">
      <input type="text" id="searchTerm" class="searchTerm" placeholder="What are you looking for?">
      <button type="button" id="searchButton" class="searchButton" onclick="search()">
        <i class="fa fa-search"></i>
      </button>
    </div>
<br><br>
    <div>
      <input type="checkbox" id="byBreed" name="byBreed">
      <label for="byBreed">By Breed Name</label>
    </div>
    <div>
      <input type="checkbox" id="byCountry" name="byCountry">
      <label for="byCountry">By Country</label>
    </div>
    <div>
      <input type="checkbox" id="bySubspecies" name="bySubspecies">
      <label for="bySubspecies">By Subspecies</label>
    </div>
  </div>
  <br>
  <div id="breedsTable">
</div>
<center><h2>List of Cattle Breeds All Over World</h2></center><br>
<?php
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "cattledb2"; // Replace with your database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the table
$sql = "SELECT `COL 1`,`COL 2`,`COL 3`, `COL 4`,`COL 5`, `COL 6`, `COL 8` FROM cattle_breeds_1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row in a table
  echo "<div class='table-container'><table class='styled-table'><thead><tr><th>Breed</th><th>Subspecies</th><th>Country/Region of Origin</th><th>Meat</th><th>Dairy</th><th>Draught</th><th>Image</th></tr></thead><tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["COL 1"] . "</td><td>" . $row["COL 2"] . "</td><td>" . $row["COL 3"] . "</td><td>" . $row["COL 4"] . "</td><td>" . $row["COL 5"] . "</td><td>" . $row["COL 6"] . "</td><td><a href='" . $row["COL 8"] . "' target='_blank'><img src='" . $row["COL 8"] . "' alt='Image'></a></td></tr>";
}
echo "</tbody></table></div>";

} else {
    echo "No results found";
}
// Close connection
$conn->close();
?>

</div>
<script src="main.js"></script>
<script>
function search() {
    var searchTerm = document.getElementById('searchTerm').value;
    var byBreed = document.getElementById('byBreed').checked;
    var byCountry = document.getElementById('byCountry').checked;
    var bySubspecies = document.getElementById('bySubspecies').checked;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("breedsTable").innerHTML = this.responseText;
        }
    };

    var url = "search.php?searchTerm=" + encodeURIComponent(searchTerm);
    if (byBreed) {
        url += "&byBreed=true";
    }
    if (byCountry) {
        url += "&byCountry=true";
    }
    if (bySubspecies) {
        url += "&bySubspecies=true";
    }
    
    xhr.open("GET", url, true);
    xhr.send();
}

</script>
</body>
</html>
