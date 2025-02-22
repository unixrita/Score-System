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
    <title>帳號管理</title>
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
          <li><a class="app-menu__item active" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
          <li><a class="app-menu__item" href="upload_manager.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
          <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">帳號管理</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index_manager.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>帳號管理</font></a></li>
        </ul>
      </div>
      
      <?php
        
        for($right_level=1; $right_level<=3; $right_level++){
     ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">
                <form>
                  <div class="tile-title-w-btn">
                    <h3 class="title">
                      <font>
                        <?php
                            if($right_level==1){
                                echo "管理員";
                            }
                            else if($right_level==2){
                                echo "教師";
                            }
                            else{
                                echo "學生";
                            }
                         ?>
                      </font>
                    </h3>
                    <div class="btn-group">
                        <a class="btn btn-primary" href="account_add.php?right_level=<?php echo $right_level ?>"><i class="fa fa-lg fa-plus"></i><font>新增</font></a>
                        <a class="btn btn-primary" href="account_change_menu.php?right_level=<?php echo $right_level ?>"><i class="fa fa-lg fa-edit"></i><font>修改</font></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $right_level?>" style="color:white"><i class="fa fa-lg fa-trash"></i><font>刪除</font></a>
                    </div>
                  </div>
                  <div class="form-group">
                    <font>現有帳號</font>
                  </div>
                  <div class="form-group">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                         <?php
                             $sql2 = "SELECT * FROM account WHERE right_level = '$right_level'";
                             $result2 = mysqli_query($conn, $sql2);
                             $count = 0;
                             while($row2 = mysqli_fetch_array($result2)){
                                 $count += 1;
                          ?>
                              <td><font><?php echo $row2[name]?></font></td>       
                         <?php
                             if($count%5==0){
                                 echo "</tr><tr>";
                             }
                        }
                         ?>
                      </tbody>
                    </table>
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
        <div class="modal fade" id="<?php echo $right_level?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" >       
                 <br>
                 <nav class="navbar navbar-light bg-light">
                   <a class="navbar-brand"><font>刪除組員</font></a>
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
                          $sql3 = "SELECT * FROM account WHERE right_level = '$right_level'";
                        }
                        else{
                          $sql3 = "SELECT * FROM account WHERE right_level = '$right_level' AND name = '$searchtxt'";
                        }

                        $result3 = mysqli_query($conn, $sql3);
                        $count = 0;
                        while($row3 = mysqli_fetch_array($result3)){
                            $count += 1; 
                    ?> 
                            <td>
                                <a href="account_delete.php?id=<?php echo $row3[id]; ?>" style="color:black">
                                    <i class="fa fa-lg fa-times-circle" style="color:red"></i>
                                    <font>&nbsp;<?php echo $row3[name]?></font>
                                </a>
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
          mysqli_close($conn);
      ?> 
    </main>
  </body>
</html>