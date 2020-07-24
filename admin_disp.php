<!DOCTYPE html>
<html>
	<h教科書d>
		<meta charset="UTF-8">
		<title>教科書表示</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
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
			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		教科書<br />
		<br />
		教科書科書コード<br />
		<?php print h($rec['code_text']); ?><br />
		教科書名<br />
		<?php print h($rec['name_text']); ?><br />
		価格<br />
		<?php print h($rec['price']); ?><br />
		<br />
		<form>
		<input type="button" onclick="history.back()" value="戻る">
		</form>
	</body>
</html>
