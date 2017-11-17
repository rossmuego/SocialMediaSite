<?php

	session_start(); 
	
	include_once('db_conx.php');
    include_once('header.php');
    
    $videoID = $_GET['id'];
	
	$sql = "SELECT songName, artist FROM submissions WHERE songID = '$videoID'";
	$query = mysqli_query($conn, $sql);
	
	while($submissionID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$songName = $submissionID['songName'];
		$songArtist = $submissionID['artist'];
	}
?><?php

	$sql = "SELECT comment, commenter_id, time, commentID FROM comments WHERE videoID = '$videoID' ORDER BY commentID DESC";
	$query = mysqli_query($conn, $sql);
	
	$outputComments = "";
	
	while($commentID = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
		$userID = $commentID['commenter_id'];
		
		$sql2 = "SELECT username, profile_pic FROM users WHERE user_id = '$userID'";
		$query2 = mysqli_query($conn, $sql2);
		
		while($userDetails = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
			$profilePic = $userDetails['profile_pic'];
			$username = $userDetails['username'];
		}
		
		
		$outputComments .= '<div class="comment"><div class="commentPic"><img src="../images/profiles/'.$profilePic.'" alt="Profile Pic" class="profilePic" style="width: 30px; height: 30px;"></div><div class="commentUsername">'.$username.'  - </div><div class="commentContent">'.$commentID['comment'].'</div><div class="timeComment">'.$commentID['time'].'</div></div>';
	}

?>

<!DOCTYPE html>
    <html>
        <head>
            <title><?php echo "$songName - $songArtist" ?></title>
            <!--stylesheet -->
			<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
		<!-- MaterializeCSS -->
		    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
			
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script type="text/javascript" language="javascript">
			
				 function comment(clicked_id) {
				    var songID = 'videoID='+clicked_id;
					var comment = '&comment='+$('#commentText').val();
					var status = "&status=comment";
					
					if(comment.length>0){
				       //AJAX POST
					   $.ajax({
				            type: "POST",
				            url: "comment.php",
				            data: songID+comment+status,
							success: function(response){
								var currentContent = document.getElementById("commentSection").innerHTML;
								var newContent = response + currentContent;
								document.getElementById("commentSection").innerHTML = newContent;
								document.getElementById("commentText").value= "";
				            }
				        });
					}
				 }
				 
				 function deleteComment(clicked_id) {
				    
					var songID = 'videoID='+clicked_id;
					var comment = '&comment='+$('#commentText').val();
					var status = "&status=delete";
					
					if(comment.length>0){
				       //AJAX POST
					   $.ajax({
				            type: "POST",
				            url: "comment.php",
				            data: songID+comment+status,
							success: function(response){
				               location.reload();
				            }
				        });
					}
				 }
			
		</script>	
        </head>
        <body>
            <div class="submitStatus">
				<?php echo '<iframe class="dt-youtube" width="700px" height="400px" src="//www.youtube.com/embed/'.$videoID.'" frameborder="0" allowfullscreen></iframe>';?>
			</div>
			<div class="videoComments">
				<input type="text" name="commentText" placeholder="Comment" id="commentText" class="validate" maxlength="55">
				<input type="submit" name="commentSub" id="<?php echo $videoID; ?>" value="Comment" class="btn waves-effect waves-light" onclick="comment(this.id)">
				
					<div id="commentSection"><?php echo $outputComments; ?></div>
				
			</div>
        </body>
    </html>