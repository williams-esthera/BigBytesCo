<html>

    <head>
        <title>Login</title>
    <head>

    <body>
        <?php 
        require_once(__DIR__.'/database/DatabaseService.php');

        if(sizeof($_POST) == 0) {
            echo "<form action='./login.php' method='post'>";

            echo "<label for='username'>Username:</label><br>";
            echo "<input type='text' id='username' name='username'><br>";

            echo "<label for='password'>Password:</label><br>";
            echo "<input type='password' id='password' name='password'><br>";

            echo "<button type='submit'>Login</button>";
        } else {
            // Save the account
            $username = $_POST['username'];
            $password = $_POST['password'];

            $results = runQuery("SELECT * FROM USERS WHERE username = '$username' AND password = '$password';");
            $account = $results -> fetch_assoc();
            if($account == NULL) {
                echo "incorrect login information";
            } else {
                print_r($account);
            }
        }
        ?>
            
        </form>
    </body>
</html>