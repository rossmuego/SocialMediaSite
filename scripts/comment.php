<?php

    include_once('db_conx.php');
    session_start();
    
    $status = $_POST['status'];
    
    if($status == "comment"){
   
        $comment = $_POST['comment'];
        $videoID = $_POST['videoID'];
        $userID = $_SESSION['user_id'];
        
        $sql = "INSERT INTO comments (comment, commenter_id, videoID) VALUES ('$comment', '$userID', '$videoID')";
        $query = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
        
        $sql = "SELECT username, profile_pic FROM users WHERE user_id = $userID";
        $query = mysqli_query($conn, $sql);
        
        while($userDetails = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$profilePic = $userDetails['profile_pic'];
			$username = $userDetails['username'];
		}
        
        $sql = "SELECT time FROM comments WHERE commentID = $id";
        $query = mysqli_query($conn, $sql);
        
        $time = "";
        while($commentRecent = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$time = $commentRecent['time'];
		}
        
        echo '<div class="comment"><div class="commentPic"><img src="../images/profiles/'.$profilePic.'" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;"></div><div class="commentUsername">'.$username.'  - </div><div class="commentContent">'.$comment.'</div><div class="timeComment">'.$time.'</div></div>';
    }
    
    if($status == "delete"){
        
        $comment = $_POST['comment'];
        $videoID = $_POST['videoID'];
        $userID = $_SESSION['user_id'];
        
        $sql = "INSERT INTO comments (comment, commenter_id, videoID) VALUES ('$comment', '$userID', '$videoID')";
        $query = mysqli_query($conn, $sql);
    }

    
    
?>