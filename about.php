<!-- 會員系統 PHP CODE -->
<?php 
  header("Content-Type: text/html; charset=utf-8");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否經過登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
  //有登入
    $username = $_SESSION["loginUser"];
    $query_RecUser = "SELECT `nickname`,`permission` FROM `user` WHERE `username`='".$username."'";
    $RecUser = mysql_query($query_RecUser);
    $row_RecUser = mysql_fetch_assoc($RecUser);
    $nickname = $row_RecUser["nickname"];
    //帳號等級為 member
    if($row_RecUser["permission"]=="member"){
      $lv="member";
    //帳號等級為 admin
    }else{
      $lv="admin"; 
    }
  //沒登入、為 guest
  }else{
    $lv="guest";
  }

  //執行會員登入
  if(isset($_POST["username"]) && isset($_POST["password"])){   
    //繫結登入會員資料
    $query_RecLogin = "SELECT * FROM `user` WHERE `username`='".$_POST["username"]."'";
    $RecLogin = mysql_query($query_RecLogin);   
    //取出帳號密碼的值
    $row_RecLogin=mysql_fetch_assoc($RecLogin);
    $username = $row_RecLogin["username"];
    //比對密碼，若登入成功則呈現登入狀態
    if(md5($_POST["password"])==$row_RecLogin["password"]){
      //設定登入者的名稱及等級
      $_SESSION["loginUser"]=$username;
      //登入後重新載入畫面 ?>
      <script type="text/javascript">
        window.alert("登入成功!");
        window.location.assign("about.php");
      </script>
  <?php
    }else{?>
    <script type="text/javascript">
      window.alert("錯誤的帳號或密碼! 請重新登入!\n將被轉移至登入畫面!");
      window.location.assign("login.php");
    </script>
  <?php
    }
  }
  //執行登出動作
  if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
    unset($_SESSION["loginUser"]);
    header("Location: about.php");
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="utf-8">
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <meta name=description content="">
  <meta name=author content="">
  <link rel="icon" href="/images/icon.jpg">
  <title>關於此站</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
  <script src="/js/ie-emulation-modes-warning.js"></script>
  <!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
</head>

<body class="custom-homepage">
  <nav class="navbar navbar-inverse navbar-fixed-top" role=navigation>
    <div class=container>
      <div class=navbar-header>
        <button type=button class="navbar-toggle collapsed" data-toggle=collapse data-target=#navbar aria-expanded=false aria-controls=navbar> <span class=sr-only>Toggle navigation</span> <span class=icon-bar></span> <span class=icon-bar></span> <span class=icon-bar></span> </button> <a class=navbar-brand href="/">小卓的留言板</a>
      </div>
      <div id=navbar class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php#">留言板</a></li>
          <li class="active"><a href="#">關於此站</a></li>
          <li class="dropdown"><a href="./" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">To Do List<span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-inverse" role="menu">
              <li><a href="todolist.php">ver. ul</a></li>
              <li><a href="todolist2.php">ver. table</a></li>
              <li><a href="todolist3.php">ver. div</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="./" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">網站地圖<span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-inverse" role="menu">
              <li class="dropdown-header">留言板</li>
              <li><a href="index.php#">觀看留言</a></li>
              <li><a href="post.php">發表留言</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">To Do List</a></li>
              <li><a href="todolist.php">ver. ul</a></li>
              <li><a href="todolist2.php">ver. table</a></li>
              <li><a href="todolist3.php">ver. div</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">會員相關</li>
              <!--下拉式選單選項，根據是否有登入而有不同顯示-->
              <?php if($lv=="guest"){ ?>
              <li><a href="login.php">登入</a></li>
              <li><a href="signup.php">註冊</a></li>
              <?php }else{ ?>
              <li><a href="update.php">更新資料</a></li>
              <li><a href="?logout=true">登出</a></li>
              <?php } ?> 
            </ul>
          </li>
          <?php if( $lv == "admin" ){ ?>
          <li><a href="/phpmyadmin/" target="_blank">資料庫管理</a></li>
          <?php } ?>
        </ul>
        <!--導覽列左側，根據是否有登入而有不同顯示-->
        <?php if($lv=="guest"){ ?>
        <form class="navbar-form navbar-right" role="form" method="post" action="">
          <div class=form-group>
            <input name="username" id="username" placeholder="帳號" class=form-control>
          </div>
          <div class=form-group>
            <input name="password" id="password" type=password placeholder="密碼" class=form-control>
          </div>
          <button type=submit class="btn btn-primary">登入</button>
          <a class="btn btn-info" href="signup.php" role=button>註冊</a>
        </form>
        <?php }else{ ?>
          <form class="navbar-form navbar-right" role="form">
            <font color="white">歡迎， <?php echo $nickname; ?> さん　
            <a class="btn btn-info" href="update.php" role=button>設定</a>
            <a class="btn btn-danger" href="?logout=true" role=button>登出</a></font>
          </form>
        <?php } ?>
      </div>
    </div>
  </nav>
  <div class=jumbotron>
    <div class=container>
      <h1>這裡是？</h1>
      <p>新生知訊網，小卓的練習區です。</p><br>
    </div>
  </div>
  <div class=container>
    <div class=row>
      <div class=col-md-6>
        <div class="panel panel-default gray" align="center">
          <h2><img src="/images/icon-bootstrap.png" style="width: 50px; height: 50px; "> Bootstrap 3</h2>
          <p>本站所使用的 CSS Framework</p>
          <p><a class="btn btn-default" href="https://kkbruce.tw/bs3" role=button>前往 &raquo;</a></p>
        </div>
      </div>
      <div class=col-md-6>
        <div class="panel panel-default"  align="center">
          <h2><img src="/images/icon-typekit.png" style="width: 50px; height: 50px; "> Adobe Typekit</h2>
          <p>本站所使用的套用字體服務</p>
          <p><a class="btn btn-default" href="https://typekit.com" role=button>前往 &raquo;</a></p>
        </div>
      </div>
      <!--div class=col-md-4>
        <div class="panel panel-default"  align="center">
          <h2><img src="/images/icon-xampp.png" style="width: 50px; height: 50px; "> XAMPP</h2>
          <p>本站所使用的網頁伺服器</p>
          <p><a class="btn btn-default" href="https://www.apachefriends.org/zh_tw/index.html" role=button>前往 &raquo;</a></p>
        </div>
      </div-->
    </div>
    <hr>
    <footer>
      <p>
        <?php if ( $lv == "admin"){ ?> 
        <span class="label label-primary">管理員</span>
        <?php }elseif( $lv == "member"){ ?>
        <span class="label label-success">會員</span>
        <?php }else{ ?>
        <span class="label label-warning">訪客</span>
        <?php } ?>
        &copy; NoCopyright 2016
      </p>
    </footer>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js></script>
  <script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js></script>
  <script src=/Scripts/AssetsBS3/ie10-viewport-bug-workaround.js></script>
</body>
