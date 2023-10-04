<?php
    include("database.php");
    session_start();
    
    // declare username and loginError variables for use in the HTML form
    $username = null;
    $loginErr = null;

    // if the POST request method is used
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // filter and sanitize the username and input fields from the form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        // if username is empty set the error message
        if(empty($username)){
            $loginErr = "Please enter a username";
        }elseif(empty($password)){
            $loginErr = "Please enter a password";
        }else{
            // SQL query to select matching username
            $sql = "SELECT * FROM users WHERE user = '{$username}'";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                // check if the password matches the hashed password in the database
                if(password_verify($password, $row["password"])){
                    // set a variable named username into session
                    $_SESSION["username"] = $username;
                    header("Location: ./index.php");
                }else{
                    $loginErr = "Wrong password";
                }
            }else{
                $loginErr = "Username or password is incorrect";
            }
        }

        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>.error { color: red;}</style>
</head>
<body>
    <form action="./login.php" method="post">
            <label for="username">Username:</label><br />
            <input type="text" name="username" id="username" value="<?php echo $username; ?>"/><br /><br>
            <label for="password">Password:</label><br />
            <input type="password" name="password" id="password" /><br /><br>
            <input type="submit" name="submit" value="Login" /><br><br> 
            <span class="error"><?php echo $loginErr; ?></span>
    </form>
</body>
</html>
