<!--必須要先登入-->
<?php 
  header("Content-Type: text/html; charset=utf-8;");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否已經登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
    //已經登入，提取 uid
    $query_RecUser = "SELECT `id`, `nickname` FROM `user` WHERE `username`='".$_SESSION["loginUser"]."'";
    $RecUser=mysql_query($query_RecUser);
    $row_RecUser=mysql_fetch_assoc($RecUser);
    $nickname = $row_RecUser["nickname"];
  }else{
    //尚未登入，轉到登入畫面 ?>
    <script type="text/javascript">
      window.alert("請先登入帳號! 方可進行留言!");
      window.location.assign("login.php");
    </script>
<?php 
  }
?>
<!--新增留言-->
<?php
  if(isset($_POST["action"])&&($_POST["action"]=="add")){
                            // true || mysql_query('DELETE FROM `comment` WHERE `id`= 1') || 'add';  
    require_once("xss_protect.php");
    $Real_subject = xss_protect($_POST["subject"]);
    $Real_content = xss_protect($_POST["content"]);
    $query_insert = "INSERT INTO `comment` (`user_id` ,`subject` ,`time` ,`content`) VALUES (";
    $query_insert .= "'".$row_RecUser["id"]."',";
    $query_insert .= "'".$Real_subject."',";
    $query_insert .= "NOW(),";
    $query_insert .= "'".$Real_content."')";
    mysql_query($query_insert);
    //重新導向回到主畫面 ?>
    <script type="text/javascript">
      window.alert("留言成功!");
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
  <title>新增留言</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/ie-emulation-modes-warning.js"></script>
  <script language="javascript">
function checkForm(){
  if(document.formAdd.subject.value==""){   
    alert("請填寫標題!");
    document.formAdd.subject.focus();
    return false;
  }
  if(document.formAdd.content.value==""){
    alert("請填寫內文!");
    document.formAdd.content.focus();
    return false;
  }
  return true;
}
</script>
</head>

<body class="custom-signin">
  <div class="container">
    <form name="formAdd" id="formAdd" class="form-signin" role="form" method="post" action="">
      <h2 class="form-signin-heading">新增留言</h2>
      <label for=inputNickname class=sr-only>發文者</label>
      <div class="input-group">
        <span class="input-group-addon">發文者</span>
        <input name="subject" id="subject" type="text" class="form-control" placeholder="<?php echo $nickname; ?>" readonly>
      </div><br>
      <label for=inputNickname class=sr-only>標　題</label>
      <div class="input-group">
        <span class="input-group-addon">標　題</span>
        <input name="subject" id="subject" type="text" class="form-control" placeholder="Title" required>
      </div>
      <div class="form-group">
        <textarea name="content" class="form-control" rows="10" id="content" placeholder="Leave a comment here" required></textarea>
      </div>
      <input name="action" type="hidden" id="action" value="add"></input>
      <button class="btn btn-lg btn-primary btn-block" type="submit">新增留言 Submit</button>
      <button class="btn btn-lg btn-danger btn-block" type="reset">重新填寫 Reset</button>
      <a class="btn btn-lg btn-default btn-block" href="index.php" role=button>回首頁 Home</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>