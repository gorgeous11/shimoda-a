<!DOCTYPE html>
<html>
	<h教科書d>
		<meta charset="UTF-8">
		<title>教科書表示</title>
		<link rel="stylesheet" href="shimodaa.css">
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

				$sql='SELECT * FROM mst_dat_text WHERE code_text = :code_text';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code_text', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);
				$dbh=null;
				$pro_gazou_name=$rec['gazou'];

                if($pro_gazou_name=='')
				{
					$disp_gazou='';
				}
				else
				{
					$disp_gazou='<img src="gazou/'.$pro_gazou_name.'">';
				}

			}
			catch(Exception$e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		<h1>教科書表示</h1>
		教科書科書コード<br />
		<?php print h($rec['code_text']); ?><br />
		教科書名<br />
		<?php print h($rec['name_text']); ?><br />
		価格<br />
		<?php print h($rec['price']); ?><br />
		著者<br />
		<?php print h($rec['name_auther']); ?><br />
		出版社<br />
		<?php print h($rec['name_publisher']); ?><br />
		出版年<br />
		<?php print h($rec['name_year']); ?><br />
		画像<br />
		<?php print $disp_gazou; ?>

		
		<br />
		<form>
		<input type="button" onclick="history.back()" value="戻る">
		</form>
	</body>
</html>
