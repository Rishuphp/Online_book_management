<?php
session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../db_conn.php";
    if (isset($_POST['author_name']) &&
   isset($_POST['author_id']) ) {
        $name = $_POST['author_name'];
        $id = $_POST['author_id'];
        if (empty($name)) {
            $em = "The Author Name is Required";
            header("Location: ../edit-author.php?error=$em&id=$id");
            exit;
        } else {
            $sql = "UPDATE author SET name=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$name,$id]);
            if ($result) {
                $sm = "Successfully Updated";
                header("Location: ../edit-author.php?success=$sm&id=$id");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../edit-author.php?error=$em&id=$id");
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
