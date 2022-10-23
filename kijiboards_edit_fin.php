<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>編集完了</title>
  </head>
  <body>
  <?php

    $upload = "";

    if(!empty($_POST["old_image"])) {
      $upload = $_POST["old_image"];
    }

    if (!empty($_FILES['image']['tmp_name'])) {
      $file_name = date('YmdHis');
      $kakutyousi = basename($_FILES['image']['name']);
      $upload = "./img/".$file_name.$kakutyousi;
      move_uploaded_file($_FILES['image']['tmp_name'], $upload);
    }
    // var_dump($upload);
    // exit;

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
    $del_flg_s = $_POST["del_flg_s"];
    $edit = $_POST["edit"];
    $sub_edit = $_POST["sub_edit"];
    // var_dump($del_flg);
    // exit;
    //
    // $query = "SELECT * FROM boards WHERE board_id = '$board_id';";
    // $datas = mysqli_query($mysql, $query);
    // $data = mysqli_fetch_assoc($datas);
    // //
    // var_dump($datas["del_flg"]);
    // exit;

    // var_dump($del_flg);
    // exit;

    // $s_query = "SELECT * FROM boards_subs WHERE board_sub_id = '$board_sub_id';";
    // $s_datas = mysqli_query($mysql, $s_query);
    // $s_data = mysqli_fetch_assoc($s_datas);




 // (board_id, name, titel, message, image, mail, url, text_color, crated_at, update_at, del_flg)
 //  VALUES (NULL, '$name', '$titel', '$message', '$upload', '$mail', '$url', '$text_color', NULL, '$time', '$del_flg' )
    if (!empty($edit)) {
      $query = "UPDATE boards SET name = '$name', titel = '$titel', message = '$message', image = '$upload', mail = '$mail', url = '$url',
        text_color = '$text_color', crated_at = '$time', del_flg = '$del_flg_s'
        WHERE board_id = $board_id;";
      $data = mysqli_query($mysql,$query);
  ?>
  <h1>投稿の編集をしました</h1>
  <a href="kijiboards.php">topへ</a>
  <?php
      }
      ?>



  </body>
</html>
