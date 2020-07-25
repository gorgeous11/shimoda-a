<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書登録</title>
		<link rel="stylesheet" href="shimodaa.css">
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
			if (isset($_SESSION['name_auther'])) {
				$pro_auther=$_SESSION['name_auther'];
			}
			else{
				print'著者が受信できません。。';
				exit();
			}
			if (isset($_SESSION['name_publisher'])) {
				$pro_publisher=$_SESSION['name_publisher'];
			}
			else{
				print'出版社が受信できません。。';
				exit();
			}
			if (isset($_SESSION['name_year'])) {
				$pro_year=$_SESSION['name_year'];
			}
			else{
				print'出版年が受信できません。。';
				exit();
			}
			if (isset($_SESSION['date'])) {
				$pro_date=$_SESSION['date'];
			}
			else{
				print'日付が受信できません。。';
				exit();
			}
			if (isset($_SESSION['gazou'])) {
				$pro_gazou=$_SESSION['gazou'];
			}
			else{
				print'画像が受信できません。。';
				exit();
			}
			session_unset();// セッション変数をすべて削除
			session_destroy();// セッションIDおよびデータを破棄

			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='INSERT INTO mst_dat_text(name_text,price,name_auther,name_publisher,name_year,date,gazou) VALUES (:name_text,:price,:name_auther,:name_publisher,:name_year,:date,:gazou)';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':name_text', $pro_name, PDO::PARAM_STR);
				$stmt->bindValue(':price', $pro_price, PDO::PARAM_INT);
				$stmt->bindValue(':name_auther', $pro_auther, PDO::PARAM_STR);
				$stmt->bindValue(':name_publisher', $pro_publisher, PDO::PARAM_STR);
				$stmt->bindValue(':name_year', $pro_year, PDO::PARAM_STR);
				$stmt->bindValue(':date', $pro_date, PDO::PARAM_STR);
				$stmt->bindValue(':gazou', $pro_gazou, PDO::PARAM_STR);
				$stmt->execute();

				$db=null;

				print h($pro_name);
				
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
