<?php
session_start();
if(!isset($_SESSION["email"])){
	header("location: ../index.php");
    exit();
}

	include('header.php');
    include_once('db_conx.php');

?>
<?php
    
    $user = $_SESSION['user_id'];
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
	
	$sql = "SELECT songName, artist, submit_id, songID, vote_diff, submitter FROM submissions WHERE submitter = '$user'  ORDER BY submit_id DESC LIMIT 10";
	$query = mysqli_query($conn, $sql);
	
	$outputFollow = "";
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$outputFollow .= '<div class="videoPost"><iframe value="'.$submissionID['songID'].'"id="'.$submissionID['songID'].'"class="dt-youtube" width="350px" height="200px" src="//www.youtube.com/embed/'.$submissionID['songID'].'" frameborder="0" allowfullscreen></iframe><br><button class="small material-icons green" id="'.$submissionID['songID'].'" onclick="votesUp(this.id)">thumb_up</button><div id="displayCount'.$submissionID['songID'].'new">'.$submissionID['vote_diff'].'</div><button class="small material-icons red" id="'.$submissionID['songID'].'" onclick="downVote(this.id)">thumb_down</button></div><br>';
	}
?>
<!DOCTYPE html>
	<html>
		<head>
			<!--stylesheet -->
			<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
		<!-- MaterializeCSS -->
		    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
				
			<title>Edit Profile</title>
			<script type="text/javascript">
				
			</script>
		</head>
		<body>
			<div class="floatRight">
			<div class="editCard">
				<form action="updateProfile.php" method="post">
					<input type="text" name="facebook" placeholder="Facebook" id="facebook" class="validate" >
					<input type="text" name="twitter" id="twitter" placeholder="Twitter">
					<input type="text" name="youtube" id="youtube" placeholder="Youtube">
                    <input type="text" name="soundcloud" id="soundcloud" placeholder="Soundcloud">
                    <input type="text" name="bio" id="bio" placeholder="Bio">
                    <input type="text" name="location" id="location" placeholder="Location">
					<input type="submit" name="submit" id="submit" value="Update Info" class="btn waves-effect waves-light">
                </form>
                <a>Change Profile Pic</a>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                    <input type="submit" value="Upload Image" name="submit" class="btn waves-effect waves-light">
                </form>
			</div>
			</div>
            <div class="floatLeft">
			<div class="aboutUser">
				<div class="profilePic">
					<img src="../images/profiles/<?php echo $profilePic; ?>" alt="Profile Pic" class="profilePic">
				</div>
					<a class="profileUsername"><?php echo $profileUsername; ?></a>
					</br>
					<div class="socialLogos">
						<a href="http://www.facebook.com/<?php echo $profileFacebook; ?>" target="_blank"><img src="../images/social/facebook.png" alt="Facebook" style="width: 32px; height: 32px;"></a>
					<a href="http://www.twitter.com/<?php echo $profileTwitter; ?>" target="_blank"><img src="../images/social/twitter.png" alt="Twitter" style="width: 32px; height: 32px;"></a>
					<a href="http://www.youtube.com/<?php echo $profileYoutube; ?>" target="_blank"><img src="../images/social/youtube.png" alt="Youtube" style="width: 32px; height: 32px;"></a>
					<a href="http://www.soundcloud.com/<?php echo $profileSoundcloud; ?>" target="_blank"><img src="../images/social/soundcloud.png" alt="Soundcloud" style="width: 32px; height: 32px;"></a>
					</div>
					
					<?php
					echo $profileName."</br>";
					echo $profileUsername."</br>";
					echo $profileEmail."</br>";
					echo $profileLocation."</br>";
					echo $profileBio."</br>";?>
					
			</div>
			</div>
		</body>
	</html>