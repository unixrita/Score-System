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
    <title>組員管理</title>
    <meta charset="utf-8">
  </head>
  <body class="app sidebar-mini rtl">
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
     <?php
        $sql = "SELECT * FROM account WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $right_level = $row["right_level"];
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
          <li><a class="app-menu__item active" href="member_manager.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
          <li><a class="app-menu__item" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
          <li><a class="app-menu__item" href="upload_manager.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
          <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">組員管理</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>組員管理</font></a></li>
        </ul>
      </div>
    <?php
        $sql2 = "SELECT * FROM team";
        $result2 = mysqli_query($conn, $sql2);
        $team_id = 0;
        while($row2 = mysqli_fetch_array($result2)){
            $team_id += 1;
            $sql3 = "SELECT * FROM team WHERE team_id = '$team_id'";
            $result3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_array($result3)){
     ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="tile">
                    <div class="row">
                      <div class="col-lg-6">
                        <form>
                          <div class="form-group">
                            <font>第<?php echo $row3[team_id]?>組</font>
                          </div>
                          <div class="form-group">
                            <font>專題名稱：<?php echo $row3[team_name]?></font>
                          </div>
                          <div class="form-group">
                            <font>指導老師：<?php echo $row3[teacher]?></font>
                          </div>
                          <div class="form-group">
                            <font>組員：
                              <?php
                                   $sql4 = "SELECT *
                                            FROM team t, account a
                                            WHERE t.team_id = a.team_id AND t.team_id = '$team_id' AND right_level = 3";
                                   $result4 = mysqli_query($conn, $sql4);
                                   while($row4 = mysqli_fetch_array($result4)){
                                        echo $row4[name],"&nbsp;&nbsp;";
                                  }
                               ?>
                           </font>
                            <button type="button" class="btn btn-primary icon-btn btn-sm" data-toggle="modal" data-target="#<?php echo $row3[team_id]?>"  align="right"><i class="fa fa-plus"></i><font>編輯組員</font></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- 視窗內容 (Modal) -->
            <?php
                $searchtxt = $_GET["searchtxt"];
            ?>
            <div class="modal fade" id="<?php echo $row3[team_id]?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body" >       
                     <br>
                     <nav class="navbar navbar-light bg-light">
                       <a class="navbar-brand"><font>選擇組員</font></a>
                       <form class="form-inline">
                         <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchtxt">
                         <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                       </form>
                     </nav>
                    <table class="table">
                      <tbody>
                       <tr>
                       <?php
                            if(empty($searchtxt)){
                              $sql5 = "SELECT * FROM account WHERE right_level = 3 ORDER BY name DESC";
                            }
                            else{
                              $sql5 = "SELECT * FROM account WHERE right_level = 3 AND name = '$searchtxt'";
                            }

                            $result5 = mysqli_query($conn, $sql5);
                            $count = 0;
                            while($row5 = mysqli_fetch_array($result5)){
                                $count += 1; 
                        ?> 
                                <td>
                                    <?php
                                        if($row5[team_id] == $team_id){
                                    ?>
                                            <a href="uncheck.php?id=<?php echo $row5[id]; ?>&&right_level=<?php echo $right_level; ?>" style="color:black">
                                                <img src="img/checked.png" width="10px">
                                                <font>&nbsp;<?php echo $row5[name]?></font>
                                            </a>
                                    <?php
                                        }else{
                                    ?>
                                            <a href="check.php?id=<?php echo $row5[id]; ?>&&team_id=<?php echo $team_id; ?>&&right_level=<?php echo $right_level; ?>" style="color:black">
                                                <img src="img/uncheck.png" width="10px">
                                                <font>&nbsp;<?php echo $row5[name]?></font>
                                            </a>
                                    <?php
                                        }
                                    ?>
                                </td> 
                        <?php
                                if($count%5==0){
                                    echo "</tr><tr>";
                                }
                            }
                        ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">確定
                    </button>
                  </div>
                </div>
              </div>
            </div>
  <?php
          }
      }
      mysqli_close($conn);
  ?> 
    </main>
  </body>
</html>