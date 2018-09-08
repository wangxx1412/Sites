<?php
    session_start();
    require_once('dbconnect.php');

    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }

    $userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

    function get_user_list($db){
        $result=$db->users->find();
        $users = iterator_to_array($result);
        return $users;
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
    <?php include('header.php');?>
    <div>
        <?php
        $user_list = get_user_list($db);
        foreach ($user_list as $user){
            echo '<span>'.$user['username'].'</span>';
            echo '[<a href="profile.php?id=' .$user['_id']. '">Visit Profile</a>]';
            echo '[<a href="follow.php?id=' .$user['_id']. '">Follow</a>]';
            echo '<hr>';
        }
        ?>
    </div>
</body>
</html>