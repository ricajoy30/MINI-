<?php
    session_start();
    include "../../config/database.php";

        //validation for admin access only. This check to avoid bypassing the system
    if(!isset($_SESSION["role"]) || $_SESSION["role"] != "admin"){
        header("Location: ../../index.php");
        exit;
    }
        $id= isset($_GET['id']) ? intval([$_GET]):0;

    mysqli_query($conn, "DELETE FROM users WHERE id=$id and role = 'student'");

    header('Location:index.php');
    exit;
    ?>