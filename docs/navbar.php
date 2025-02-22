<?php

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

    $sql = "SELECT * FROM account WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a:link,
        a:visited {
            color:#FFFFFF;
            text-decoration:none;
            }
        a:hover,
        a:active {
            color:#000000;
            text-decoration:none;
            }
        font {font-family: 微軟正黑體}
        p {font-family: 微軟正黑體}
      </style>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.php">Fjuim</a>
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="change_information.php" style="color:black"><i class="fa fa-cog fa-lg"></i><font >帳號設定</font></a></li>
              <li><a class="dropdown-item" href="logout.php" style="color:black"><i class="fa fa-sign-out fa-lg"></i><font>登出</font></a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebarF"></div>
    <aside class="app-sidebar">
     <?php
        while($row = mysqli_fetch_array($result)){
     ?>
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $row["image"] ?? "" ?>" width="25%" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo $row["name"] ?? "" ?></p>
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
             <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
        <?php
           }

           else if($row["right_level"]==2){
         ?>
             <li><a class="app-menu__item" href="member_s_t.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
             <li><a class="app-menu__item" href="change_information.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號設定</font></span></a></li>
             <li><a class="app-menu__item" href="file.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案查看</font></span></a></li>
             <li><a class="app-menu__item" href="score.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>  
        <?php
           }
            else{
         ?>
             <li><a class="app-menu__item" href="member_student.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
              <li><a class="app-menu__item" href="change_information.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號設定</font></span></a></li>
             <li><a class="app-menu__item" href="upload_student.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
               
        <?php
           }
         ?>  
      </ul>
      
      <?php
        }
      ?>
    </aside>
    
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>