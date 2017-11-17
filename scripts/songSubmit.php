<?php

	session_start(); 
	
	include_once('db_conx.php');
    include_once('header.php');
    
    $songName = $_POST['songName'];
    $artist = $_POST['artist'];
    $songPOST = $_POST['songLink'];
	$songQuery = false;
	$user = $_SESSION['user_id'];
    
    $getID = $songPOST;
		parse_str( parse_url( $getID, PHP_URL_QUERY ), $songShort );
			$songID = $songShort['v'];    
	
	$sql = "SELECT * FROM submissions WHERE songID ='$songID'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
		$submitStatus = "This song has already been posted!";
	} else {
	    $songQuery = true;
	}
	
	if($songQuery) {
		$sql = "INSERT INTO submissions (songName, artist, songID, submitter) VALUES ('$songName', '$artist', '$songID', '$user')";

		if ($conn->query($sql) === true) {
		    $submitStatus = "Song Submitted!";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}

?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Song Submitted</title>
            <!--stylesheet -->
			<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
		<!-- MaterializeCSS -->
		    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
			
        </head>
        <body>
            <div class="submitStatus">
				<?php echo $submitStatus; ?>
				<br>
				<?php echo '<iframe class="dt-youtube" width="700px" height="400px" src="//www.youtube.com/embed/'.$songID.'" frameborder="0" allowfullscreen></iframe>';?>
			</div>
        </body>
    </html>