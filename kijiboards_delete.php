<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>編集・削除</title>
  </head>
  <body>
  <h1>確認ページ</h1>
  <hr />

  <?php
    $mysql = mysqli_connect('db', 'root', 'root');
    $db_selected = mysqli_select_db($mysql, 'boards_db');

    $board_id = $_POST["board_id"];
    $del_flg = $_POST["del_flg"];
    $delete = $_POST["delete"];
    $edit = $_POST["edit"];

  //
  ?>
    <!-- 編集か削除　分岐 -->
  <?php
    // var_dump($board_id);
    // exit;
  // 削除ルート
  if (!empty($delete)) {
    ?>
    <form action="kijiboards_delete2.php" method="POST">
      <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
      <div  style = "border : double  #FF2828 ;">
        <table border="0" cellpadding="8">
          <tbody>
            <tr>
              <td>PASSWORD： </td>
              <td><input type="password" name="delete_flg_s" size="8"><font size="2">（削除した投稿は戻りません）</font></td>
              <td><input class="button" type="submit" value="削除">
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  <?php
    }

    // var_dump($board_id);
    // exit;
  ?>


 <?php
  // 編集ルート
  if (!empty($edit)) {
    ?>
    <form action="kijiboards_edit.php" method="POST">
      <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
        <div  style = "border : double  #ffa500 ;">
          <table border="0" cellpadding="8">
            <tbody>
              <tr>
                <td>PASSWORD： </td>
                <td><input type="password" name="delete_flg_s" size="8"></td>
                <td><input class="button" type="submit" value="編集ページへ"></td>
              </tr>
            </tbody>
          </table>
        </div>
    </form>
  <?php
    }
  ?>



  </body>
</html>
