<!--檢查是否已經登入-->
<?php 
  header("Content-Type: text/html; charset=utf-8;");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否已經登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
    //已經登入，載入會員資料
    $query_RecUser = "SELECT * FROM `user` WHERE `username`='".$_SESSION["loginUser"]."'";
    $RecUser = mysql_query($query_RecUser); 
    $row_RecUser = mysql_fetch_assoc($RecUser);
  }else{
    //尚未登入，轉到登入畫面
?>
    <script type="text/javascript">
      window.alert("你尚未登入!");
      window.location.assign("login.php");
    </script>
<?php 
  }
  //更新會員資料
  if(isset($_POST["action"])&&($_POST["action"]=="update")){  
    $query_update = "UPDATE `user` SET ";
    //若有修改密碼，則更新密碼。
    if(($_POST["password"]!="")&&($_POST["password"]==$_POST["passwordrecheck"])){
      $query_update .= "`password`='".md5($_POST["password"])."',";
    } 
    $query_update .= "`nickname`='".$_POST["nickname"]."',";  
    $query_update .= "`sex`='".$_POST["sex"]."',";
    $query_update .= "`email`='".$_POST["email"]."' ";
    $query_update .= "WHERE `id`=".$row_RecUser["id"];  
    mysql_query($query_update);

    //若有修改密碼，則登出回到首頁。
    if(($_POST["password"]!="")&&($_POST["password"]==$_POST["passwordrecheck"])){
      unset($_SESSION["loginUser"]);
?>
      <script type="text/javascript">
        window.alert("成功修改密碼! 請重新登入!");
        window.location.assign("login.php");
      </script>
<?php
    }
    //重新導向 ?>  
    <script type="text/javascript">
      window.alert("成功修改會員資料!");
      window.location.assign("index.php");
    </script>
<?php
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
  <title>修改會員資料</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/ie-emulation-modes-warning.js"></script>
  <script language="javascript">
function checkForm(){
  if(document.formJoin.password.value!="" || document.formJoin.passwordrecheck.value!=""){
    if(!check_password(document.formJoin.password.value,document.formJoin.passwordrecheck.value)){
      document.formJoin.password.focus();
      return false;
    }
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
    if(pw1.length<5 || pw1.length>10){
      alert( "密碼長度只能5到10個字母 !\n" );
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
    <form action="" method="POST" name="formJoin" id="formJoin" class="form-signin" role="form" onSubmit="return checkForm();">
      <h2 class="form-signin-heading">修改密碼<br><small style="color: red;">* 若不修改密碼，可不用填寫。<br>* 重設密碼後必須重新登入</small></h2>
      <h3>帳號</h3><input type="text" class="form-control" value="<?php echo $row_RecUser["username"]; ?>" readonly>
      <h3>密碼</h3><input name="password" id="password" type="password" class="form-control" placeholder="Password">
      <h3>再次確認密碼</h3><input name="passwordrecheck" id="passwordrecheck" type="password" class="form-control" placeholder="Password">
    
      <h2 class="form-signin-heading">修改其他資料</h2><br>
      <p style="font-size: 20px;">性別　　
        <input name="sex" type="radio" value="女" <?php if($row_RecUser["sex"]=="女"){ echo "checked"; } ?>> 
        <img src="/images/female.svg" style="width: 20px; height: 20px;"> 女生　
        <input name="sex" type="radio" value="男" <?php if($row_RecUser["sex"]=="男"){ echo "checked"; } ?>> 
        <img src="/images/male.svg" style="width: 20px; height: 20px;"> 男生
      </p><br>
      <label for=inputNickname class=sr-only>暱稱</label>
      <div class="input-group">
        <span class="input-group-addon">　暱稱　</span>
        <input name="nickname" id="nickname" type="text" class="form-control" placeholder="Nickname" value="<?php echo $row_RecUser["nickname"]; ?>" required>
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
        <input name="email" id="email" type="text" class="form-control" placeholder="Email Address" value="<?php echo $row_RecUser["email"]; ?>" required>
      </div>
      <br style="line-height: 2.0;">
      <input name="action" type="hidden" id="action" value="update">
      <button type="submit" class="btn btn-lg btn-primary btn-block">提交 Submit</button>
      <button type="reset" class="btn-lg btn-danger btn-block">復原 Reset</button>
      <a href="index.php" class="btn btn-lg btn-default btn-block">回首頁 Home</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
