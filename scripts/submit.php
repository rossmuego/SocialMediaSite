<?php
session_start();
if(!isset($_SESSION["email"])){
	header("location: index.php");
    exit();
}

	include('header.php')

?>

<!DOCTYPE html>
	<html>
		<head>
			<!--stylesheet -->
			<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
		<!-- MaterializeCSS -->
		    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
				
			<title>Submit a song!</title>
			<script type="text/javascript">
				
			</script>
		</head>
		<body>
			<div class="submitCard">
				<form action="songSubmit.php" method="post">
					<input type="text" name="songName" placeholder="Song Name" id="songName" class="validate" required>
					<input type="text" name="artist" id="artist" placeholder="Artist" required>
					<input type="text" name="songLink" id="songLink" placeholder="Song URL" required>
					<input type="submit" name="register" id="register" value="Submit Song" class="btn waves-effect waves-light">
                </form>
			</div>
		</body>
	</html>