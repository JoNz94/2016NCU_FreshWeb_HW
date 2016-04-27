<!--必須要先登入-->
<?php 
  header("Content-Type: text/html; charset=utf-8;");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否已經登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
    /* 顯示目前留言 */
    $username = $_SESSION["loginUser"];
    $query_RecComment = "SELECT * FROM `comment` WHERE `id`=".$_GET["id"];
    $RecComment = mysql_query($query_RecComment);
    $row_RecComment = mysql_fetch_assoc($RecComment);

    /* 提取 user_id & permission */
    $query_RecUser = "SELECT `id`,`permission` FROM `user` WHERE `username`='".$username."'";
    $RecUser = mysql_query($query_RecUser);
    $row_RecUser = mysql_fetch_assoc($RecUser);

    // 確認此留言是否登入者的留言
    if( $row_RecUser["permission"] != "admin" && $row_RecComment["user_id"] != $row_RecUser["id"] ){ ?>
    <script type="text/javascript">
      window.alert("這不是你的留言!\n你將被移動至首頁");
      window.location.assign("index.php");
    </script>
<?php 
    }
    
    $query_RecNickname = "SELECT `nickname` FROM `user` WHERE `user`.`id` = ".$row_RecComment["user_id"];
    if(!$RecNickname=mysql_query($query_RecNickname)){ ?>
    <script type="text/javascript">
      window.alert("該留言不存在!\n將被轉移至首頁!");
      window.location.assign("index.php");
    </script>
<?php
    }
    $row_RecNickname = mysql_fetch_assoc($RecNickname);
  }else{
    //尚未登入，轉到登入畫面 ?>
    <script type="text/javascript">
      window.alert("你尚未登入!");
      window.location.assign("login.php");
    </script>
<?php 
  }

  /* 執行刪除動作 */
  if(isset($_POST["action"])&&($_POST["action"]=="delete")){ 
    if( $row_RecUser["permission"] != "admin" && $row_RecComment["user_id"] != $_POST["id"] ){ ?>
    <script type="text/javascript">
      window.alert("這不是你的留言!\n你將被移動至首頁");
      window.location.assign("index.php");
    </script>
<?php 
    }else{
    $sql_query = "DELETE FROM `comment` WHERE `id`=".$_POST["id"];  
    mysql_query($sql_query);
  //重新導向回到主畫面 ?>
    <script type="text/javascript">
      window.alert("刪除留言成功!");
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
  <title>刪除留言</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/ie-emulation-modes-warning.js"></script>
</head>

<body class="custom-signin">
  <div class="container">
    <form class="form-signin" role="form" method="post" action="">
      <h2 class="form-signin-heading">確定要刪除此留言?</h2>
      <label for=inputNickname class=sr-only>發文者</label>
      <div class="input-group">
        <span class="input-group-addon">發文者　</span>
        <input name="subject" id="subject" type="text" class="form-control" placeholder="<?php echo $row_RecNickname["nickname"]; ?>" readonly>
      </div><br>
      <label for=inputNickname class=sr-only>發文時間</label>
      <div class="input-group">
        <span class="input-group-addon">發文時間</span>
        <input name="subject" id="subject" type="text" class="form-control" placeholder="<?php echo $row_RecComment["time"]; ?>" readonly>
      </div><br>
      <label for=inputNickname class=sr-only>標題　　</label>
      <div class="input-group">
        <span class="input-group-addon">標題　　</span>
        <input name="subject" id="subject" type="text" class="form-control" value="<?php echo $row_RecComment["subject"];?>" readonly>
      </div>
      <div class="form-group">
        <textarea name="content" class="form-control" rows="10" id="content" disabled><?php echo $row_RecComment["content"];?></textarea>
      </div>
      <input name="id" type="hidden" id="id" value="<?php echo $row_RecComment["id"]?>"></input>
      <input name="action" type="hidden" id="action" value="delete"></input>
      <button class="btn btn-lg btn-danger btn-block" type="submit">刪除 Delete</button>
      <a class="btn btn-lg btn-success btn-block" href="index.php" role=button>取消 Cancel</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>