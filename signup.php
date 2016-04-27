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
      window.alert("你已經登入! 無須註冊新帳號!");
      window.location.assign("index.php");
    </script>
<?php 
  }
?>
<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");

if(isset($_POST["action"])&&($_POST["action"]=="join")){
  //找尋帳號是否已經註冊
  $query_RecFindUser = "SELECT `username` FROM `user` WHERE `username`='".$_POST["username"]."'";
  $RecFindUser=mysql_query($query_RecFindUser);
  $query_RecFindEmail = "SELECT `email` FROM `user` WHERE `email`='".$_POST["email"]."'";
  $RecFindEmail=mysql_query($query_RecFindEmail);
  if (mysql_num_rows($RecFindUser)>0){
    header("Location: signup.php?errMsg=1&username=".$_POST["username"]);
  }elseif(mysql_num_rows($RecFindEmail)>0){
    header("Location: signup.php?errMsg=2&email=".$_POST["email"]);
  }else{
  //若帳號可用，執行新增的動作  
    $query_insert = "INSERT INTO `user` (`nickname` ,`username` ,`password` ,`u_sex` ,`email`) VALUES (";
    $query_insert .= "'".$_POST["nickname"]."',";
    $query_insert .= "'".$_POST["username"]."',";
    $query_insert .= "'".md5($_POST["password"])."',";
    $query_insert .= "'".$_POST["u_sex"]."',";
    $query_insert .= "'".$_POST["email"]."')";
    mysql_query($query_insert);
    $_SESSION["loginUser"]=$_POST["username"];
    ?>
    <script type="text/javascript">
      window.alert("註冊成功! 你可以開始在留言板上留言!");
      window.location.assign("index.php");
    </script>
<?php
  }
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
  <title>註冊</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/ie-emulation-modes-warning.js"></script>
  <script language="javascript">
function checkForm(){
  if(document.formJoin.username.value==""){   
    alert("請填寫帳號!");
    document.formJoin.username.focus();
    return false;
  }else{
    uid=document.formJoin.username.value;
    if(uid.length<2 || uid.length>8){
      alert( "您的帳號長度只能2至8個字元!" );
      document.formJoin.username.focus();
      return false;
    }
    if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
      alert("您的帳號第一字元只能為小寫字母!" );
      document.formJoin.username.focus();
      return false;
    }
    for(idx=0;idx<uid.length;idx++){
      if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
        alert("帳號不可以含有大寫字元!" );
        document.formJoin.username.focus();
        return false;
      }
      if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
        alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
        document.formJoin.username.focus();
        return false;
      }
      if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
        alert( "「_」符號不可相連 !\n" );
        document.formJoin.username.focus();
        return false;       
      }
    }
  }
  if(!check_password(document.formJoin.password.value,document.formJoin.passwordrecheck.value)){
    document.formJoin.password.focus();
    return false;
  } 
  if(document.formJoin.nickname.value==""){
    alert("請填寫姓名!");
    document.formJoin.nickname.focus();
    return false;
  }
  if(document.formJoin.email.value==""){
    alert("請填寫電子郵件!");
    document.formJoin.email.focus();
    return false;
  }
  if(!checkmail(document.formJoin.email)){
    document.formJoin.email.focus();
    return false;
  }
  return confirm('確定送出嗎？');
}
function check_password(pw1,pw2){
  if(pw1==''){
    alert("密碼不可以空白!");
    return false;
  }
  for(var idx=0;idx<pw1.length;idx++){
    if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
      alert("密碼不可以含有空白或雙引號 !\n");
      return false;
    }
    if(pw1.length<4 || pw1.length>16){
      if(pw1.length<4){
        alert( "密碼長度必須大於等於4 !\n" );
      }else{
        alert( "密碼長度必須小於等於16 !\n" );
      }
      return false;
    }
    if(pw1!= pw2){
      alert("密碼二次輸入不一樣,請重新輸入 !\n");
      return false;
    }
  }
  return true;
}
function checkmail(myEmail) {
  var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(filter.test(myEmail.value)){
    return true;
  }
  alert("電子郵件格式不正確");
  return false;
}
</script>
</head>

<body class="custom-signin">
  <div class="container">
    <div align="center">

      <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <div class="alert alert-danger" id="myAlert"><h1>
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Oops!</strong> <?php echo $_GET["username"]; ?> 這個帳號已經被使用</h1>
        </div>
      <?php }elseif(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="2")){?>
        <div class="alert alert-danger" id="myAlert"><h1>
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Oops!</strong> <?php echo $_GET["email"]; ?> 這個信箱已經被使用</h1>
        </div>
      <?php } ?>

    </div>
    <form action="" method="POST" name="formJoin" id="formJoin" class="form-signin" role="form" onSubmit="return checkForm();">
      

      <h2 class="form-signin-heading">註冊新帳號</h2>

      <h3>帳號</h3><input name="username" id="username" type="text" class="form-control" placeholder="Username">
      <h3>密碼</h3><input name="password" id="password" type="password" class="form-control" placeholder="Password">
      <h3>再次確認密碼</h3><input name="passwordrecheck" id="passwordrecheck" type="password" class="form-control" placeholder="Password">
    
      <h2 class="form-signin-heading">設定使用者資料</h2><br>
      <p style="font-size: 20px;">性別　　
        <input name="u_sex" type="radio" value="女" checked> <img src="/images/female.svg" style="width: 20px; height: 20px;"> 女生　
        <input name="u_sex" type="radio" value="男"> <img src="/images/male.svg" style="width: 20px; height: 20px;"> 男生
      </p><br>
      <label for=inputNickname class=sr-only>暱稱</label>
      <div class="input-group">
        <span class="input-group-addon">　暱稱　</span>
        <input name="nickname" id="nickname" type="text" class="form-control" placeholder="Nickname">
      </div>
      <br>
      <!--
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-lg btn-danger active">
          <input type="radio" name="u_sex" id="option1" autocomplete="off" value="女" checked>女
        </label>
        <label class="btn btn-lg btn-primary">
          <input type="radio" name="u_sex" id="option2" autocomplete="off" value="男">男
        </label>
      </div>
      -->
      
      <div class="input-group">
        <span class="input-group-addon">電子郵件</span>
        <input name="email" id="email" type="text" class="form-control" placeholder="Email Address">
      </div>
      <br style="line-height: 2.0;">
      <input name="action" type="hidden" id="action" value="join">
      <button type="submit" class="btn btn-lg btn-primary btn-block">送出申請 Submit</button>
      <button type="reset" class="btn-lg btn-danger btn-block">重新填寫 Reset</button>
      <a href="index.php" class="btn btn-lg btn-default btn-block">回首頁 Home</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
