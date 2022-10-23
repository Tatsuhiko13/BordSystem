<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>返信完了</title>
  </head>
  <body>
  <?php

  // var_dump($_FILES);
  // exit;

  if(!empty($_FILES['image']['tmp_name'])) {
    $file_name = date("YmdHis");
    $kakutyousi = basename($_FILES['image']['name']);
    $upload = "./img/".$file_name.$kakutyousi;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload);
  }


  // var_dump($upload);
  // exit;
  //
  $mysql = mysqli_connect('db', 'root', 'root');
  $db_selected = mysqli_select_db($mysql, 'boards_db');

  date_default_timezone_set("ASIA/TOKYO");
  $time = date("Y-m-d H:i:s");
  $board_id = $_POST["board_id"];
  $name = $_POST["name"];
  $titel = $_POST["titel"];
  $message = $_POST["message"];
  $mail = $_POST["mail"];
  $url = $_POST["url"];
  $text_color = $_POST["text_color"];
  $del_flg = $_POST["del_flg"];

  // var_dump($time);
  // exit;


  $query = "INSERT INTO boards_subs(board_sub_id, board_id, name, titel, message, image, mail, url, text_color, crated_at, update_at, del_flg)
   VALUES (NULL, '$board_id', '$name', '$titel', '$message', '$upload', '$mail', '$url', '$text_color', '$time', NULL, '$del_flg')";
  $datas = mysqli_query($mysql,$query);


  // if (!$datas){
  //   echo "insetに失敗".mysqli_error($mysql);
  //
  // }

  ?>

  <h1>返信が完了しました！</h1>
  <a href="kijiboards.php">ＫＩＪＩＭＡの掲示板に戻る</a>


  </body>
</html>
