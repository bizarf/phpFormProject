<?php 
    include("database.php");
    
    session_start();

    $username = null;

    // if the username variable in the session array is not null, then set the username variable declared above to the one in the session array
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: ".$_SERVER["PHP_SELF"]);
        exit;
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
        <!-- conditionally render the login and register links if there is no username variable in the session -->
        <?php 
            if(empty($_SESSION["username"])){
        ?>
            <a href="./login.php">Login</a>
            <a href="./register.php">Register</>
        <?php
            }
        ?>   
        <!-- conditionally render a logout button -->
        <?php 
            if(isset($_SESSION["username"])){
        ?>
            <form action="./index.php" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        <?php
            }
        ?>   
    </body>
</html>

<?php
    mysqli_close($con);
?>