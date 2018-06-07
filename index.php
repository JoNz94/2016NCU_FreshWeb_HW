<!DOCTYPE html>
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
    $query_User = "SELECT `nickname`,`username`,`permission` FROM `user` WHERE `username`='".$username."'";
    $User = mysqli_query($conn, $query_User);
    $row_User = mysqli_fetch_assoc($User);
    $username = $row_User["username"];
    $nickname = $row_User["nickname"];
    //帳號等級為 member
    if($row_User["permission"]=="member"){
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
    $RecLogin = mysqli_query($conn, $query_RecLogin);   
    //取出帳號密碼的值
    $row_RecLogin = mysqli_fetch_assoc($RecLogin);
    //比對密碼，若登入成功則呈現登入狀態
    if( md5($_POST["password"]) == $row_RecLogin["password"] ){
      //設定登入者的名稱及等級
      $_SESSION["loginUser"] = $row_RecLogin["username"];
      //登入後重新導向留言板首頁 ?>
      <script type="text/javascript">
        window.alert("登入成功!");
        window.location.assign("index.php");
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
    header("Location: index.php");
}
?>
<!-- 留言板 PHP CODE -->
<?php
  //預設每頁筆數
  $pageRow_records = 6;
  //預設頁數
  $num_pages = 1;
  //若已經有翻頁，將頁數更新
  if (isset($_GET['page'])) {
    $num_pages = floor($_GET['page']);
    if ($num_pages < 1 ) {
?>
    <script type="text/javascript">
      window.alert("該頁面不存在!\n將被轉移至首頁!");
      window.location.assign("index.php");
    </script>
<?php
    }
  }
  //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
  $startRow_records = ($num_pages -1) * $pageRow_records;
  //未加限制顯示筆數的SQL敘述句
  $query_RecComment = "SELECT `comment`.*, `user`.`nickname` ,`user`.`username` FROM `comment`,`user` WHERE `comment`.`user_id`=`user`.`id` ORDER BY `comment`.`time` DESC";
  //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
  $query_limit_RecComment = $query_RecComment." LIMIT ".$startRow_records.", ".$pageRow_records;
  //以加上限制顯示筆數的SQL敘述句查詢資料到 $RecComment 中
  $RecComment = mysqli_query($conn, $query_limit_RecComment);
  //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecComment 中
  $all_RecComment = mysqli_query($conn, $query_RecComment);
  //計算總筆數
  $total_records = mysqli_num_rows($all_RecComment);
  //計算總頁數=(總筆數/每頁筆數)後無條件進位。
  $total_pages = ceil($total_records/$pageRow_records);
  if ($total_pages==0) {
    $total_pages = 1;
  }
  if ($num_pages > $total_pages) {
?>
    <script type="text/javascript">
      window.alert("該頁面不存在!\n將被轉移至首頁!");
      window.location.assign("index.php");
    </script>
<?php
  }
?>

<html lang="zh-Hant-TW">

<head>
  <meta charset="utf-8">
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <meta name=description content="">
  <meta name=author content="">
  <link rel="icon" href="/images/icon.jpg">
  <title>首頁</title>
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
          <li class="active"><a href="#">留言板</a></li>
          <li><a href="about.php#">關於此站</a></li>
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
            <a class="btn btn-success" href="post.php" role=button>留言</a>
            <a class="btn btn-info" href="update.php" role=button>設定</a>
            <a class="btn btn-danger" href="?logout=true" role=button>登出</a></font>
          </form>
        <?php } ?>
      </div>
    </div>
  </nav>
  <div class=jumbotron>
    <div class=container>
      <div class=row>
        <div class=col-md-4>
          <h1>留言板です</h1>
          <p>不用懷疑，這就是留言板。</p>
          <p>
            <?php if( $lv != "guest" ){ ?>
            <a class="btn btn-success btn-lg" href="post.php" role=button>開始留言 &raquo;</a>
            <?php }else{ ?>
            <a class="btn btn-info btn-lg" href="signup.php" role=button>註冊帳號 &raquo;</a>
            <?php }?>
            <a class="btn btn-primary btn-lg" href="about.php" role=button>了解更多 &raquo;</a>
          </p>
        </div>
        <div class=col-md-4 style="padding-top: 40px;">
          <?php if( $lv === "guest" ){ ?>
            <ul class="list-group">
              <li class="list-group-item list-group-item-success"><h4 align="center">留言板需要註冊帳號並登入後才能留言</h4></li>
              <li class="list-group-item list-group-item-danger"><h4 align="center">訪客只能瀏覽留言</h4></li>
            </ul>
          <?php } ?>
        </div>
        <div class=col-md-4></div>
      </div>
    </div>
  </div>
  <div class=container>
  <?php $colcounter=3;
  while($row_RecComment=mysqli_fetch_assoc($RecComment)){ ?>
    <?php if($colcounter==3){
      $colcounter=0;?>
      <div class=row>
      <?php 
    }?>
      <div class=col-md-4>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3><?php echo $row_RecComment["subject"];?><br>
            <small><?php echo $row_RecComment["nickname"];?> さん</small></h3></div>
          <div class="panel-body">
            <p><?php echo nl2br($row_RecComment["content"]);?></p>
            <p style="text-align: right; margin-right: 15px;">
              <?php if( $lv!="guest"){ ?>
              <a class="btn btn-success" href="recomment.php" role=button>回覆 &raquo;</a>
                <?php if ( $lv=="admin" || $row_RecComment["username"]==$username){ ?>
              <a class="btn btn-primary" href="edit.php?id=<?php echo $row_RecComment["id"];?>" role=button>修改 &raquo;</a>
              <a class="btn btn-danger" href="delete.php?id=<?php echo $row_RecComment["id"];?>" role=button>刪除 &raquo;</a>
              <?php } } ?>
              <a class="btn btn-default" href="view.php?id=<?php echo $row_RecComment["id"];?>" role=button>看個詳細 &raquo;</a>
            </p>
          </div>
        </div>
      </div>
    <?php $colcounter++;
    if($colcounter==3){ ?> 
      </div><?php
    }
  }
  if($colcounter!=3){ ?></div><?php } ?>
    <div class="panel panel-default" align="center">
      <div class=row>
        <div class=col-md-4>
          <h2>第 <?php echo $num_pages; ?> 頁</h2>
        </div>
        <div class=col-md-4 style="text-align: center; padding: 12px 0px;">
          <h4 align="center">
          <?php if($total_pages<=1){ ?> 只有一頁
          <?php }elseif($total_pages==2){
            if($num_pages==1){ ?>
              <a href="?page=2">最末頁</a>
          <?php }else{ ?>
              <a href="?page=1">第一頁</a>
          <?php }
          }else{
            if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
              <a href="?page=1">第一頁</a> 
            <?php }
            if ($num_pages > 2){ ?>
              | <a href="?page=<?php echo $num_pages-1;?>">上一頁</a> 
            <?php }
            if ($num_pages > 1 && $num_pages < $total_pages){ ?> | <?php }
            if ($num_pages < $total_pages-1) { // 若不是最後一頁則顯示 ?>
              <a href="?page=<?php echo $num_pages+1;?>">下一頁</a> |
            <?php }
            if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
              <a href="?page=<?php echo $total_pages;?>">最末頁</a>
            <?php }
          } ?>
          </h4>
        </div>
        <div class=col-md-4>
          <h2>共 <?php echo $total_pages; ?> 頁</h2>
        </div>
      </div>
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
</html>
