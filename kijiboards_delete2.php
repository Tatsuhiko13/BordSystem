<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>削除完了！</title>
  </head>
  <body>
  <?php
    $mysql = mysqli_connect('db', 'root', 'root');
    $db_selected = mysqli_select_db($mysql, 'boards_db');

    $board_id = $_POST["board_id"];
    // $del_flg = $_POST["del_flg"];
    $del_flg_s = $_POST["delete_flg_s"];


    //
    // var_dump($del_flg_s);
    // exit;
    $query = "SELECT * FROM boards WHERE board_id = '$board_id';";
    $data = mysqli_query($mysql, $query);

    // var_dump($query);
    // exit;
      //なので mysqli fetch assocを使ってMySQLデータObj　から PHP objに変換する
      // まぁdatasっていうかdataだけどｗ（一行しかないから。board_idで縛った以上、絶対一行なわけでｗ
    $datas = mysqli_fetch_assoc($data);
    // mysqli_fetch_assoc SELECTは変換する必要ある。（こういうデータ見つかったよって返ってくるから。
    // var_dump($datas);
    // exit;

    if (!empty($datas) && ($datas["del_flg"] == $del_flg_s)) {
      $del = "DELETE FROM boards WHERE board_id = '$board_id';";
      $del_f = mysqli_query($mysql, $del);

      echo "<h1>～削除が完了しました～</h1>";
      echo "<a href=kijiboards.php>ＫＩＪＩＭＡの掲示板に戻る</a>";
      }
    else {
      echo "<h1>パスワードが違います</h1>";
      echo "<a href=kijiboards.php>戻る</a>";
      }

  ?>



  </body>
</html>
