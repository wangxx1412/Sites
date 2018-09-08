<?php
    session_start();
    require_once('dbconnect.php');

    if(isset($_SESSION["user"])){
        header('Location:home.php');
    }

    if(isset($_POST['username'])&&isset($_POST['password'])){
        $username = $_POST['username'];
        $password = hash('sha256',$_POST['password']);
        $result = $db->users->insertOne(array('username'=>$username,'password'=>$password));
        header('Location:index.php');

    }
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Twitter Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <form method="post" action="register.php">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username"/><br>
        <label for="password">Password:</label><input type="password" name="password"/><br>
        <input type="submit" value="Sign Up">
    </fieldset> 
    </form>
    <a href="Index.php">Already have an account login here.</a>
</body>
</html>