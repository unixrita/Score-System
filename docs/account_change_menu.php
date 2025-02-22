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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>修改<?php echo $identity; ?>帳號</title>
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
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">修改<?php echo $identity; ?>帳號</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="account.php" style="color:black"><font>帳號管理</font></a></li>
          <li class="breadcrumb-item"><a href="#" style="color:black"><font>修改<?php echo $identity; ?>帳號</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
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
                    <td><button class="btn btn-link" type="button" onclick="location.href='account_change.php?id=<?php echo $row2[id]?>'"><font><?php echo $row2[name]?></font></button></td>       
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
        </div>
      </div>
    </main>
  </body>
</html>