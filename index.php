<?php 
    include("database.php");
    
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        <h1>Welcome</h1>
        <a href="./login.php">Login</a>
        <a href="./register.php">Register</a>
    </body>
</html>

<?php
    mysqli_close($con);
?>