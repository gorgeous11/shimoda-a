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

			session_cache_expire(30);// 有効期間30分
			session_start();

			try
			{
				$pro_code=$_GET['procode'];

				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM dat_text WHERE code_text = :code_text';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code_text', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);
				$dbh=null;

				$_SESSION['code_text'] = "$pro_code";

				$pro_name = $rec['name_text'];
				$pro_price = $rec['price'];
			}
			catch(Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		教科書修正<br />
		<br />
		教科書コード<br />
		<?php print $pro_code; ?><br />

		<form method="post" action="admin_edit_check.php">
		教科書名<br />
		<input type="text" name="name_text" style="width:200px" value="<?php print $pro_name; ?>"><br />
		価格<br />
		<input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br />
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="ＯＫ">
		</form>

	</body>
</html>