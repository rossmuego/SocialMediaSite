<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
			include_once("../db_conx.php");
			include_once("login_tools.php");
			list ($check, $data) = validate($conn, $_POST['email'], $_POST['password']);
			if($check == true){
				session_start();
				$_SESSION['email'] = $data['email'];
				$_SESSION['user_id'] = $data['user_id'];
				echo "success";
			}
			else{
			echo "fail";
			}
			mysqli_close($conn);
	}
?>