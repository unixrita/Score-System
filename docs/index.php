<?php
    
    session_start();

    if(!isset($_SESSION["account_name"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首頁</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php 
        include("navbar.php");
    
        if(($_SESSION["right_level"]) == 1){
            include("index_manager.php");
        }
        else if(($_SESSION["right_level"]) == 2){
            include("index_teacher.php");
        }
        else{
            include("index_student.php");
        }
    ?>
  
</body>
</html>