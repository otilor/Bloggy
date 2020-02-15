<?php
session_start();

$username = "";
$password = "";
$errors = array();
$conn = mysqli_connect('localhost', 'root', '', 'bloggy');


if(isset($_POST["register"])){
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password_2"]);

    $user_sql  = "SELECT * FROM users where username = '$username' OR email = '$email' LIMIT 1";
    $user_result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_assoc($user_result);

    if($user){
        if($user["username"] === $username){
            array_push($errors, "Username already exists!");
        }
        if($user["email"] === $email) {
            array_push($errors, "Email already exists!");
        }
        
    }


    if($password != $password2){
        array_push($errors, "Passwords do not match");
    }

    if(count($errors) == 0){
        
        //$password = md5($password);
        $password = md5(md5($password));
        $password = sha1($password);
        $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";

        if(mysqli_query($conn, $sql)){
            echo "Successful!";
            header("location: login.php");

        }
    }
}


if(isset($_POST["login"])){
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if(empty($username)){
        array_push($errors, "Username Field is empty!");
    }
    if(empty($password)){
        array_push($errors, "Password can't be blank");
    }
   

    if(count($errors) == 0) {
        $password = sha1(md5(md5($password)));
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1){
            $_SESSION["username"] = $username;
            header("location: ../index.php") ;
        }
        else{
            array_push($errors, "Wrong Username or Password");
        }
    }
    
}


if(isset($_POST["admin_login"])){
    $admin_username = mysqli_real_escape_string($conn, $_POST["admin_username"]);
    $admin_password = mysqli_escape_string($conn, $_POST["admin_password"]);


    if(empty($admin_username)){
        array_push($errors, "Admin Username is wrong");
    }
    if(empty($admin_password)){
        array_push($errors, "Admin Password is wrong");
    }

    if(count($errors)== 0){
        $admin_password = sha1(md5(md5($admin_password)));
        $admin_users_sql = "SELECT * FROM admin_users WHERE username = '$admin_username' AND password = '$admin_password'";
        $admin_result = mysqli_query($conn, $admin_users_sql);
        if(mysqli_num_rows($admin_result) == 1){
            $_SESSION["username"] = $admin_username;
            header("location: ../auth/login.php");
        }
    }
}
?>