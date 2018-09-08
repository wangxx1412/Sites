<?php
    session_start();
    require_once('dbconnect.php');

    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }

    $userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

    function get_recent_tweets($db){
        $result=$db->following->find(array('follower'=>$_SESSION['user']));
        $result = iterator_to_array($result);

        $users_following = array();
        foreach($result as $entry){
            $users_following[] = $entry['user'];
        }
        $result = $db->tweets->find(array('authorId'=>array('$in'=>$users_following)));
        $recent_tweets = iterator_to_array($result);
        return $recent_tweets;
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
    <form method="post" action="create_tweet.php">
        <fieldset>
            <label for="tweet">what's happening</label><br>
            <textarea name="body" rows="4" cols="50"></textarea><br>
            <input type="submit" value="Tweet" />
        </fieldset>
    </form>
    <div>
        <p><b>Tweets from people you followed</b></p>
        <?php
            $recent_tweets = get_recent_tweets($db);
            foreach ($recent_tweets as $tweet){
                echo '<p><a href="profile.php?id='.$tweet['authorId'].'">'. $tweet['authorName'].'</a></p>';
                echo '<p>'.$tweet['body'].'</p>';
                echo '<p>'.$tweet['created'].'</p>';
                echo '<hr>';
            }
        ?>
    </div>
</body>
</html>