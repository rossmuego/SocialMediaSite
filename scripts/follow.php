<?php

  include_once('db_conx.php');
  session_start();

  $action = $_POST['action'];
  $followID = $_POST['id'];
  $follower = $_SESSION['user_id'];

  if($action == "follow"){

      $sql = "INSERT INTO `following`(`follower_id`, `following_id`, `followed`) VALUES ($follower, $followID, 1)";

      if ($conn->query($sql) === true) {
          echo '<a class="btn disabled">Following</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
  } elseif($action == "unfollow"){
      $sql = "DELETE FROM following WHERE follower_id = $follower AND following_id = $followID";

      if ($conn->query($sql) === true) {
          echo '<a class="btn disabled">Following</a>';
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
?>
