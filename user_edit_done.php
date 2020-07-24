<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登録情報修正</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_start();
			if (isset($_SESSION['code'])) {
				$pro_code=$_SESSION['code'];
			}
			else{
				print'登録者コードが受信できません。';
				exit();
			}
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
				print'学籍番号が受信できません。';
				exit();
			}
			if (isset($_SESSION['name2'])) {
				$pro_name2=$_SESSION['name2'];
			}
			else{
				print'名前が受信できません。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='UPDATE mst_product SET name=:name,name2=:name2 WHERE code=:code';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':name2', $pro_name2, PDO::PARAM_INT);
				$prepare->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$prepare->execute();

				$db=null;

				print '修正しました。<br />';

			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		<a href="user_touroku_index.php">戻る</a>
	</body>
</html>
