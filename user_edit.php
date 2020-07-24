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

			session_cache_expire(30);// 有効期間30分
			session_start();

			try
			{
				$pro_code=$_GET['procode'];

				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM mst_product WHERE code = :code';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);
				$dbh=null;

				if($rec==false)
				{
					print'登録者コードが正しくありません。';
					print'<a href="index.php">戻る</a>';
					print '<br />';
					exit();
				}

				$_SESSION['code'] = "$pro_code";

				$pro_name = $rec['name'];
				$pro_name2 = $rec['name2'];
			}
			catch(Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		登録情報修正<br />
		<br />
		登録者コード<br />
		<?php print $pro_code; ?><br />

		<form method="post" action="user_edit_check.php">
		学籍番号<br />
		<input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br />
		名前<br />
		<input type="text" name="name2" style="width:50px" value="<?php print $pro_name2; ?>"><br />
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="ＯＫ">
		</form>

	</body>
</html>