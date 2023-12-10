<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Property Details</title>
</head>
<body>

<?php
session_start();
require_once(__DIR__.'/connection.php');

$conn = getConnection();

echo "<a href='./dashboard.php'>Back</a>";

// Check if the property ID is provided in the URL
if (isset($_GET['id']) || isset($_POST['propertyId'])) {
    // $propertyId = $_GET['id'] || $_POST['propertyId'];
    $propertyId = $_GET['id'] == NULL ? $_POST['propertyId'] : $_GET['id'];

    // Fetch property data based on the property ID
    $sql = "SELECT * FROM properties WHERE id = $propertyId";
    $result = $conn->query($sql);
    $userId = $_SESSION["id"];

    $query = runQuery("SELECT * FROM wishlists WHERE user_id = '$userId' AND id = '$propertyId';");
    $results = $query -> fetch_assoc();
    // print_r($results);
    $buttonText = $results == NULL ? "Add to wishlist" : "Remove from wishlist";

    if($_POST['propertyId']) {
        if($results == NULL) {
            runQuery("
            INSERT INTO wishlists (id, user_id)
            VALUES ($propertyId, $userId);
            ");
            $buttonText = 'Remove from wishlist';
        } else {
            runQuery("
            DELETE FROM wishlists WHERE id = '$propertyId' AND user_id = '$userId'
            ");
            $buttonText = 'Add to wishlist';
        }
    }

    
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Display detailed information about the property
        echo '<div class="property-details">';
        echo '<img src="images/' . $row['imagePath'] . '" alt="' . $row['propertyName'] . '">';
        echo '<h2>' . $row['propertyName'] . '</h2>';
        echo '<p>Bedrooms: ' . $row['bedrooms'] . '</p>';
        echo '<p>Bathrooms: ' . $row['bathrooms'] . '</p>';
        echo '<p>Square Footage: ' . $row['squareFootage'] . ' sqft</p>';
        echo '<p>Price: $' . number_format($row['price'], 2) . '</p>';
        echo '<p>' . $row['description'] . '</p>';

        echo "<form method='post' action='./property_details.php'>";
        echo "<input type='hidden' value='$propertyId' name='propertyId' />";
        echo "<button type='submit'>$buttonText</button>";
        echo "</form>";
        
        echo '</div>';
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid request. Please provide a property ID.";
}

$conn->close();
?>

</body>
</html>
