<?php

include_once('db_conx.php');
 
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //echo $email;
    echo $password;

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $queryLogin = mysqli_query($conn, $sql); 
        $loginCheck = mysqli_num_rows($queryLogin);
    
    if($loginCheck==0){
			echo 'error';
            $_SESSION['login'] = false;
        } else {
            echo 'success';
            $_SESSION['login'] = true;
        }
?>