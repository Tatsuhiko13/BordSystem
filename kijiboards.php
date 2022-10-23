<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title>kiji-BAN</title>
  </head>

  <body>
  <?php
  // データベースへの接続を開始（Dockerだからdbだけど大抵はlocalhostと書く）
  // 参照 https://qiita.com/gat3ta/items/562e227e1c778445cced
  $mysql = mysqli_connect('db', 'root', 'root');
  // if (!$mysql) {
  //     echo "接続に失敗しました".mysql_error();
  //     exit;
  // }
  //   echo '<p>接続に成功しました。</p>';

  // データベースの選択 use mysql_lesson; の事
  $db_selected = mysqli_select_db($mysql, 'boards_db');
  // if (!$db_selected){
  //   echo "データベースの選択に失敗しました".mysqli_error();
  //
  // }
  //
  //   echo '<p>データベースの選択に成功しました。</p>';

  //以降、DB接続の返り値を入れた下記変数を使いDBを操作していく
  $mysql; // ←こいつ超重要
  ?>

  <hr />

  <h1>ＫＩＪＩＭＡの掲示板</h1>
  <p>投稿一覧</p>
  <hr />

  <form action="kijiboards_2.php" method="POST" enctype="multipart/form-data">
      名前     <input type="text" name="name" placeholder="名前を入力してください"/>
      <hr />
      件名     <input type="text" name="titel" placeholder="件名を入力してください"/>
      <hr />
      本文<br />
      <textarea name="message" rows="5" cols="42" placeholder="本文を入力してください"/></textarea>
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
      <input type="checkbox" name="preview" value="1">
      プレビューする？（投稿前に、内容をプレビューして確認できます）
      <br />
      <input type="submit" value="投稿">
      <input type="reset" value="リセット">

    </form>



  <?php
    $query = "SELECT * FROM boards order by board_id DESC;";
    $datas = mysqli_query($mysql, $query);

    // "SELECT * FROM boards LEFT JOIN boards_subs ON boards.board_id = boards_subs.board_id order by boards.crated_at DESC;";
    // "SELECT * FROM boards LEFT JOIN boards_subs ON boards.board_id = boards_subs.board_id;";
    // $sub_query = "SELECT * FROM boards_subs order by crated_at DESC;";
  ?>


  <h1>投稿一覧</h1>
  <table border="1">
   <tr>
      <th>投稿時間</th>
      <th>名前</th>
      <th>件名</th>
      <th>本文</th>
      <th>画像</th>
      <th>メールアドレス</th>
      <th>URL</th>
      <th></th>




    <?php
    if(!empty($datas)) {
      while ($data = mysqli_fetch_assoc($datas)) {
        // Y-m-d H:i:s 形式を好みのフォーマットに帰る呪文
        $echo_time = date("Y年m月d日 H時i分", strtotime($data["crated_at"]));

        echo "<tr>";
        echo "<td>".$echo_time."</td>";
        echo "<td>".$data["name"]."</td>";
        echo "<td>".$data["titel"]."</td>";
        echo "<td><font color = '$data[text_color]'> {$data['message']}</font></td>";
        echo "<td><img src = '{$data['image']}' width='200px'/></td>";
        echo "<td>".$data["mail"]."</td>";
        echo "<td>".$data["url"]."</td>";


        ?>

        <?php
        echo "<td>"; ?>
          <form action="boards_subs.php" method="POST">
            <input type="hidden" name="board_id" value="<?php echo $data['board_id']; ?>">
            <input type="submit" name="reply" value="投稿へ返信">
          </form>
          <hr />
          <form action="kijiboards_delete.php" method="POST">
            <input type="hidden" name="board_id" value= "<?php echo $data['board_id']; ?>">
            <input type="submit" name="delete" value="投稿の削除">
            <hr />
            <input type="submit" name="edit" value="投稿の編集">
          </form>
        </td>
    </tr>


    <?php
      $query_sub = "SELECT * FROM boards_subs WHERE board_id = {$data['board_id']};";
      $sub_datas = mysqli_query($mysql, $query_sub);

      // var_dump($data['board_id']);
      // exit;
    ?>


    <?php
      if (!empty($sub_datas)){
        while ($sub_data = mysqli_fetch_assoc($sub_datas)) {
        $sub_time = date("Y年m月d日 H時i分", strtotime($sub_data["crated_at"]));
        ?>

        <tr>
          <th style='background-color:#b0c4de';>返信時間</th>
          <th style='background-color:#b0c4de';>名前</th>
          <th style='background-color:#b0c4de';>件名</th>
          <th style='background-color:#b0c4de';>本文</th>
          <th style='background-color:#b0c4de';>画像</th>
          <th style='background-color:#b0c4de';>メールアドレス</th>
          <th style='background-color:#b0c4de';>URL</th>
          <th style='background-color:#b0c4de';></th>

      <?php
        echo "<tr>";
        echo "<td style='background-color:#eee';>".$sub_time."</td>";
        echo "<td style='background-color:#eee';>".$sub_data["name"]."</td>";
        echo "<td style='background-color:#eee';>".$sub_data["titel"]."</td>";
        echo "<td style='background-color:#eee';><font color = '$sub_data[text_color]'> {$sub_data['message']}</font></td>";
        echo "<td style='background-color:#eee';><img src = '{$sub_data['image']}' width='200px'/></td>";
        echo "<td style='background-color:#eee';>".$sub_data["mail"]."</td>";
        echo "<td style='background-color:#eee';>".$sub_data["url"]."</td>";

        // var_dump($sub_data['name']);
        // exit;
    ?>
    <?php
    echo "<td style='background-color:#eee';>"; ?>
    <form action="boards_subs_delete.php" method="POST">
      <input type="hidden" name="board_sub_id" value="<?php echo $sub_data['board_sub_id']; ?>">
      <!-- <input type="hidden" name="board_id" value= "<?php echo $sub_data['board_id']; ?>"> -->
      <input type="submit" name="edit" value="返信の編集">
      <hr />
      <input type="submit" name="delete" value="返信の削除">
    </form>
    <?php
        }
      }
    ?>

   </tr>

  <?php
      }
    }
  ?>
  </table>




  </body>
</html>
