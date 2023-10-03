<?php
    include("./database.php");

    $username = null;
    $usernameErr = $passwordErr = $confirmPasswordErr = null;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // sanitize input
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sanitizedUsername  = $username;

        if(empty($username)){
            $usernameErr = "Please enter a username";
        }elseif(empty($password)){
            $passwordErr = "Please enter a password";
        }elseif($password != $confirmPassword){
            $confirmPasswordErr = "The passwords do not match";
        }else{
            // hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (user, password) VALUES ($username, $hash)";

            try{
                mysqli_query($con, $sql);
                echo "Registration was successful";
            }
                catch(mysqli_sql_exception){
                echo "That username has already been taken";
            }
        }         
    }

    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <form action="./register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
        <span><?php echo $usernameErr; ?></span><br><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br>
        <span><?php echo $passwordErr; ?></span><br><br>
        <label for="confirmPassword">Confirm Password:</label><br>
        <input type="password" name="confirmPassword" id="confirmPassword"><br>
        <span><?php echo $confirmPasswordErr; ?></span><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
