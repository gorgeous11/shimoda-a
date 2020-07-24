<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書予約</title>
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
				print'注文番号が受信できません。';
				exit();
			}

			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//説明
				$sql='INSERT INTO dat_reserv(code_order) VALUES (:code_order)';
				$prepare=$db->prepare($sql);
				$prepare->bindValue(':code_order', $pro_code, PDO::PARAM_STR);
				$prepare->execute();

				$db=null;

				print '注文番号';
				print h($pro_code).' ';
				print 'を予約しました。<br />';
			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		<a href="reservation.php">戻る</a>
	</body>
</html>
