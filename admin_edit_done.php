<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書修正</title>
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
				print'教科書コードが受信できません。';
				exit();
			}
			if (isset($_SESSION['name'])) {
				$pro_name=$_SESSION['name'];
			}
			else{
				print'名前が受信できません。';
				exit();
			}
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='UPDATE dat_text SET name=:name,price=:price WHERE code_text=:code_text';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':name_text', $pro_name, PDO::PARAM_STR);
				$prepare->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$prepare->bindValue(':code_text', $pro_code, PDO::PARAM_INT);
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
		<a href="admin_index.php">戻る</a>
	</body>
</html>
