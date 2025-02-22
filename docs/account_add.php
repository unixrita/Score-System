<?php
    include("navbar.php");

    session_start();

    if(!isset($_SESSION['account_name'])){
        header("Location: login.php");
    }

    $id = $_SESSION["account_id"];
    
    $conn = mysqli_connect("localhost", "root", "12345678", "final");

    if(!$conn){
        echo "連接失敗" . mysqli_connect_error(); 
    }

    mysqli_query($conn, "set names utf8");

    $right_level = $_GET["right_level"];

    if($right_level==1){
        $identity = "管理員";
    }
    else if($right_level==2){
        $identity = "教師";
    }
    else{
        $identity = "學生";
    }
    
    if(isset($_POST["ID"]) && isset($_POST["name"]) && isset($_POST["password"])){
        $new_id = $_POST["ID"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $cpassword = $_POST["checkPassword"];
        $email = $_POST["email"];
        $team_id = $_POST["team_id"];
        $img_name = $_POST["img"];
        
        if($password != $cpassword){
            $error = "<p><font color='red'>密碼不一致</font></p>";
        }elseif(!(preg_match("/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/", $email))){
                $error = "<p><font color='red'>email格式錯誤</font></p>";
        }else{
            $sql2 = "INSERT INTO account (id, password, name, right_level, image, email, team_id) VALUES ('$new_id', '$password', '$name', '$right_level', '$img_name', '$email', '$team_id')";
            mysqli_query($conn, $sql2);
            echo "<script> alert('新增帳號成功');parent.location.href='account.php'; </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>新增<?php echo $identity; ?>帳號</title>
    <meta charset="utf-8">
  </head>
  <body class="app sidebar-mini rtl">
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
     <?php
        $sql = "SELECT * FROM account WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
     ?>
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $row["image"] ?? "" ?>" width="25%" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo $row[name]?></p>
          <p class="app-sidebar__user-designation">
              <?php
                if($row["right_level"]==1){
                    echo "管理員";
                }
                else if($row["right_level"]==2){
                    echo "教師";
                }
                else{
                    echo "學生";
                }
        }
              ?>
          </p>
        </div>
      </div>
      <ul class="app-menu">
          <li><a class="app-menu__item" href="member_manager.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
          <li><a class="app-menu__item" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
          <li><a class="app-menu__item" href="upload_manager.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
          <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">新增<?php echo $identity; ?>帳號</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="account.php" style="color:black"><font>帳號管理</font></a></li>
          <li class="breadcrumb-item"><a href="#" style="color:black"><font>新增<?php echo $identity; ?>帳號</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-md-6">
                <div class="tile-body">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>姓名</font></label>
                      <div class="col-md-8">
                        <input class="form-control col-md-8" type="text" name="name"  value="<?php echo $name ?? "" ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>頭像</font></label>
                      <div class="col-md-8">
                        <input class="form-control" name="img" type="file" accept="image/*" required>
                            <?php
                                if(isset($_FILES["img"])){
                                    move_uploaded_file($_FILES["img"]["tmp_name"], "img/".$_FILES["img"]["name"]);
                               }
                            ?>
                        <br>
                        <img src="<?php echo $row["image"] ?? "img/stranger.png" ?>" width="60%">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3">平台角色</label>
                      <div class="col-md-8">
                       <font><?php echo $identity ?></font>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>帳號</font></label>
                      <div class="col-md-8">
                       <input class="form-control" type="text" value="<?php echo $new_id ?? "" ?>" name="ID" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>密碼</font></label>
                      <div class="col-md-8">
                       <input class="form-control" type="password" name="password" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>確認密碼</font></label>
                      <div class="col-md-8">
                       <input class="form-control" type="password" name="checkPassword" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>Email</font></label>
                      <div class="col-md-8">
                        <input class="form-control" type="email" name="email"  value="<?php echo $email ?? "" ?>" required>
                      </div>
                    </div>
                 <?php
                      if($right_level != 1){
                  ?>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>組別</font></label>
                      <div class="col-md-8">
                       <input class="form-control" type="text" name="team_id"  value="<?php echo $team_id ?? "" ?>" required>
                      </div>
                    </div>
                  <?php
                      }
                  ?>
                    <?php echo $error; ?>
                    <div class="tile-footer">
                      <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                          <input class="btn btn-primary" type="submit" value="完成">&nbsp;&nbsp;
                          <input class="btn btn-primary" type="reset" value="取消">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>