<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>管理者パスワード</title>
	</head>
	<body>
<?php

ini_set("display_errors", "Off");

    $pass = '1234';                // パスワード設定
    if($_POST['pass'] !== $pass) {        // パスワードチェック
        // パスワード不一致（パスワード入力フォーム表示）
        echo '
            <html>
            <head>
            <title>パスワード認証</title>
            </head>
            <body>
            <form action="' . $_SERVER['SCRIPT_NAME'] . '" method="POST">
            パスワードを入力してください。<br>
            <input type="password" size="10" name="pass" value="">
            <input type="submit" value="送信"><br>
            </form>
        ';
        if($_POST['pass']) {
            echo '<p style="color:red;">エラー：パスワードが違います！！</p>';
        }
        echo '
            </body>
            </html>
        ';
    }
    else {
        // パスワード一致
        include("admin_index.php");        //　HTMLファイル読み込み
    }
?>
</body>
</html>