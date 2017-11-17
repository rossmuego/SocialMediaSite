<?php
session_start();
if(!isset($_SESSION["email"])){
	header("location: ../index.php");
    exit();
}

	include('header.php')

?>
<?php

	include_once('db_conx.php');
	
	$sql = "SELECT submitter, songName, artist, submit_id, songID, vote_diff FROM submissions ORDER BY submit_id DESC LIMIT 10";
	$query = mysqli_query($conn, $sql);
	
	$outputNew = "";
	$userID = "";
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		$userID = $submissionID['submitter'];
		
		$sql1 = "SELECT username FROM users WHERE user_id = $userID";
		$query1 = mysqli_query($conn, $sql1);
		
		while($getUsername = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$username = $getUsername['username'];
		}
		
		$sql2 = "SELECT profile_pic FROM users WHERE user_id = $userID";
		$query2 = mysqli_query($conn, $sql2);

		while($getPic = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
			$profilePic = $getPic['profile_pic'];
		}
		
		$outputNew .= '<div class="videoPost"><a href=profile.php?id='.$userID.'><img src="../images/profiles/'.$profilePic.'" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;">'.$username.'</a><iframe value="'.$submissionID['songID'].'"id="'.$submissionID['songID'].'"class="dt-youtube" width="350px" height="200px" src="//www.youtube.com/embed/'.$submissionID['songID'].'" frameborder="0" allowfullscreen></iframe><br><button style="margin-top: 10px;" class="small material-icons green" id="'.$submissionID['songID'].'" onclick="votesUp(this.id)">thumb_up</button><div class="voteDiff" id="displayCount'.$submissionID['songID'].'new">'.$submissionID['vote_diff'].'</div><button class="small material-icons red" id="'.$submissionID['songID'].'" onclick="downVote(this.id)">thumb_down</button><div><a href="video.php?id='.$submissionID['songID'].'">Comments</a></div></div><br>';
	}
?>
<?php
	
	$sql = "SELECT submitter, songName, artist, submit_id, songID, vote_diff FROM submissions ORDER BY vote_diff DESC LIMIT 10";
	$query = mysqli_query($conn, $sql);
	
	$outputTop = "";
	$userID = "";
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		$userID = $submissionID['submitter'];
		
		$sql1 = "SELECT username FROM users WHERE user_id = $userID";
		$query1 = mysqli_query($conn, $sql1);
		
		while($getUsername = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$username = $getUsername['username'];
		}
		
		$sql2 = "SELECT profile_pic FROM users WHERE user_id = $userID";
		$query2 = mysqli_query($conn, $sql2);

		while($getPic = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
			$profilePic = $getPic['profile_pic'];
		}
		
		$outputTop .= '<div class="videoPost"><a href=profile.php?id='.$userID.'><img src="../images/profiles/'.$profilePic.'" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;">'.$username.'</a><iframe value="'.$submissionID['songID'].'"id="'.$submissionID['songID'].'"class="dt-youtube" width="350px" height="200px" src="//www.youtube.com/embed/'.$submissionID['songID'].'" frameborder="0" allowfullscreen></iframe><br><button style="margin-top: 10px;" class="small material-icons green" id="'.$submissionID['songID'].'" onclick="votesUp(this.id)">thumb_up</button><div class="voteDiff" id="displayCount'.$submissionID['songID'].'new">'.$submissionID['vote_diff'].'</div><button class="small material-icons red" id="'.$submissionID['songID'].'" onclick="downVote(this.id)">thumb_down</button><div><a href="video.php?id='.$submissionID['songID'].'">Comments</a></div></div><br>';
	}
?>
<?php

	$user = $_SESSION['user_id'];
		
	$sql = "SELECT submitter, songName, artist, submit_id, songID, vote_diff FROM submissions WHERE submitter IN (SELECT following_id FROM following WHERE follower_id = $user) ORDER BY submit_id DESC LIMIT 50";
	$query = mysqli_query($conn, $sql);
		
	$outputFollowing = "";
	$userID = "";
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		$userID = $submissionID['submitter'];
		
		$sql1 = "SELECT username FROM users WHERE user_id = $userID";
		$query1 = mysqli_query($conn, $sql1);
		
		while($getUsername = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
			$username = $getUsername['username'];
		}
		
		$sql2 = "SELECT profile_pic FROM users WHERE user_id = $userID";
		$query2 = mysqli_query($conn, $sql2);

		while($getPic = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
			$profilePic = $getPic['profile_pic'];
		}
		
		$outputFollowing .= '<div class="videoPost"><a href=profile.php?id='.$userID.'><img src="../images/profiles/'.$profilePic.'" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;">'.$username.'</a><iframe value="'.$submissionID['songID'].'"id="'.$submissionID['songID'].'"class="dt-youtube" width="350px" height="200px" src="//www.youtube.com/embed/'.$submissionID['songID'].'" frameborder="0" allowfullscreen></iframe><br><button style="margin-top: 10px;" class="small material-icons green" id="'.$submissionID['songID'].'" onclick="votesUp(this.id)">thumb_up</button><div class="voteDiff" id="displayCount'.$submissionID['songID'].'new">'.$submissionID['vote_diff'].'</div><button class="small material-icons red" id="'.$submissionID['songID'].'" onclick="downVote(this.id)">thumb_down</button><div><a href="video.php?id='.$submissionID['songID'].'">Comments</a></div></div><br>';
	}
?>
<!DOCTYPE html>
    <html>
		<head>
	
		<title>Homepage</title>
	
		<!--stylesheet -->
			<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
		<!-- MaterializeCSS -->
		    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
			
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
			
			<script type="text/javascript" language="javascript">

		function votesUp(clicked_id) { 
	
			//the main ajax request  
			$.ajax({  
				type: "POST",  
				data: "action=vote_up&id="+clicked_id,  
				url: "votes.php",  
				success: function(msg) {
					console.log(msg);
					if (msg.indexOf("You have already voted.") > -1) {
                        alert(msg);//code
                    } else {
						$('#displayCount'+clicked_id+'top').html(msg);
						$('#displayCount'+clicked_id+'new').html(msg);
					}
				}  
			});   
		};
	
		function downVote(clicked_id){
	
			//the main ajax request  
			$.ajax({  
				type: "POST",  
				data: "action=vote_down&id="+clicked_id,  
				url: "votes.php",  
				success: function(msg) {
					if (msg.indexOf("You have already voted.") > -1) {
                        alert(msg);//code
                    } else {
						$('#displayCount'+clicked_id+'top').html(msg);
						$('#displayCount'+clicked_id+'new').html(msg);
					}
				}  
			});  
		};
			</script>
		</head>
        <body>
			<div class="floatRight">
				<div class="latestVids">
					<div class="vidTitles">Latest Videos</div>
					<div>
						<?php echo $outputNew; ?>
					</div>
				</div>
				<div class="topVids">
					<div class="vidTitles">Top Videos</div>
					<div>
						<?php echo $outputTop; ?>
					</div>
				</div>
				</div>
			<div class="floatLeft">
				<div class="followedVids">
					<div class="vidTitles">Following</div>
						<?php echo $outputFollowing; ?>
				</div>
			</div>
        </body>
    </html>