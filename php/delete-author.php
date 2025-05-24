<?php
session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../db_conn.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
       
        if (empty($id)) {
            $em = "Error Occurred";
            header("Location: ../admin.php?error=$em");
            exit;
        } else {
           
                $sql = "DELETE FROM author  WHERE id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$id]);
            if ($result) {

                
                $sm = "Successfully Removed!";
                header("Location: ../admin.php?success=$sm");
                exit;
            

            }else{
                $em = "Error Occurred";
            header("Location: ../admin.php?error=$em");
            exit;
            }

             
        }
    } else {
        header("Location: ../admin.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
