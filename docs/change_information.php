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
    

    if(isset($_POST["email"])){
        $email = $_POST["email"];
        $sql2="UPDATE account SET email = '$email' where id = '$id'";
        if(mysqli_query($conn, $sql2)){
            echo "<script> alert('email修改成功');</script>";
        }
    }

    if(isset($_POST["new_password"]) && isset($_POST["check_password"])){
        $password = $_POST["new_password"];
        $cpassword = $_POST["check_password"];
        
        if($password != $cpassword){
            $error = "<p><font color='red'>密碼不一致</font></p>";
        }else{
            $sql2 = "UPDATE account SET password = '$password' where id = '$id'";
            if(mysqli_query($conn, $sql2)){
                echo "<script> alert('密碼修改成功');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>帳號修改</title>
    <meta charset="utf-8">
  </head>
  <body class="app sidebar-mini rtl">
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">帳號設定</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>帳號設定</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-md-6">
                <div class="tile-body">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                   <?php
                        $sql = "SELECT * FROM account WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){
                    ?>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>姓名</font></label>
                      <div class="col-md-8">
                        <font><?php echo $row[name] ?></font>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>頭像</font></label>
                      <div class="col-md-8">
                        <input class="form-control" name='<?php echo $id?>' type="file" accept="image/*">
                            <?php
                                if(isset($_FILES[$id])){

                                    //取得檔案的副檔名
                                    $type = str_replace("image/", "", $_FILES[$id]['type']);

                                    //將檔案從暫存位置移動到"img/[id].[副檔名]"
                                    move_uploaded_file($_FILES[$id]["tmp_name"], "img/".$id.".".$type);
                                    
                                    //將資料庫中的檔案路徑設為從暫存位置移動到"img/[id].[副檔名]"
                                    $sql5 = "UPDATE `account` SET `image` = 'img/$id.$type' WHERE `id` = $id";
                                    mysqli_query($conn, $sql5);
                               }
                            ?>
                        <br>
                        <img src="<?php echo $row["image"] ?? "img/stranger.png" ?>" width="60%">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3">平台角色</label>
                      <div class="col-md-8">
                       <font>
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
                           ?>
                       </font>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>帳號</font></label>
                      <div class="col-md-8">
                       <font><?php echo $row[id] ?></font>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3"><font>密碼</font></label>
                      <div class="col-md-8">
                       <font>********</font>
                       <button class="btn btn-link" type="button" data-toggle="modal" data-target="#password"  align="right"><font>修改密碼</font></button>
                      </div>
                    </div>
                   <div class="form-group row">
                      <label class="control-label col-md-3"><font>Email</font></label>
                      <div class="col-md-8">
                        <font><?php echo $row[email] ?></font>
                        <button class="btn btn-link" type="button" data-toggle="modal" data-target="#email"  align="right"><font>修改Email</font></button>
                      </div>
                    </div>
                    <div class="tile-footer">
                      <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                          <input class="btn btn-primary" type="submit" value="上傳頭像">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <p style="text-align: right">
              <a href="account.php"><button class="btn btn-primary">回上一頁</button></a>
            </p>
          </div>
        </div>
      </div>
      <form method="post">
         <div class="modal fade" id="email">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" >       
                 <br>
                 <div class="form-group row">
                   <label class="control-label col-md-3"><font>目前Email</font></label>
                   <div class="col-md-8">
                     <font><?php echo $row[email] ?></font>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="control-label col-md-3"><font>新的Email</font></label>
                   <div class="col-md-8">
                     <input class="form-control" type="email" name="email" required>
                   </div>
                 </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <input class="btn btn-danger" type="submit" value="完成">&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <form method="post">
        <div class="modal fade" id="password">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" >       
                 <br>
                 <div class="form-group row">
                   <label class="control-label col-md-3"><font>目前密碼</font></label>
                   <div class="col-md-8">
                     <?php echo $row[password] ?>
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="control-label col-md-3"><font>新密碼</font></label>
                   <div class="col-md-8">
                     <input class="form-control" type="password" name="new_password">
                   </div>
                 </div>
                 <div class="form-group row">
                   <label class="control-label col-md-3"><font>確認新密碼</font></label>
                   <div class="col-md-8">
                     <input class="form-control" type="password" name="check_password">
                   </div>
                 </div>
                 <?php echo $error; ?>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <input class="btn btn-danger" type="submit" value="完成">&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    <?php
        }
     ?>
    </main>
  </body>
</html>