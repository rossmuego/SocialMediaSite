<?php

    include_once('db_conx.php');

    session_start();

        $user = $_SESSION['email'];
        $songID = $_POST['id'];
        $voteValid = "";

        $result = mysqli_query($conn, "SELECT * FROM votes WHERE songID='$songID' AND user='$user'");

        if(mysqli_num_rows($result)){
            $voteValid = 'false';
        } else {
            $voteValid = 'true';
        }

    $action = $_POST['action'];

    if($voteValid == 'true'){

        if($action == "vote_up") {

            $songID = $_POST['id'];

            $sql = "UPDATE submissions SET votes_up = votes_up+1 WHERE songID = '$songID'";
            $query = mysqli_query($conn, $sql);

            $sql = "UPDATE submissions SET vote_diff = votes_up - votes_down WHERE songID = '$songID'";
            $query = mysqli_query($conn, $sql);

            //EXTRACT WHILE LOOP DIFFERENCE BETWEEN VOTES

            $sql = "SELECT vote_diff FROM submissions WHERE songID = '$songID'";
            $voteDiff = mysqli_query($conn, $sql);

            while($voteDiffExtract = mysqli_fetch_array($voteDiff, MYSQLI_ASSOC)) {
                $voteDiffValue = $voteDiffExtract['vote_diff'];
            }

            $query = mysqli_query($conn, "INSERT INTO votes (user, songID, voted) VALUES ('$user', '$songID', '1')"); // Insert query

            echo $voteDiffValue;

            exit();

        } elseif($action == "vote_down") {


            $songID = $_POST['id'];

            $sql = "UPDATE submissions SET votes_down = votes_down+1 WHERE songID = '$songID'";
            $query = mysqli_query($conn, $sql);

            $sql = "UPDATE submissions SET vote_diff = votes_up - votes_down WHERE songID = '$songID'";
            $query = mysqli_query($conn, $sql);

            $sql = "SELECT vote_diff FROM submissions WHERE songID = '$songID'";
            $voteDiff = mysqli_query($conn, $sql);

            while($voteDiffExtract = mysqli_fetch_array($voteDiff, MYSQLI_ASSOC)) {
               $voteDiffValue = $voteDiffExtract['vote_diff'];
           }

           $query = mysqli_query($conn, "INSERT INTO votes (user, songID, voted) VALUES ('$user', '$songID', '2')"); // Insert query

           echo $voteDiffValue;

            exit();
        }
    } else {
        echo 'You have already voted.';
    }
?>
