<?php
session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../db_conn.php";
    if (isset($_POST['category_name'])) {
        $name = $_POST['category_name'];
        if (empty($name)) {
            $em = "The  Category Name is Required";
            header("Location: ../add-category.php?error=$em");
            exit;
        } else {
            $sql = "INSERT INTO categories (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$name]);
            if ($result) {
                $sm = "Successfully Created";
                header("Location: ../add-category.php?success=$sm");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../add-category.php?error=$em");
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
