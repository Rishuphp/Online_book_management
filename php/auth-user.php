<?php
session_start();
if(isset($_POST['email']) && 
isset($_POST['password'])){
include "../db_conn.php";
    include "func-validation.php";


    $email= $_POST['email'];
    $password = $_POST['password'];

    $text = "User Email";
    $location = "../user-login.php";
    $ms = "error";

    is_empty($email,$text,$location,$ms,"");

    $text = " User Password";
    $location = "../user-login.php";
    $ms = "error";

    is_empty($password,$text,$location,$ms,"");
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    if($stmt->rowCount() === 1){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $user_id = $user['id'];
        $user_email = $user['email'];
        $user_password = $user['password'];
        if($email === $user_email){
            if(password_verify($password,$user_password)){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $_SESSION['user_id1'] = $user_id;
                $_SESSION['user_email1'] = $user_email;
                
    header("Location: ../index.php");

            }else{
                $em ="Incorrect User Name or Password!";
    header("Location: ../user-login.php?error=$em");
            }
        }else{
            $em ="Incorrect User Name or Password!";
    header("Location: ../user-login.php?error=$em");
        }
    }else {
        $em ="Incorrect User Name or Password!";
    header("Location: ../user-login.php?error=$em");

    }
}else{
    header("Location: ../user-login.php");
}
?>