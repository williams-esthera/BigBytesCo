<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Property Listings</title>

    <style>
          header {
            width:100%;
            height: 50px; /* Set the height to 20% of the viewport height */
            background-color: #333; /* Add your preferred background color */
            /*text-align: right; /* Center the content */
            padding: 10px; /* Add padding as needed */
            display:inline;
            vertical-align: baseline;
        }
        #logout{
            width: 100px;
            height:50px;
        }
        button{
            width:100px;
            height:50px;
        }

        #nav{
            display: inline;
            float: right;
            vertical-align: middle;
        }

        #welcome{
            display: inline-block;
            text-align: left;
            width: 50%;
            vertical-align: middle;
        }

        #searchbar{
            display: block;
            width: 100%;
            text-align: center;
        }

    </style>
</head>

<header>
    <div id="welcome">
        <?php
        session_start();
        /*$user_id = $_SESSION["user_id"];
        echo "<h2>Welcome: $user_id</h2>" ;*/
        
            // Check if the user is logged in
            if(isset($_SESSION['user_id'])) {
                // Display user's first and last name
                echo "<p style='color:white;'>Welcome, ".$_SESSION['firstName']." ".$_SESSION['lastName']." (This is a " . $_SESSION['userType'].  " account)"."</p>";
                //Display User Type
                //echo "This is a " . $_SESSION['userType'].  " account";
            } else {
                // If user is not logged in, redirect to login page
                header("Location: login.html");
                exit;
            }
        ?>
    </div>
    <div id="nav">
        <!--<a href="propertyCards.php"><h1>Buyer Dashboard</h1></a>-->
        <button><a href='./wishlist.php'>Wishlist</a></button>
        <button><a href ="home.html">Home</a></button>
        <form action="logout.php" method="POST" >
        <input type="submit" value="Logout" id ="logout">
        </form> 

    </div>        
</header>
<body>


<!-- Search Form -->
<form id="searchbar" method="GET" action="">
    <input type="text" name="search" placeholder="Search by property name, type, description, or square footage">
    <button type="submit">Search</button>
</form>

<br>


<?php

require_once(__DIR__.'/connection.php');
// Create Connection
$conn = getConnection();

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

runQuery($createTableSql);

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
                echo '<img src="images/' . $row['imagePath'] . '" alt="' . $row['propertyName'] . '">';
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

