<?php
    $method=$_GET['method'];

    $id=$_POST['id'];
    if(!isset($_POST['id'])){
        $id=$_GET['id'];
    }

    $password=$_POST['password'];
    $name=$_POST['name'];
    $right_level=$_GET['right_level'];

    $link=mysqli_connect("localhost","web_class","2019","practice8");

    echo $method, "<br>";
    echo $right_level, "<br>";
    echo $id, "<br>";


    if($method=="right_update"){
        $sql="UPDATE account SET right_level = '$right_level' where id = '$id'";
        echo $sql;
        if(mysqli_query($link, $sql)){
            header('location:account_manage.php');
        }
    }
    else{
        $sql="UPDATE account SET password = '$password', name = '$name' where id = '$id'";
        echo $sql;
        if(mysqli_query($link, $sql)){
            header('location:account_manage.php');
        }
    }
?>