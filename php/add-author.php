<?php
session_start();

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])
) {

    include "../db_conn.php";
    if (isset($_POST['author_name'])) {
        $name = $_POST['author_name'];
        if (empty($name)) {
            $em = "The  Author Name is Required";
            header("Location: ../add-author.php?error=$em");
            exit;
        } else {
            $sql = "INSERT INTO author (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$name]);
            if ($result) {
                $sm = "Successfully Created";
                header("Location: ../add-author.php?success=$sm");
                exit;
            } else {
                $em = "Unknown Error Occurred";
                header("Location: ../add-author.php?error=$em");
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
