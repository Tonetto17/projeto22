<?php
    session_start();
    session_destroy();
    header("Location: loja.php");
    exit;
?>