<?php

include_once('db_conx.php');

session_start();

    $name = $_POST['name']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

// Check if e-mail address syntax is valid or not

    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email.";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username='$username'");
        $data = mysqli_num_rows($result);

        if(($data)==0){
            $query = mysqli_query($conn, "INSERT INTO profiles(profile_pic) VALUES ('default.png')");
            $query = mysqli_query($conn, "INSERT INTO users(name, email, username, password) VALUES ('$name', '$email', '$username', '$password')"); // Insert query
            echo "registerSuccess";
        } else{
            echo "This user is already registered, Please try another email/username.";
        }
    }
?>