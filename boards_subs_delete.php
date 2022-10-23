<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>DELETE</title>
  </head>
  <body>
    <h1>DELETE.EDIT確認ページ</h1>
  <?php
    $mysql = mysqli_connect('db', 'root', 'root');
    $db_selected = mysqli_select_db($mysql, 'boards_db');

    $edit = $_POST["edit"];
    $delete = $_POST["delete"];
    // $board_id = $_POST["board_id"];
    $board_sub_id = $_POST["board_sub_id"];

    // $query = "SELECT * FROM boards_subs where borad_sub_id = '$board_sub_id';";
    // $data = mysqli_query($mysql,$query);

    if (!empty($edit)) {
    ?>
    <form action="subs_delete_fin.php" method="POST">
      <input type="hidden" name="board_sub_id" value="<?php echo $board_sub_id; ?>">
      <div  style = "border : double  #ffa500 ;">
        <table border="0" cellpadding="8">
          <tbody>
            <tr>
              <td>PASSWORD： </td>
              <td><input type="password" name="sub_flg_s" size="8"></td>
              <td><input type="submit" name="edit" value="編集ページへ"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  <?php
    }

  ?>

  <?php
  if (!empty($delete)) {
  ?>
  <form action="subs_delete_fin.php" method="POST">
    <input type="hidden" name="board_sub_id" value="<?php echo $board_sub_id; ?>">
    <div  style = "border : double  #FF2828 ;">
      <table border="0" cellpadding="8">
        <tbody>
          <tr>
            <td>PASSWORD： </td>
            <td><input type="password" name="sub_flg_s" size="8"></td>
            <td><input type="submit" name="delete" value="削除ページへ"></td>
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
