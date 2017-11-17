<?php
	function validate($db_conx, $email ="", $pword =""){
		$errors = array();
		if (empty($email))
		{
			$errors[] = "Enter your email.";
		}
		else{
			$e = mysqli_real_escape_string($db_conx, trim($email));
		}
		
		if (empty($pword))
		{
			$errors[] = "Enter your password";
		}
		else{
			$p = mysqli_real_escape_string($db_conx, trim($pword));
		}
		
		if(empty($errors)){
			$q = "SELECT * FROM users WHERE email = '$e' AND password = '$p'";
			$r = mysqli_query($db_conx, $q);
			
				if(mysqli_num_rows($r) ==1){
					$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
					return array(true, $row);
				}
				else{
					$errors[] = "Username and/or password not found.";
				}
			}return array(false,$errors);
	}
?>