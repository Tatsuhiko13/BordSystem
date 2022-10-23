<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title>確認ページ</title>
  </head>

  <body>
  <?php



  // ファイルの移動先の指定
  // 指定したファイルに basename（）で取得したファイル情報(拡張子)を格納します
  // $uploadで指定したupロード先に対して格納するファイル情報
  // $_FILES['image']['tmp_name']  を './img/.jpeg'  へ移動する
  $upload = "";

  // アップロード処理
  if(!empty($_FILES['image']['tmp_name'])) {
    $file_name = date("YmdHis");
    $kakutyousi = basename($_FILES['image']['name']);
    $upload = "./img/".$file_name.$kakutyousi;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload);
  }


  $mysql = mysqli_connect('db', 'root', 'root');
  $db_selected = mysqli_select_db($mysql, 'boards_db');

  date_default_timezone_set("ASIA/TOKYO");
    $time = date("Y-m-d H:i:s");

    $name = $_POST["name"];
    $titel = $_POST["titel"];
    $message = $_POST["message"];
    $mail = $_POST["mail"];
    $url = $_POST["url"];
    $text_color = $_POST["text_color"];
    $preview = $_POST["preview"];
    $del_flg = $_POST["del_flg"];

  //
  // var_dump($time);
  // exit;
  if($preview == "1") {
    echo "<h1>確認ページです</h1><hr />";
    echo "名前:$name<hr />";
    echo "件名:$titel<hr />";
    echo "<font color = '$text_color'> 本文:$message</font><hr />";
    echo "画像:<img src='"."./img/".$file_name.$kakutyousi."' width='200px'/><hr />";
    echo "メールアドレス:$mail<hr />";
    echo "URL:$url<hr />";
    echo "文字色:$text_color<hr />";
    echo "編集・削除キー:$del_flg<hr />";
    ?>
    <form action="kijiboards_3.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="titel" value="<?php echo $titel; ?>">
      <input type="hidden" name="message" value="<?php echo $message; ?>">
      <input type="hidden" name="image" value="<?php echo $upload; ?>">
      <input type="hidden" name="mail" value="<?php echo $mail; ?>">
      <input type="hidden" name="url" value="<?php echo $url; ?>">
      <input type="hidden" name="text_color" value="<?php echo $text_color; ?>">

      <input type="hidden" name="del_flg" value="<?php echo $del_flg; ?>">

      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="投稿">
    </form>


  <?php
    // dbへ！ここで編集前投稿も削除もしたい

  }else {
    $query = "INSERT INTO boards(board_id, name, titel, message, image, mail, url, text_color, crated_at, update_at, del_flg)
    VALUES (NULL, '$name', '$titel', '$message', '$upload', '$mail', '$url', '$text_color', '$time', NULL, '$del_flg' )";
    $datas = mysqli_query($mysql,$query);
    // if (!$datas){
    //   echo "insetに失敗".mysqli_error($mysql);
    //
    // }
    // var_dump($query);
    // exit;

    ?>

    <h1>投稿が完了しました！</h1>
    <a href="kijiboards.php">ＫＩＪＩＭＡの掲示板に戻る</a>

<?php
 }
?>


  </body>
</html>
