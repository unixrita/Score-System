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
    <title>首頁</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap&subset=chinese-traditional" rel="stylesheet">
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
    <header class="app-header"><a class="app-header__logo" href="index_manager.php">Fjuim</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <!--Notification Menu-->
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="page-user.html" style="color:black"><i class="fa fa-cog fa-lg"></i><font >帳號設定</font></a></li>
              <li><a class="dropdown-item" href="page-login.html" style="color:black"><i class="fa fa-sign-out fa-lg"></i><font>登出</font></a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/manager.jpg" width="25%" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">凌楚楚</p>
          <p class="app-sidebar__user-designation">管理者</p>
        </div>
      </div>
      <ul class="app-menu">
          <li><a class="app-menu__item" href="team_member.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"><font>組員管理</font></span></a></li>
          <li><a class="app-menu__item" href="account.php"><i class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label"><font>帳號管理</font></span></a></li>
          <li><a class="app-menu__item" href="upload_file.php"><i class="app-menu__icon fa fa-file-pdf-o"></i><span class="app-menu__label"><font>檔案上傳</font></span></a></li>
          <li><a class="app-menu__item" href="score_manager.php"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label"><font>專題評分</font></span></a></li>   
      </ul>
    </aside>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><p style="font-family: 微軟正黑體; font-weight:600; font-size:30px; font-style:normal">專題評分_第1組</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index_manager.php" style="color:black"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="score_manager.php" style="color:black"><font>專題評分</font></a></li>
            <li class="breadcrumb-item"><a href="#" style="color:black"><font>第1組&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form action="score_manager.php">
                  <div class="form-group">
                    <font>第1組</font>
                  </div>
                  <div class="form-group">
                    <font>專題名稱：Doraemon</font>
                  </div>
                  <div class="form-group">
                    <font>指導老師：哆啦A夢</font>
                  </div>
                  <div class="form-group">
                    <font>組員：大雄、靜香、胖虎、小夫、蕭綰綰</font>
                  </div>
                  <div class="form-group">
                    <font>專題檔案&nbsp;&nbsp;</font>
                    <a href="#" target="_blank"><button class="btn-info" type="submit"><i class="fa fa-file-pdf-o"></i><font>&nbsp;檔案下載</font></button></a>
                  </div>
                  <div class="form-group">
                    <font>評分</font>
                    <select class="form-control" id="exampleSelect1">
                      <option>A+</option>
                      <option>A</option>
                      <option>A-</option>
                      <option>B+</option>
                      <option>B</option>
                      <option>B-</option>
                      <option>C+</option>
                      <option>C</option>
                      <option>C-</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <font>評語</font>
                    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                    </div>
                    <div>
                      <p style="text-align: left">
                      <input class="btn btn-primary" type="submit" value="完成">&nbsp;&nbsp;
                      <input class="btn btn-primary" type="reset" value="取消">
                      </p>
                    </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
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