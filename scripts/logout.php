<?php
	session_start();
	if(!isset($_SESSION["email"])){
	header("location: index.php");
    exit();
	}
	
	$page_title ="Goodbye";
	?>
		<html>
		<head>
			<title><?php echo $page_title ?></title>
		
			<!--stylesheet -->
				<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
     
			<!-- MaterializeCSS -->
			    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
		</head>
		<body>
			<div class="submitCard">
				<?php
				$_SESSION = array();
	
				session_destroy();
				
				echo "You are now logged out</br>
				<a href='../index.php'>Login</a>"
				?>
			</div>
		
		
		</body>
	</html>