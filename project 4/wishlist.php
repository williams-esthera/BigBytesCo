<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Wishlist</title>
    <link rel = "stylesheet" href = "wishlist.css" />
</head>

<body>
    <?php 
    // Connection setup
    session_start();
    require_once(__DIR__.'/connection.php');
    $conn = getConnection();


    runQuery("CREATE TABLE IF NOT EXISTS wishlists (
        wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
        id INT NOT NULL,
        user_id INT NOT NULL,
    
        FOREIGN KEY(id) REFERENCES properties(id)
    );"
    );
    ?>


<header>
        <button><a href="dashboard.php">Back</button>
        <button><a href ="home.html">Home</a></button>
            
</header>

    <div class="wishlist-container">
        <h1>Your wishlist</h1>

        <?php 

        // Uses user id to fetch their wishlist
        $userId = $_SESSION['id'];
        $wishlistQuery = runQuery("SELECT * FROM wishlists WHERE user_id = '$userId';");

        $propertyIdToRemove = $_POST['propertyId'];
        if($propertyIdToRemove != NULL) {
            
            runQuery("
            DELETE FROM wishlists WHERE id = '$propertyIdToRemove' AND user_id = '$userId';
            ");
            echo "Successfully removed property id " . $propertyIdToRemove . " from wishlist.";
        }

        echo "<div class='properties'>";
        // Loops through wishlist
        if ($wishlistQuery -> num_rows > 0) {   
            while($row = $wishlistQuery -> fetch_assoc()) {
                // For each property in wishlist, runs a query to fetch its info
                $propertyId = $row['id'];
                if($propertyIdToRemove == $propertyId) { continue; }

                $propertyQuery = runQuery("SELECT * FROM properties where id = '$propertyId'");
                $row = $propertyQuery -> fetch_assoc();

                echo "<div class='property'>";
                // Display it
                echo '<a href="property_details.php?id=' . $row['id'] . '" class="property">';
                echo '<img src="images/' . $row['imagePath'] . '" alt="' . $row['propertyName'] . '">';
                echo '<h2>' . $row['propertyName'] . '</h2>';
                echo '<p>Type: ' . $row['propertyType'] . '</p>';
                echo '<p>Bedrooms: ' . $row['bedrooms'] . '</p>';
                echo '<p>Bathrooms: ' . $row['bathrooms'] . '</p>';
                echo '<p>Square Footage: ' . $row['squareFootage'] . ' sqft</p>';
                echo '<p>Price: $' . number_format($row['price'], 2) . '</p>';               
                // Close the link with the </a> tag

                // Calls post request to self to remove from wishlist
                echo "<form method='post' action='./wishlist.php'>";
                echo "<input type='hidden' value='$propertyId' name='propertyId' />";
                echo "<button type='submit'>Remove from wishlist</button>";
                echo "</form>";

                echo '</a>';

                echo "</div>";
            }
        }
        echo "</div>";
        ?>
        
    </div>
</body>

</html>