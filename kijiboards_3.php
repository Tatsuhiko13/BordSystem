<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>！投稿投下！</title>
</head>

<body>
<h1>投稿が完了しました！</h1>
<a href="kijiboards.php">ＫＩＪＩＭＡの掲示板に戻る</a>


  <?php
  $mysql = mysqli_connect('db', 'root', 'root');
  $db_selected = mysqli_select_db($mysql, 'boards_db');
  date_default_timezone_set("ASIA/TOKYO");
    $time = date("y-m-d h:i:s");

    $name = $_POST["name"];
    $titel = $_POST["titel"];
    $message = $_POST["message"];
    $mail = $_POST["mail"];
    $url = $_POST["url"];
    $text_color = $_POST["text_color"];
    $upload = $_POST["image"];
    $del_flg = $_POST["del_flg"];

    // var_dump("$time");
    // exit;


// dbへ！ここで編集前投稿も削除もしたい
  $query = "INSERT INTO boards(board_id, name, titel, message, image, mail, url, text_color, crated_at, update_at, del_flg)
  VALUES (NULL, '$name', '$titel', '$message', '$upload', '$mail', '$url', '$text_color', '$time', NULL, '$del_flg')";

  $datas = mysqli_query($mysql,$query);
  if (!$datas){
    echo "insetに失敗".mysqli_error($mysql);

  }

?>

  </body>
</html>
