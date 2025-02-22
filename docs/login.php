<?php
    session_start();
    if(isset($_SESSION["account_name"])){
        header("Location: index.php");
    }
    if(isset($_POST["ID"]) && isset($_POST["password"])){
        $id = $_POST["ID"];
        $password = $_POST["password"];
        $conn = mysqli_connect("localhost", "root", "12345678", "final");
        if(!$conn){
            echo "連接失敗" . mysqli_connect_error(); 
        }
        mysqli_query($conn, "set names utf8");
        $sql = "SELECT * FROM account WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            if($row["password"] == $password){
                $_SESSION["account_name"] = $row["name"];
                $_SESSION["account_id"] = $row["id"];
                $_SESSION["right_level"] = $row["right_level"];
                header("Location: index.php");
            }
        }
        if(mysqli_num_rows($result) == 0){
            $error = "<p><font color='red'>此帳號未註冊</font></p>";
        }else{
            $error = "<p><font color='red'>密碼錯誤</font></p>";
        }
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>登入</title>
    <style>
        font {font-family: 微軟正黑體}
        p {font-family: 微軟正黑體}
      </style>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Fjuim</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i><font>登入</font></h3>
          <div class="form-group">
            <label class="control-label"><font>帳號</font></label>
            <input class="form-control" type="text" name="ID" value="<?php echo $_POST["ID"] ?? "" ?>"  required autofocus>
          </div>
          <div class="form-group">
            <label class="control-label"><font>密碼</font></label>
            <input class="form-control" type="password" name="password" required>
          </div>
          <div class="form-group btn-container">
           <?php echo $error ?? "<br>" ?>
            <input class="btn btn-primary btn-block" type="submit" value="登入">
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>