<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>kiji_ban返信</title>
  </head>
  <body>
  <?php
  $mysql = mysqli_connect('db', 'root', 'root');
  // if (!$mysql) {
  //     echo "接続に失敗しました".mysql_error();
  //     exit;
  // }
  //   echo '<p>接続に成功しました。</p>';
  $db_selected = mysqli_select_db($mysql, 'boards_db');
  // if (!$db_selected){
  //   echo "データベースの選択に失敗しました".mysqli_error();
  //
  // }
  //
  //   echo '<p>データベースの選択に成功しました。</p>';

  $board_id = $_POST["board_id"];
  // var_dump($board_id);
  // exit;

  $query = "SELECT * FROM boards WHERE board_id = $board_id;";
  $datas = mysqli_query($mysql,$query);
  $data = mysqli_fetch_assoc($datas);
  ?>

  <h1><?php echo $data["name"]; ?>さんへ返信</h1>
  <hr />
  <form action="boards_subs_fin.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
      名前     <input type="text" name="name" placeholder="名前を入力してください"/>
      <hr />
      件名     <input type="text" name="titel" placeholder="件名を入力してください"/>
      <hr />
      メッセージ<br />
      <textarea name="message" rows="5" cols="42" placeholder="メッセージを入力してください"/></textarea>
      <hr />
      画像     <input type="file" name="image">
      <hr />
      メールアドレス <input type="text" name="mail" size="25">
      <hr />
      URL     <input type="text" name="url" size="25">
      <hr />
      文字色
      <label><input type="radio" name="text_color" value="#000000"><font size="3" color="#000000">◆</font></label>
      <label><input type="radio" name="text_color" value="#008000"><font size="3" color="#008000">◆</font></label>
      <label><input type="radio" name="text_color" value="#0000ff"><font size="3" color="#0000ff">◆</font></label>
      <label><input type="radio" name="text_color" value="#800080"><font size="3" color="#800080">◆</font></label>
      <label><input type="radio" name="text_color" value="#ff1493"><font size="3" color="#ff1493">◆</font></label>
      <label><input type="radio" name="text_color" value="#ffa500"><font size="3" color="#ffa500">◆</font></label>
      <label><input type="radio" name="text_color" value="#00008b"><font size="3" color="#00008b">◆</font></label>
      <label><input type="radio" name="text_color" value="#808080"><font size="3" color="#808080">◆</font></label>
      <hr />

      編集・削除キー<input type="password" name="del_flg" size="8">（半角英数字のみで４～８文字)<hr />
      <!-- <input type="checkbox" name="preview" value="1">
      プレビューする？（投稿前に、内容をプレビューして確認できます）
      <br /> -->
      <input type="submit" value="投稿">
      <input type="reset" value="リセット">

    </form>







  </body>
</html>
