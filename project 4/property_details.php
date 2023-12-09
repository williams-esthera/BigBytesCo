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
$host = "localhost";
$user = "zsirajo1";
$pass = "zsirajo1";
$dbname = "zsirajo1";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the property ID is provided in the URL
if (isset($_GET['id'])) {
    $propertyId = $_GET['id'];

    // Fetch property data based on the property ID
    $sql = "SELECT * FROM properties WHERE id = $propertyId";
    $result = $conn->query($sql);

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
