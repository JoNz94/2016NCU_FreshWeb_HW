<!--檢查是否已經登入-->
<?php 
  header("Content-Type: text/html; charset=utf-8;");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否已經登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
    //已經登入，轉回首頁
    ?>
    <script type="text/javascript">
      window.alert("你已經登入! 無須再次登入!");
      window.location.assign("index.php");
    </script>
<?php 
  }
  //執行會員登入
  if(isset($_POST["username"]) && isset($_POST["password"])){   
    //繫結登入會員資料
    $query_RecLogin = "SELECT * FROM `user` WHERE `username`='".$_POST["username"]."'";
    $RecLogin = mysql_query($query_RecLogin);   
    //取出帳號密碼的值
    $row_RecLogin=mysql_fetch_assoc($RecLogin);
    $username = $row_RecLogin["username"];
    $password = $row_RecLogin["password"];
    //比對密碼，若登入成功則呈現登入狀態
    if(md5($_POST["password"])==$password){
      //設定登入者的名稱及等級
      $_SESSION["loginUser"]=$username;
      //登入後重新載入畫面 ?>
      <script type="text/javascript">
        window.alert("登入成功!");
        window.location.assign("index.php");
      </script>
  <?php
    }else{?>
    <script type="text/javascript">
      window.alert("錯誤的帳號或密碼!");
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
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>登入</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/ie-emulation-modes-warning.js"></script>
</head>

<body class="custom-signin">
  <div class="container">
    <form class="form-signin" role="form" method="post" action="">
      <h2 class="form-signin-heading">登入</h2>
      <label for="inputEmail" class="sr-only">帳號</label>
      <h3>帳號</h3><input name="username" id="username" type="text" class="form-control" placeholder="Username" required>
      <label for=inputPassword class=sr-only>密碼</label>
      <h3>密碼</h3><input name="password" id="password"  type="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
      <br><h4>沒有帳號？ 註冊帳號！</h4>
      <a class="btn btn-lg btn-info btn-block" href="signup.php" role=button>註冊</a>
      <br><h4>忘記密碼？ 恭喜ＧＧ！</h4>
      <a class="btn btn-lg btn-default btn-block" href="index.php" role=button>回首頁</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
