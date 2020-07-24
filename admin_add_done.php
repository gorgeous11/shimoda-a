<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書登録</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

//			$pro_name_text=$_POST['name_text'];
//			$pro_price=$_POST['price'];

			session_start();
			if (isset($_SESSION['name_text'])) {
				$pro_name=$_SESSION['name_text'];
			}
			else{
				print'名前が受信できません。。';
				exit();
			}
			if (isset($_SESSION['price'])) {
				$pro_price=$_SESSION['price'];
			}
			else{
				print'価格が受信できません。。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='INSERT INTO dat_text(name,price) VALUES (:name, :price)';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':name_text', $pro_name_text, PDO::PARAM_STR);
				$stmt->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$stmt->execute();

				$db=null;

				print h($pro_name_text);
				print h($pro_price);
				print 'を追加しました。<br />';

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
