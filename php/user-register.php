<?php
session_start();

   

    include "../db_conn.php";

    include "func-validation.php";
    include "func-file-upload.php";

  

    if (
        isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
       
        isset($_FILES['image'])) {
       
            $title = $_POST['name'];
            $description = $_POST['email'];
            $author = $_POST['password'];

            $user_input = 'name='.$title.'&email='.$description.'&password='.$author;

            $text = "User Name";
            $location = "../user-register.php";
            $ms = "error";
            is_empty($title,$text,$location,$ms,$user_input);

             $text = "User Email";
            $location = "../user-register.php";
            $ms = "error";
            is_empty($description,$text,$location,$ms,$user_input);

             $text = " User Password";
            $location = "../user-register.php";
            $ms = "error";
            $hashedPassword = password_hash($author, PASSWORD_BCRYPT);
            is_empty($author,$text,$location,$ms,$user_input);
            
            $allowed_image_exs = array("jpg","jpeg","png");
            $path = "cover";
            $book_cover = upload_file($_FILES['image'] , $allowed_image_exs,$path);
            if($book_cover['status'] == "error"){
                $em = $book_cover['data'];
            header("Location: ../user-register.php?error=$em&$user_input");
            exit;
           }
           else{
           $book_cover_url = $book_cover['data'];
           
           $sql ="INSERT INTO users (name,email,password,image) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$title,$description,$hashedPassword,$book_cover_url]);
            if ($result) {
                $sm = "The User Successfully Registration!";
                header("Location: ../user-login.php?success=$sm");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../user-login.php?error=$em");
                exit;
            }
           }
           
    } else {
        header("Location: ../user-login.php");
        exit;
    } 
