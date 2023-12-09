<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Property Listings</title>
</head>
<body>


<a href="propertyCards.php"><h1>Buyer Dashboard</h1></a>

<!-- Search Form -->
<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by property name, type, description, or square footage">
    <button type="submit">Search</button>
</form>


<?php
session_start();
$user_id = $_SESSION["user_id"];
echo "<h2>Welcome: $user_id</h2>" ;



$host = "localhost";
$user = "zsirajo1";
$pass = "zsirajo1";
$dbname = "zsirajo1";


// Create Connection

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$createTableSql = "CREATE TABLE IF NOT EXISTS properties (
    id INT PRIMARY KEY,
    propertyName VARCHAR(255),
    propertyType VARCHAR(50),
    bedrooms INT,
    bathrooms INT,
    squareFootage INT,
    price DECIMAL(18, 2),
    imagePath VARCHAR(255),
    description TEXT
)";

// Check if a search query is provided
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';


// Add data to table if not already there

$insertDataSql = "INSERT IGNORE INTO properties (id, propertyName, propertyType, bedrooms, bathrooms, squareFootage, price, imagePath, description)
VALUES
    (1, 'Luxury Villa', 'Single Family', 5, 5, 6000, 1500000.00, 'property1.jpeg', 'A luxurious villa with a beautiful view.'),
    (2, 'Modern Apartment', 'Apartment', 2, 2, 1200, 300000.00, 'property2.jpeg', 'A modern apartment in the heart of the city.'),
    (3, 'Cozy Cottage', 'Single Family', 3, 2, 1800, 450000.00, 'property3.jpeg', 'A charming cottage with a spacious garden.'),
    (4, 'Beachfront Condo', 'Condo', 1, 1, 800, 250000.00, 'property4.jpeg', 'A cozy condo with a stunning view of the beach.'),
    (5, 'Mountain Retreat', 'Single Family', 4, 3, 2000, 500000.00, 'property5.jpeg', 'A peaceful retreat nestled in the mountains.'),
    (6, 'Urban Loft', 'Apartment', 3, 2, 1500, 400000.00, 'property6.jpeg', 'A modern loft with an urban vibe in the city center.'),
    (7, 'Rural Farmhouse', 'Single Family', 3, 2, 1800, 350000.00, 'property7.jpeg', 'A charming farmhouse in a tranquil rural setting.'),
    (8, 'Lakefront Cabin', 'Single Family', 2, 1, 1200, 300000.00, 'property8.jpeg', 'A charming cabin with a view of the lake.'),
    (9, 'Suburban Mansion', 'Single Family', 6, 5, 6000, 1500000.00, 'property9.jpeg', 'A grand mansion in a peaceful suburban neighborhood.'),
    (10, 'Garden Townhouse', 'Townhouse', 4, 2, 1800, 450000.00, 'property10.jpeg', 'A townhouse with a beautiful garden and patio'),
    (11, 'Seaside Villa', 'Single Family', 4, 3, 2200, 600000.00, 'property11.jpeg', 'A beautiful villa with direct access to the seaside.'),
    (12, 'Downtown Loft', 'Apartment', 1, 1, 900, 200000.00, 'property12.jpeg', 'A stylish loft located in the heart of the downtown area.');
";



if($conn->query($insertDataSql) === TRUE) {

    // Fetch property data from the database based on the search query
    $sql = "SELECT * FROM properties 
        WHERE propertyName LIKE '%$searchQuery%' 
           OR propertyType LIKE '%$searchQuery%' 
           OR description LIKE '%$searchQuery%'
           OR squareFootage LIKE '%$searchQuery%'
           ";
           
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            
                echo '<a href="property_details.php?id=' . $row['id'] . '" class="property-card">';
                echo '<img src="' . $row['imagePath'] . '" alt="' . $row['propertyName'] . '">';
                echo '<h2>' . $row['propertyName'] . '</h2>';
                echo '<p>Type: ' . $row['propertyType'] . '</p>';
                echo '<p>Bedrooms: ' . $row['bedrooms'] . '</p>';
                echo '<p>Bathrooms: ' . $row['bathrooms'] . '</p>';
                echo '<p>Square Footage: ' . $row['squareFootage'] . ' sqft</p>';
                echo '<p>Price: $' . number_format($row['price'], 2) . '</p>';               
                // Close the link with the </a> tag
                echo '</a>';
          
        }
    } else {
        echo "No properties found.";
    }

} else {
    echo "Error creating table: " . $conn->error;
}


?>





</body>
</html>

