<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>商品修正</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			
			

			//DB処理
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
				

				$_SESSION['code_text'] = "$pro_code";

				$pro_name = $rec['name_text'];
				$pro_price = $rec['price'];
				$pro_auther = $rec['name_auther'];
				$pro_publisher = $rec['name_publisher'];
				$pro_year = $rec['name_year'];
				$pro_date = $rec['date'];
				$pro_gazou = $rec['gazou'];

				$dbh=null;

				$disp_gazou='<img src="gazou/'.$pro_gazou.'">';
				$_SESSION['gazou_name'] = "$pro_gazou";

				
			}
			
			//DBエラー
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		<h1>商品修正</h1>
		商品コード<br />
		<?php print h($pro_code); ?>
		<br />
		<br />
		<form method="post" action="admin_edit_check.php" enctype="multipart/form-data">

			商品名<br />
			<input type="text" name="name_text" style="width:400px" value="<?php print $pro_name; ?>"><br />
			日付<br />
			<input type="date" name="date" value="<?php print $pro_date; ?>"><br />
			価格<br />
			<input type="text" name="price" style="width:100px" value="<?php print $pro_price; ?>"> 円<br />
			著者<br />
			<input type="text" name="name_auther" style="width:400px" value="<?php print $pro_auther; ?>"><br />
			出版社<br />
			<input type="text" name="name_publisher" style="width:400px" value="<?php print $pro_publisher; ?>"><br />
			出版年<br />
			<input type="text" name="name_year" style="width:400px" value="<?php print $pro_year; ?>"><br />
			<br />
			<?php print $disp_gazou; ?><br>
			画像を選んでください。<br />
			<input type="file" name="gazou" style="width:400px"><br />
			<br />
			<input type="button" onclick="history.back()" value="戻る">
			<input type="submit" value="ＯＫ">
		</form>
	</body>
</html>
