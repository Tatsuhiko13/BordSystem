<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>編集完了ページ</title>
  </head>
  <body>
  <?php
  $mysql = mysqli_connect('db', 'root', 'root');
  $db_selected = mysqli_select_db($mysql, 'boards_db');
    date_default_timezone_set("ASIA/TOKYO");


  if (!empty($_FILES['s_image']['tmp_name'])) {
      $file_name = date('YmdHis');
      $kakutyousi = basename($_FILES['s_image']['name']);
      $upload = "./img/".$file_name.$kakutyousi;
      move_uploaded_file($_FILES['s_image']['tmp_name'], $upload);
    }

    // var_dump($_FILES);
    // exit;

;

    $time = date("Y-m-d H:i:s");
    $board_sub_id = $_POST["s_board_id"];
    $s_name = $_POST["s_name"];
    $s_titel = $_POST["s_titel"];
    $s_message = $_POST["s_message"];
    $s_mail = $_POST["s_mail"];
    $s_url = $_POST["s_url"];
    $s_text_color = $_POST["s_text_color"];
    $s_del_flg_s = $_POST["sub_del_flg_s"];
    $sub_edit = $_POST["sub_edit"];




    if (!empty($sub_edit)) {
        $query = "UPDATE boards_subs SET name = '$s_name', titel = '$s_titel', message = '$s_message', image = '$upload', mail = '$s_mail',
            url = '$s_url', text_color = '$s_text_color', crated_at = '$time', del_flg = '$s_del_flg_s'
          WHERE board_sub_id = $board_sub_id;";
        $data = mysqli_query($mysql,$query);
      ?>
        <h1>返信の編集をしました</h1>
        <a href="kijiboards.php">topへ</a>
    <?php
      }
    ?>
  </body>
</html>
