<?php
    
    session_start();

    unset($_SESSION["account_id"]);
    unset($_SESSION["account_name"]);
    unset($_SESSION["right_level"]);

    header("Location: login.php");
?>