<!--必須要先登入-->
<?php
  header("Content-Type: text/html; charset=utf-8;");
  require_once("connMysql.php");
  //啟用 SESSION
  session_start();
  //檢查是否已經登入
  if(isset($_SESSION["loginUser"]) && ($_SESSION["loginUser"]!="")){
    //已經登入，
    /* 顯示目前留言 */
    $query_RecComment = "SELECT * FROM `comment` WHERE `id`=".$_GET["id"];
    $RecComment = mysqli_query($conn, $query_RecComment);
    $row_RecComment=mysqli_fetch_assoc($RecComment);

    /* 提取 nickname, id */
    $query_RecUser = "SELECT `nickname`,`id`,`permission` FROM `user` WHERE `username`='".$_SESSION["loginUser"]."'";
    $RecUser = mysqli_query($conn, $query_RecUser);
    $row_RecUser=mysqli_fetch_assoc($RecUser);

    if( $row_RecUser["permission"] != "admin" && $row_RecComment["user_id"] != $row_RecUser["id"] ){
?>
    <script type="text/javascript">
      window.alert("這不是你的留言!\n你將被移動至首頁");
      window.location.assign("index.php");
    </script>
<?php
    }
    $query_RecUsername = "SELECT `nickname` FROM `user` WHERE ".$row_RecComment["user_id"]." =`user`.`id`";
    $RecUsername = mysqli_query($conn, $query_RecUsername);
    if($RecUsername==""){
?>
    <script type="text/javascript">
      window.alert("該留言不存在!\n將被轉移至首頁!");
      window.location.assign("index.php");
    </script>
<?php
    }
    $row_RecUsername = mysqli_fetch_assoc($RecUsername);
    $RecName = $row_RecUsername["nickname"];
  }else{
    //尚未登入，轉到登入畫面
?>
    <script type="text/javascript">
      window.alert("你尚未登入!");
      window.location.assign("login.php");
    </script>
<?php
  }
  /* 更新留言 */
  if(isset($_POST["action"])&&($_POST["action"]=="edit")){
    $check_id = floor($_POST["id"]);

    $query_RecUser = "SELECT `nickname`,`id`,`permission` FROM `user` WHERE `username`='".$_SESSION["loginUser"]."'";
    $RecUser = mysqli_query($conn, $query_RecUser);
    $row_RecUser = mysqli_fetch_assoc($RecUser);
    if( $row_RecUser["permission"] != "admin" && $row_RecComment["user_id"] != $_POST["id"] ){
?>
    <script type="text/javascript">
      window.alert("這不是你的留言!\n你將被移動至首頁");
      window.location.assign("index.php");
    </script>
<?php
    }else{
    require_once("xss_protect.php");
    $Real_subject = xss_protect($_POST["subject"]);
    $Real_content = xss_protect($_POST["content"]);
    $query_update = "UPDATE `comment` SET ";
    $query_update .= "`subject`='".$Real_subject."',";
    $query_update .= "`content`='".$Real_content."' ";
    $query_update .= "WHERE `id`=".$_POST["id"];
    mysqli_query($conn, $query_update);
    // 重新導向回到主畫面
?>
    <script type="text/javascript">
      window.alert("修改留言成功!");
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
  <title>修改留言</title>
  <link rel="icon" href="/images/icon.jpg">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/index.css" rel="stylesheet">
  <script src="/js/ie-emulation-modes-warning.js"></script>
</head>

<body class="custom-signin">
  <div class="container">
    <form class="form-signin" role="form" method="post" action="">
      <h2 class="form-signin-heading">修改留言</h2>
      <label for=inputNickname class=sr-only>發文者</label>
      <div class="input-group">
        <span class="input-group-addon">發文者</span>
        <input name="subject" id="subject" type="text" class="form-control" placeholder="<?php echo $RecName; ?>" readonly>
      </div><br>
      <label for=inputNickname class=sr-only>標　題</label>
      <div class="input-group">
        <span class="input-group-addon">標　題</span>
        <input name="subject" id="subject" type="text" class="form-control" value="<?php echo $row_RecComment["subject"]; ?>">
      </div>
      <div class="form-group">
        <textarea name="content" class="form-control" rows="10" id="content" required><?php echo $row_RecComment["content"]; ?></textarea>
      </div>
      <input name="id" type="hidden" id="id" value="<?php echo $row_RecComment["id"]; ?>"></input>
      <input name="action" type="hidden" id="action" value="edit"></input>
      <button class="btn btn-lg btn-primary btn-block" type="submit">修改留言 Submit</button>
      <button class="btn btn-lg btn-danger btn-block" type="reset">重新修改 Reset</button>
      <a class="btn btn-lg btn-default btn-block" href="index.php" role=button>回首頁 Home</a>
    </form>
  </div>
  <script src="https://use.typekit.net/ova0edr.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>