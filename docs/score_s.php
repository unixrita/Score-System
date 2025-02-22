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
    
    $sql4 = "SELECT * FROM account WHERE id = '$id'";
    $result4 = mysqli_query($conn, $sql4);
    while($row4 = mysqli_fetch_array($result4)){
        $team_id = $row4[team_id];
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>專題評分_第<?php echo $team_id; ?>組</title>
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
              <li><a class="app-menu__item" href="member_manager.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
              <li><a class="app-menu__item" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
              <li><a class="app-menu__item" href="upload_manager.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
         <?php
            }
        }
          ?>
          <li><a class="app-menu__item active" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">專題評分_第<?php echo $team_id; ?>組</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index_teacher.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="score.php" style="color:black"><font>專題評分</font></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>第1組&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form method="post" action="score.php?team_id=<?php echo $team_id; ?>">
                   <?php
                        $sql2 = "SELECT * FROM team WHERE team_id = '$team_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        while($row2 = mysqli_fetch_array($result2)){
                    ?>
                          <div class="form-group">
                            <font>第<?php echo $row2[team_id]?>組</font>
                          </div>
                          <div class="form-group">
                            <font>專題名稱：<?php echo $row2[team_name]?></font>
                          </div>
                          <div class="form-group">
                            <font>指導老師：<?php echo $row2[teacher]?></font>
                          </div>
                      <div class="form-group">
                           <font>組員：
                              <?php
                                   $sql3 = "SELECT *
                                            FROM team t, account a
                                            WHERE t.team_id = a.team_id AND t.team_id = '$team_id' AND right_level = 3";
                                   $result3 = mysqli_query($conn, $sql3);
                                   while($row3 = mysqli_fetch_array($result3)){
                                        echo $row3[name],"&nbsp;&nbsp;";
                                  }
                               ?>
                           </font>
                      </div>
                      <div class="form-group">
                        <font>分數</font>
                           <?php
                               $sql5 = "SELECT * FROM score WHERE team_id = '$team_id'";
                               $result5 = mysqli_query($conn, $sql5);
                               while($row5 = mysqli_fetch_array($result5)){
                                    echo $row5[score];
                              }
                            ?>
                      </div>
                    <?php
                         }
                     ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>