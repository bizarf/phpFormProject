<?php
    include("./database.php");

    // declare these variables for the HTML form
    $username = null;
    $usernameErr = $passwordErr = $confirmPasswordErr = $submitError = null;

    // if POST request method is used
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // sanitize input
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)){
            $usernameErr = "* Please enter a username";
        }elseif(empty($password)){
            $passwordErr = "* Please enter a password";
        }elseif($password != $confirmPassword){
            $confirmPasswordErr = "* The passwords do not match";
        }else{
            // hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // sql query where we into a table called users. 
            $sql = "INSERT INTO users (user, password) VALUES ($username, $hash)";

            // try and catch block for database insertion. if it succeeds then send the user back to the homepage. if it fails, then set an error message
            try{
                mysqli_query($con, $sql);
                header("Location: ./index.php");
                exit;
            }
            catch(mysqli_sql_exception){
                $submitError = "* That username has already been taken";
            }
        }         
    }

    // close sql connection
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>.error { color: red;}</style>
</head>
<body>
    <a href="./index.php">Home</a>
    <h1>Register</h1>
    <form action="./register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?php echo $passwordErr; ?></span><br><br>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
        <span class="error"><?php echo $confirmPasswordErr; ?></span><br><br>
        <input type="submit" name="submit" value="Submit"><br>
        <span class="error"><?php echo $submitError; ?></span><br><br><br>
    </form>
</body>
</html>
