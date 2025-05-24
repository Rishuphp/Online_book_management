<?php
session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../db_conn.php";

    include "func-validation.php";
    include "func-file-upload.php";

    if (
        isset($_POST['name_id']) &&
        isset($_POST['name']) &&
        isset($_POST['emil']) &&
        isset($_POST['password']) &&
        isset($_FILES['image']) &&
        isset($_POST['current_image'])) {

        $id = $_POST['name_id'];
        $title = $_POST['name'];
        $description = $_POST['email'];
        $author = $_POST['password'];
      
        $current_image = $_POST['current_image'];
       

         $text = "User Name";
            $location = "../user-profile.php";
            $ms = "id=$id&error";
            is_empty($title,$text,$location,$ms,"");

             $text = "User Email";
            $location = "../user-profile.php";
            $ms = "id=$id&error";
            is_empty($description,$text,$location,$ms,"");

             $text = "User Password";
            $location = "../user-profile.php";
            $ms = "id=$id&error";
            is_empty($author,$text,$location,$ms,"");

             

            if(!empty($_FILES['image']['name'])){

                if(!empty($_FILES['file']['name'])){
                     $allowed_image_exs = array("jpg","jpeg","png");
            $path = "cover";
            $book_cover = upload_file($_FILES['image'] , $allowed_image_exs,$path);

           
            if($book_cover['status'] == "error"){
            $em = $book_cover['data'];
            
            header("Location: ../user-profile.php?error=$em&id=$id");
            exit;
           }else{
            $c_p_book_cover = "../uploads/cover/$current_cover";
           
            unlink($c_p_book_cover);
           

            
           $book_cover_url = $book_cover['data'];

           $sql ="UPDATE users SET name=?, email=?, password=?, image=?, WHERE id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$title,$description,$author,$book_cover_url, $id]);

             if ($result) {
                $sm = "Successfully Updated";
                header("Location: ../user-profile.php?success=$sm&id=$id");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../user-profile.php?error=$em&id=$id");
                exit;
            }
           }
            }else{

                 $allowed_image_exs = array("jpg","jpeg","png");
            $path = "cover";
            $book_cover = upload_file($_FILES['image'] , $allowed_image_exs,$path);

            

            if($book_cover['status'] == "error"){
            $em = $book_cover['data'];
            
            header("Location: ../user-profile.php?error=$em&id=$id");
            exit;
           }else{
            $c_p_book_cover = "../uploads/cover/$current_cover";
            
            unlink($c_p_book_cover);
          

          
           $book_cover_url = $book_cover['data'];

           $sql ="UPDATE users SET name=?, email=?, password=?, image=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$title,$description,$author,$book_cover_url, $id]);

             if ($result) {
                $sm = "Successfully Updated";
                header("Location: ../user-profile.php?success=$sm&id=$id");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../user-profile.php?error=$em&id=$id");
                exit;
            }
           }
            }
        }else{
            $sql ="UPDATE users SET name=?, email=?, password=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$title,$description,$author,$id]);

             if ($result) {
                $sm = "Successfully Updated";
                header("Location: ../user-profile.php?success=$sm&id=$id");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../user-profile.php?error=$em&id=$id");
                exit;
            }
        }
        
    } else {
        header("Location: ../admin.php");
        exit;
    }
} else {
    header("Location: ../user-profile.php");
    exit;
}
