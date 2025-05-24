<?php
session_start();

   

    include "../db_conn.php";

    include "func-validation.php";
    include "func-file-upload.php";

  

    if (
        isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['password'])) {
       
            $title = $_POST['name'];
            $description = $_POST['email'];
            $author = $_POST['password'];

            $user_input = 'name='.$title.'&email='.$description.'&password='.$author;

            $text = "Admin Name";
            $location = "../add-admin.php";
            $ms = "error";
            is_empty($title,$text,$location,$ms,$user_input);

             $text = "Admin Email";
            $location = "../add-admin.php";
            $ms = "error";
            is_empty($description,$text,$location,$ms,$user_input);

             $text = " Admin Password";
            $location = "../add-admin.php";
            $ms = "error";
            $hashedPassword = password_hash($author, PASSWORD_BCRYPT);
            is_empty($author,$text,$location,$ms,$user_input);
            
           
           
           
           $sql ="INSERT INTO admin (name,email,password) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$title,$description,$hashedPassword]);
            if ($result) {
                $sm = "The Admin Successfully Registration!";
                header("Location: ../add-admin.php?success=$sm");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../add-admin.php?error=$em");
                exit;
            }
           
           
    } else {
        header("Location: ../login.php");
        exit;
    }
    ?>
