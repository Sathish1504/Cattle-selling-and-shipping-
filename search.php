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

if (isset($_GET['searchTerm'])) {
    // Sanitize the input to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_GET['searchTerm']);

    // SQL query to fetch data based on the search term
    $sql = "SELECT `COL 1`,`COL 2`,`COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 8` FROM cattle_breeds_1 WHERE ";

    // Initialize a variable to track if any condition is added
    $conditions = array();

    // Check if searching by breed name
    if (isset($_GET['byBreed'])) {
        $conditions[] = "`COL 1` LIKE '%$searchTerm%'";
    }

    // Check if searching by country
    if (isset($_GET['byCountry'])) {
        $conditions[] = "`COL 3` LIKE '%$searchTerm%'";
    }

    // Check if searching by subspecies
    if (isset($_GET['bySubspecies'])) {
        $conditions[] = "`COL 2` LIKE '%$searchTerm%'";
    }

    // Combine all conditions with OR operator
    if (!empty($conditions)) {
        $sql .= implode(" OR ", $conditions);
    } else {
        // If no conditions are provided, return all results
        $sql .= "1"; // This condition is always true
    }

    $result = $conn->query($sql);






    if ($result->num_rows > 0) {
     
echo "<div class='table-container'><table class='styled-table'><thead><tr><th>Breed</th><th>Subspecies</th><th>Country/Region of Origin</th><th>Meat</th><th>Dairy</th><th>Draught</th><th>Image</th></tr></thead><tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["COL 1"] . "</td><td>" . $row["COL 2"] . "</td><td>" . $row["COL 3"] . "</td><td>" . $row["COL 4"] . "</td><td>" . $row["COL 5"] . "</td><td>" . $row["COL 6"] . "</td><td><a href='" . $row["COL 8"] . "' target='_blank'><img src='" . $row["COL 8"] . "' alt='Image'></a></td></tr>";
}
echo "</tbody></table></div>";

    } else {
        echo "0 results";
    }
} else {
    echo "Search term not provided.";
}

// Close connection
$conn->close();
?>
