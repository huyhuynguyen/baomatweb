<?php
    if (isset($_SESSION["save_username"]))
        $savedUsername=$_SESSION["save_username"];
    session_destroy();
    session_start();
    if (isset($savedUsername))
        $_SESSION["save_username"]=$savedUsername;

    header("Location: http://localhost/BMW/DangNhap");
?>