<?php
session_start();
if(!isset($_SESSION["email"])){
	header("location: ../index.php");
    exit();
}

	include('header.php');

?>

<?php

    include_once('db_conx.php');
    
    $user = $_GET['id'];
	$editProfile = "";
	
	if($user == $_SESSION['user_id']){
		$editProfile = '<a href="editprofile.php">Edit Profile</a>';
	}
    
    $sql = "SELECT * FROM users WHERE user_id='$user'";
    $query = mysqli_query($conn, $sql);

    
    while($userDetails = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $profileName = $userDetails['name'];
        $profileUsername = $userDetails['username'];
        $profileEmail = $userDetails['email'];
    }
	
	$sql = "SELECT * FROM users WHERE user_id='$user'";
    $query = mysqli_query($conn, $sql);

    
    while($userDetails = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $profileFacebook = $userDetails['facebook'];
        $profileTwitter = $userDetails['twitter'];
        $profileYoutube = $userDetails['youtube'];
		$profileBio = $userDetails['bio'];
		$profileLocation = $userDetails['location'];
		$profilePic = $userDetails['profile_pic'];
		$profileSoundcloud = $userDetails['soundcloud'];
    }
?>
<?php

	include_once('db_conx.php');
	
	$sql = "SELECT songName, artist, submit_id, songID, vote_diff, submitter FROM submissions WHERE submitter = '$user'  ORDER BY submit_id DESC LIMIT 10";
	$query = mysqli_query($conn, $sql);
	
	$outputFollow = "";
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$outputFollow .= '<div class="videoPost"><iframe value="'.$submissionID['songID'].'"id="'.$submissionID['songID'].'"class="dt-youtube" width="350px" height="200px" src="//www.youtube.com/embed/'.$submissionID['songID'].'" frameborder="0" allowfullscreen></iframe><br><button style="margin-top: 10px;" class="small material-icons green" id="'.$submissionID['songID'].'" onclick="votesUp(this.id)">thumb_up</button><div class="voteDiff" id="displayCount'.$submissionID['songID'].'new">'.$submissionID['vote_diff'].'</div><button class="small material-icons red" id="'.$submissionID['songID'].'" onclick="downVote(this.id)">thumb_down</button><div><a href="video.php?id='.$submissionID['songID'].'">Comments</a></div></div><br>';
	}
?>
<?php

	if($user != $_SESSION['user_id']){
		
		$followUser = $_GET['id'];
		$follower = $_SESSION['user_id'];
		$followButton = "";
	
		$sql = "SELECT * FROM following WHERE follower_id ='$follower' AND following_id = '$followUser'";
		$result = $conn->query($sql);

		if ($result->num_rows == 0) {
			$followButton = '<a class="waves-effect waves-light btn" id='.$followUser.' onclick=followUser(this.id)>Follow</a>';
		} else {
			$followButton = '<a class="btn green" onclick="unfollowUser(this.id)" id='.$followUser.'>Following</a>';
		}
	} else {
		$followButton = "";
	}
?>
<?php
	
	$sql = "SELECT profile_pic, user_id FROM users WHERE user_id IN (SELECT following_id FROM following WHERE follower_id = $user)";
	$query = mysqli_query($conn, $sql);
	
	$outputFollowing = "";
	
	while($profilePicFollowing = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$outputFollowing .= '<a href="profile.php?id='.$profilePicFollowing['user_id'].'"><div class="userProfiles"><img src="../images/profiles/'.$profilePicFollowing['profile_pic'].'" alt="Profile Pic" class="profilePic" style="width: 50px; height: 50;"></div></a>';
	}

?>
<?php
	
	$sql = "SELECT profile_pic, user_id FROM users WHERE user_id IN (SELECT follower_id FROM following WHERE following_id = $user)";
	$query = mysqli_query($conn, $sql);
	
	$outputFollower = "";
	
	while($profilePicFollower = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		if(!isset($profilePicFollower)){
			$outputFollower = "This users has no followers";
			exit();
		} else {
			$outputFollower .= '<a href="profile.php?id='.$profilePicFollower['user_id'].'"><div class="userProfiles"><img src="../images/profiles/'.$profilePicFollower['profile_pic'].'" alt="Profile Pic" class="profilePic" style="width: 50px; height: 50px;"></div></a>';
		}
	}

?>
<!DOCTYPE html>
    <html>
        <head>
            <title><?php echo $profileName ;?>'s Profile</title>
            
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
		
		function followUser(clicked_id){
	
			//the main ajax request  
			$.ajax({  
				type: "POST",  
				data: "action=follow&id="+clicked_id,  
				url: "follow.php",  
				success: function(msg) {
						$("#"+clicked_id).removeClass("waves-effect waves-light btn");
						$("#"+clicked_id).addClass("btn green");
						$("#"+clicked_id).html("Unfollow");
						$("#"+clicked_id).attr("onclick","unfollowUser(this.id)");
				}  
			});  
		};
		
		function unfollowUser(clicked_id){
	
			//the main ajax request  
			$.ajax({  
				type: "POST",  
				data: "action=unfollow&id="+clicked_id,  
				url: "follow.php",  
				success: function(msg) {
						$("#"+clicked_id).removeClass("btn green");
						$("#"+clicked_id).addClass("waves-effect waves-light btn");
						$("#"+clicked_id).html("Follow");
						$("#"+clicked_id).attr("onclick","followUser(this.id)");
				}  
			});  
		};
			</script>
        </head>
        <body>
			<div class="floatLeft">
				<div class="aboutUser">
					<div class="profilePic">
						<img src="../images/profiles/<?php echo $profilePic; ?>" alt="Profile Pic" class="profilePic">
					</div>
						<a class="profileUsername"><?php echo $profileUsername; ?></a>
						</br>
						<?php echo $followButton;?>
						</br>
						<div class="socialLogos">
							<a href="http://www.facebook.com/<?php echo $profileFacebook; ?>" target="_blank"><img src="../images/social/facebook.png" alt="Facebook" style="width: 32px; height: 32px;"></a>
						<a href="http://www.twitter.com/<?php echo $profileTwitter; ?>" target="_blank"><img src="../images/social/twitter.png" alt="Twitter" style="width: 32px; height: 32px;"></a>
						<a href="http://www.youtube.com/<?php echo $profileYoutube; ?>" target="_blank"><img src="../images/social/youtube.png" alt="Youtube" style="width: 32px; height: 32px;"></a>
						<a href="http://www.soundcloud.com/<?php echo $profileSoundcloud; ?>" target="_blank"><img src="../images/social/soundcloud.png" alt="Soundcloud" style="width: 32px; height: 32px;"></a>
						</div>
						
						<?php
						echo $profileName."</br>";
						echo $profileEmail."</br>";
						echo $profileLocation."</br>";
						echo $profileBio."</br>";
						echo $editProfile.'</br>';?>
						
				</div>
				<div class="userFollows">
					<div class="followers">
						<div class="vidTitles">Followers</div>
						<div class="profileUsers">
							<?php echo $outputFollower; ?>
						</div>
					</div>
					<div class="following">
						<div class="vidTitles">Following</div>
						<div class="profileUsers">
							<?php echo $outputFollowing; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="userVids">
				<div class="vidTitles">Posts</div>
				<div>
					<?php echo $outputFollow; ?>
				</div>
			</div>
        </body>
    </html>