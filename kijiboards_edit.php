<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>投稿の編集</title>
  </head>
  <body>
  <h1>投稿編集ページ</h1>
  <?php
    // これのおかげでね。
    $mysql = mysqli_connect('db', 'root', 'root');
    $db_selected = mysqli_select_db($mysql, 'boards_db');

    $board_id = $_POST["board_id"];
    $delete_flg_s = $_POST["delete_flg_s"];
    // var_dump($del_flg);
    // exit;

    // MySQLクエリを作って変数にいれとく
    $query = "SELECT * FROM boards WHERE board_id = '$board_id';";

    // MySQLとつなげてクエリーを発行 $mysqlがつなげてくれる。 $queryがクエリーの内容
    $data = mysqli_query($mysql, $query);

    $data; // ←今これMySQLから返ってきたばかりのほやほやだからMySQLオブジェクトなんだよね。（オブジェクトの意味はこの際無視）

    //なので mysqli fetch assocを使ってMySQLデータObj　から PHP objに変換する
    // まぁdatasっていうかdataだけどｗ（一行しかないから。board_idで縛った以上、絶対一行なわけでｗ

    // ちょっと下で使っちゃってるから$datasでいくわ。
    $datas = mysqli_fetch_assoc($data);
    //
    // var_dump($datas["del_flg"]);
    // exit;

   ?>

   <?php
     if (!empty($datas) && ($datas["del_flg"] == $delete_flg_s)){
   ?>
      <form action="kijiboards_edit_fin.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
      <input type="hidden" name="old_image" value="<?php echo $datas["image"]; ?>">


        名前     <input type="text" name="name" value="<?php echo $datas["name"]; ?>" placeholder="名前を入力してください"/>
        <hr />
        件名     <input type="text" name="titel" value="<?php echo $datas["titel"]; ?>" placeholder="件名を入力してください"/>
        <hr />
        本文<br />
        <textarea name="message" rows="5" cols="42" placeholder="本文を入力してください"/><?php echo $datas["message"]; ?></textarea>
        <hr />
        画像<br />
        <img src='<?php echo $datas["image"]; ?>' width='200px'>
        <br />
        <input type="file" name="image"/>

        <hr />
        メールアドレス <input type="text" name="mail" value="<?php echo $datas["mail"]; ?>" size="25">
        <hr />
        URL     <input type="text" name="url" value="<?php echo $datas["url"]; ?>" size="25">
        <hr />
        文字色
        <?php
        // 初期値処理
        $arr[$datas["text_color"]] = "checked";
        ?>
          <label><input type="radio" name="text_color" value="#000000" <?php echo $arr["#000000"]; ?>><font size="3" color="#000000">◆</font></label>
          <label><input type="radio" name="text_color" value="#008000" <?php echo $arr["#008000"]; ?>><font size="3" color="#008000">◆</font></label>
          <label><input type="radio" name="text_color" value="#0000ff" <?php echo $arr["#0000ff"]; ?>><font size="3" color="#0000ff">◆</font></label>
          <label><input type="radio" name="text_color" value="#800080" <?php echo $arr["#800080"]; ?>><font size="3" color="#800080">◆</font></label>
          <label><input type="radio" name="text_color" value="#ff1493" <?php echo $arr["#ff1493"]; ?>><font size="3" color="#ff1493">◆</font></label>
          <label><input type="radio" name="text_color" value="#ffa500" <?php echo $arr["#ffa500"]; ?>><font size="3" color="#ffa500">◆</font></label>
          <label><input type="radio" name="text_color" value="#00008b" <?php echo $arr["#00008b"]; ?>><font size="3" color="#00008b">◆</font></label>
          <label><input type="radio" name="text_color" value="#808080" <?php echo $arr["#808080"]; ?>><font size="3" color="#808080">◆</font></label>
          (再度選択してください)
        <hr />
        編集・削除キー<input type="password" name="del_flg_s" size="8">（半角英数字のみで４～８文字)<hr />
        <!-- <input type="checkbox" name="preview" value="1">
          プレビューする？（投稿前に、内容をプレビューして確認できます） -->
        <br />
        <input type="submit" name="edit" value="投稿">
      </form>
      <br />
      <a href="kijiboards.php">投稿一覧へ</a>
    <?php
    }
    else {
      echo "<h2>passwordが違います</h2>";
      }
    ?>
  </body>
</html>
