<?php
    $id = $_GET["id"];
    
    $conn = mysqli_connect("localhost", "root", "12345678", "final");

    if(!$conn){
        echo "連接失敗" . mysqli_connect_error(); 
    }

    mysqli_query($conn, "set names utf8");

    $sql="DELETE FROM account WHERE id = '$id'";

    if(mysqli_query($conn, $sql)){
        header('location:account.php');
    }
?>