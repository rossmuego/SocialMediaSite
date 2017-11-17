<?php

if(isset($errors)&&!empty($errors)){
	echo'<p id="err_msg">Oops! there was a problem:<br>';
	foreach ($errors as $msg){
		echo "- $msg<br>";
	}
	echo 'Please try again</p>';
}
?>
<!DOCTYPE>
	<html lang="uk-EN">
		<head>
			<meta charset="UTF-8">
			<title>Admin Login</title>
			<link rel="stylesheet" type="text/css" href="stylesheet.css">
                        <link rel="icon" href="images/schoolbadge.ico" type="image/x-icon">
		</head>
		<body>
			<h1><a href="index.html">Yearbook 2016</a></h1>
			<div class="card-form">
				<div style="margin:auto;">
					<form action="login_action.php" method="POST">
					<p>
					Username <input type="text" name="username">
				</p><p>
					Password <input type="password" name="pass">
				</p><p>
					<input type="submit" value="Login" name="Login">
				</p>
			</form>
				</div>
			</div>
		</body>
	</html>