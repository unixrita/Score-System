<?php
    
    $id = $_GET["id"];
    $team_id = $_GET["team_id"];
    $right_level = $_GET["right_level"];
    
    $conn = mysqli_connect("localhost", "root", "12345678", "final");

    if(!$conn){
        echo "連接失敗" . mysqli_connect_error(); 
    }

    mysqli_query($conn, "set names utf8");
    $sql="UPDATE account SET team_id = '$team_id' where id = '$id'";
    echo $sql;
    if(mysqli_query($conn, $sql)){
        if($right_level == 1){
            header('location:member_manager.php');
        }else{
            header('location:member_student.php');
        }
    }
?>