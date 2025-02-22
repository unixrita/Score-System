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

    $sql = "SELECT *
            FROM team t, account a
            WHERE t.team_id = a.team_id AND id = '$id'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>檔案上傳</title>
    <meta charset="utf-8">
  </head>
  <body class="app sidebar-mini rtl">
   <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
     <?php
        while($row = mysqli_fetch_array($result)){
            $team_id = $row[team_id];
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
              ?>
          </p>
        </div>
      </div>
      <ul class="app-menu">
          <li><a class="app-menu__item" href="member_student.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
          <li><a class="app-menu__item active" href="upload_student.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li> 
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">檔案上傳</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>檔案上傳</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <font>第<?php echo $row[team_id]?>組</font>
                      </div>
                      <div class="form-group">
                        <font>專題名稱：<?php echo $row[team_name]?></font>
                      </div>
                      <div class="form-group">
                        <font>指導老師：<?php echo $row[teacher]?></font>
                      </div>
                <?php
                    }
                ?>
                      <div class="form-group">
                           <font>組員：
                              <?php
                                   $sql2 = "SELECT *
                                            FROM team t, account a
                                            WHERE t.team_id = a.team_id AND t.team_id = '$team_id' AND right_level = 3";
                                   $result2 = mysqli_query($conn, $sql2);
                                   while($row2 = mysqli_fetch_array($result2)){
                                        echo $row2[name],"&nbsp;&nbsp;";
                                  }
                               ?>
                           </font>
                      </div>
                      <div class="form-group">
                        <label class="control-label">專題檔案&nbsp;&nbsp;<small class="text-muted"><font>(僅限PDF)</font></small></label>
                        <input class="form-control" name='pdf' type="file" accept="application/pdf" required>
                        <?php
                            if(isset($_FILES['pdf'])){
                                echo '檔案名稱：' . $_FILES['pdf']['name'] . '<br/>';

                                //取得檔案的副檔名
                                $type = str_replace("application/", "", $_FILES['pdf']['type']);

                                //將檔案從暫存位置移動到"team_file/[組別id].[副檔名]"
                                move_uploaded_file($_FILES["pdf"]["tmp_name"], "team_file/".$team_id.".".$type);

                                //將資料庫中的檔案路徑設為從暫存位置移動到"team_file/[組別id].[副檔名]"
                                $sql4 = "UPDATE `team` SET `team_file` = 'team_file/$team_id.$type' WHERE `team_id` = $team_id";
                                mysqli_query($conn, $sql4);
                           }
                        ?>
                      </div>
                      <div>
<!--                        <a class="btn btn-info" id="demoSwal" href="#">確定</a>-->
                        <input class="btn btn-info" type="submit" value="送出">
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<!--
    <script type="text/javascript">
      $('#demoSwal').click(function(){
      	swal({
      		title: "確定將檔案上傳?",
      		type: "warning",
      		showCancelButton: true,
      		confirmButtonText: "是，確認上傳",
      		cancelButtonText: "否，取消上傳",
      		closeOnConfirm: false,
      		closeOnCancel: false
      	}, function(isConfirm) {
      		if (isConfirm) {
      			swal("上傳成功!", "已上傳至專題評分管理系統<?php echo "嗨";?>", "success");
      		} else {
      			swal("取消上傳!", " ", "error");
      		}
      	});
      });
    </script>
-->
  </body>
</html>