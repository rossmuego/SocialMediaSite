<?php

    session_start();
    include_once('db_conx.php');

    $user = $_SESSION['user_id'];
    
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $soundcloud = $_POST['soundcloud'];
    $bio = $_POST['bio'];
    $location = $_POST['location'];
    
    if(!empty($facebook)){
        $sql = "UPDATE profiles SET facebook='$facebook' WHERE user_id = '$user'";
        $query = mysqli_query($conn, $sql);
    }
    
    if(!empty($twitter)){
        $sql = "UPDATE profiles SET twitter='$twitter' WHERE user_id = '$user''";
        $query = mysqli_query($conn, $sql);
    }
    
    if(!empty($youtube)){
        $sql = "UPDATE profiles SET youtube='$youtube' WHERE user_id = '$user'";
        $query = mysqli_query($conn, $sql);
    }
    
    if(!empty($soundcloud)){
        $sql = "UPDATE profiles SET soundcloud='$soundcloud' WHERE user_id = '$user'";
        $query = mysqli_query($conn, $sql);
    }
    
    if(!empty($bio)){
        $sql = "UPDATE profiles SET bio='$bio' WHERE user_id = '$user'";
        $query = mysqli_query($conn, $sql);
    }
    
    if(!empty($location)){
        $sql = "UPDATE profiles SET location = '$location' WHERE user_id = '$user'";
        $query = mysqli_query($conn, $sql);
    } 

            header("Location: editprofile.php");

?>
