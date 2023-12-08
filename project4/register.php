<html>

    <head>
        <title>Register</title>
    <head>

    <body>
        <?php 
        require_once(__DIR__.'/database/DatabaseService.php');

        if(sizeof($_POST) == 0) {
            echo "<form action='./register.php' method='post'>";

            echo "<label for='username'>Username:</label><br>";
            echo "<input type='text' id='username' name='username'><br>";

            echo "<label for='password'>Password:</label><br>";
            echo "<input type='password' id='password' name='password'><br>";

            echo "<button type='submit'>Register</button>";
        } else {
            // Save the account
            print_r($_POST);
            $username = $_POST['username'];
            $password = $_POST['password'];

            runQuery("
            INSERT INTO USERS (username, password)
            VALUES ('$username', '$password');
            ");
        }
        ?>
            
        </form>
    </body>
</html>