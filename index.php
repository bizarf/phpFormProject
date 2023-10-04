<?php 
    include("database.php");
    
    session_start();

    $username = null;

    // if the username variable in the session array is not null, then set the username variable declared above to the one in the session array
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        <h1>Welcome <?php echo $username; ?></h1>
        <a href="./login.php">Login</a>
        <a href="./register.php">Register</>
    </body>
</html>

<?php
    mysqli_close($con);
?>