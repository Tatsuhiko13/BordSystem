<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>完了ページ</title>
  </head>
  <body>
    <?php
    $mysql = mysqli_connect('db', 'root', 'root');
    $db_selected = mysqli_select_db($mysql, 'boards_db');

    $board_sub_id = $_POST["board_sub_id"];
    $edit = $_POST["edit"];
    $delete = $_POST["delete"];
    $sub_flg_s = $_POST["sub_flg_s"];
    // var_dump($board_sub_id);
    // var_dump($delete);
    // var_dump($sub_flg_s);
    // exit;

    $query = "SELECT * FROM boards_subs WHERE board_sub_id = '$board_sub_id';";
    $datas = mysqli_query($mysql, $query);
    $data = mysqli_fetch_assoc($datas);
    $del_flg = $data["del_flg"];
    // var_dump($data["del_flg"]);
    // exit;


    if (!empty($delete) && ($del_flg == $sub_flg_s)) {
      $sub_del = "DELETE FROM boards_subs WHERE board_sub_id = '$board_sub_id';";
      $sub_del_f = mysqli_query($mysql, $sub_del);

      echo "<p>DELETEしました</p>";
      echo "<a href=kijiboards.php>ＫＩＪＩＭＡの掲示板に戻る</a>";
    }
    else {
      echo "<p>パスワードが違います</p>";
    }

    if (!empty($edit) && ($data["del_flg"] == $sub_flg_s)) {
      ?>
      <form action="edit_fin.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="s_board_id" value="<?php echo $board_sub_id; ?>">
      <input type="hidden" name="s_del_flg" value="<?php echo $del_flg; ?>">
        名前     <input type="text" name="s_name" value="<?php echo $data["name"]; ?>" placeholder="名前を入力してください"/>
        <hr />
        件名     <input type="text" name="s_titel" value="<?php echo $data["titel"]; ?>" placeholder="件名を入力してください"/>
        <hr />
        本文<br />
        <textarea name="s_message" rows="5" cols="42" placeholder="本文を入力してください"/><?php echo $data["message"]; ?></textarea>
        <hr />
        画像<br />
        <img src='<?php echo $data["image"]; ?>' width='200px'>
        <br />
        <input type="file" name="s_image"/>

        <hr />
        メールアドレス <input type="text" name="s_mail" value="<?php echo $data["mail"]; ?>" size="25">
        <hr />
        URL     <input type="text" name="s_url" value="<?php echo $data["url"]; ?>" size="25">
        <hr />
        文字色
          <label><input type="radio" name="s_text_color" value="#000000"><font size="3" color="#000000">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#008000"><font size="3" color="#008000">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#0000ff"><font size="3" color="#0000ff">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#800080"><font size="3" color="#800080">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#ff1493"><font size="3" color="#ff1493">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#ffa500"><font size="3" color="#ffa500">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#00008b"><font size="3" color="#00008b">◆</font></label>
          <label><input type="radio" name="s_text_color" value="#808080"><font size="3" color="#808080">◆</font></label>
          (再度選択してください)
        <hr />
        編集・削除キー<input type="password" name="sub_del_flg_s" size="8">（半角英数字のみで４～８文字)<hr />
        <!-- <input type="checkbox" name="preview" value="1">
          プレビューする？（投稿前に、内容をプレビューして確認できます） -->
        <br />
        <input type="submit" name="sub_edit" value="投稿">
      </form>
      <br />
      <a href="kijiboards.php">投稿一覧へ</a>
  <?php
    }
    ?>
  </body>
</html>
