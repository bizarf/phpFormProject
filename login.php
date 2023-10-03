<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./login.php" method="post">
            <label for="username">Username:</label><br />
            <input type="text" name="username" id="username" /><br />
            <label for="password">Password:</label><br />
            <input type="password" name="password" id="password" /><br />
            <input type="submit" name="submit" value="Login" />
    </form>
</body>
</html>

<?php
    include("database.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE user = '{$username}'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            echo $row["user"];
        }else{
            echo ""
        }

        mysqli_close($con);
    }
?>