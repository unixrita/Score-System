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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>專題評分</title>
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
              ?>
          </p>
        </div>
      </div>
      <ul class="app-menu">
         <?php
            if($row["right_level"]==1){
          ?>
              <li><a class="app-menu__item active" href="member_manager.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
              <li><a class="app-menu__item" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
              <li><a class="app-menu__item" href="upload_manager.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
              <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li> 
         <?php
            }else{
          ?>
              <li><a class="app-menu__item" href="member_s_t.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
             <li><a class="app-menu__item" href="change_information.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號設定</font></span></a></li>
             <li><a class="app-menu__item" href="file.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案查看</font></span></a></li>
             <li><a class="app-menu__item active" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li> 
         <?php
            }
        }
          ?>  
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">專題評分</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>專題評分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form method="get">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th><font>組別</font></th>
                      <th><font>專題名稱</font></th>
                      <th><font>評分狀態</font></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                          $team_score = $_POST["score"];
                          $comment = $_POST["comment"];
                          $team_id = $_GET["team_id"];

                          if(isset($team_score)){
                              $sql4 = "UPDATE `score` SET `score` = '$team_score' WHERE `team_id` = $team_id and `id` = $id";
                              mysqli_query($conn, $sql4);
                          }
                          if(isset($comment)){
                              $sql4 = "UPDATE `score` SET `comment` = '$comment' WHERE `team_id` = $team_id and `id` = $id";
                              mysqli_query($conn, $sql4);
                          } 
                      
                          $sql2 = "SELECT t.team_id, t.team_name, s.score
                                   FROM score s, team t
                                   WHERE t.team_id=s.team_id AND id = $id";
                          $result2 = mysqli_query($conn, $sql2);
                          while($row2 = mysqli_fetch_array($result2)){
                              $team_id = $row2[team_id];
                      ?>
                        <tr>
                          <td><?php echo $row2[team_id];?></td>
                          <td><?php echo $row2[team_name];?></td>
                          <td>
                             <?php
                                  if($row2[score] == 0){
                              ?>
                                      <font color="red">未評分</font>
                             <?php
                                  }else{
                              ?>
                                      <font color="#00AA00">已評分</font>
                              <?php
                                  }
                              ?>
                          </td>
                          <td><a href="score_team.php?team_id=<?php echo $row2[team_id];?>"><button class="btn btn-primary btn-sm" type="button"><font>評分</font></button></a></td>
                        </tr>
                      <?php
                          }
                      ?>
                  </tbody>
                </table>
            </form>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>