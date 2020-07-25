<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書表示</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<?php
			require_once('_database_conf.php');
			require_once('_h.php');

			session_start();

			//データ受取
			$pro_code=$_GET['procode'];

			//DB処理
			try
			{
				//DB接続
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//DB読取
				$sql='SELECT * FROM mst_dat_text WHERE code_text=:code_text';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code_text', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);
				$pro_name=$rec['name_text'];
				$pro_date=$rec['date'];
				$pro_price=$rec['price'];
                $pro_auther=$rec['name_auther'];
                $pro_publisher=$rec['name_publisher'];
                $pro_year=$rec['name_year'];
                $pro_quantity=$rec['quantity'];
				$pro_gazou_name=$rec['gazou'];
				if($pro_gazou_name=='')
				{
					$disp_gazou='';
				}
				else
				{
					$disp_gazou='<img src="gazou/'.$pro_gazou_name.'" height="300">';
				}

				//DB切断
				$dbh=null;

			}
			//DBエラー
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>

		<h1>教科書表示</h1>
		教科書コード<br />
		<?php print  h($pro_code); ?>
		<br />
		教科書名<br />
		<?php print  h($pro_name); ?>
		<br />
		発売日<br />
		<?php print  h($pro_date); ?>
		<br />
		価格<br />
		<?php print  h($pro_price); ?>円
        <br />
        著者<br />
		<?php print  h($pro_auther); ?>
        <br />
        出版社<br />
		<?php print  h($pro_publisher); ?>
        <br />
        出版年<br />
		<?php print  h($pro_year); ?>
		<br />
		画像<br />
		<?php print  $disp_gazou; ?>
		<br />
		<br />

		<?php
//			print '<form method="post" action="reservation.php">';
//				$_SESSION['code_text'] = "$pro_code";
//				print '<input type="submit" value="予約する">';
//				print '</br>';
//				print '</br>';
				print '<input type="button" onclick="history.back()" value="戻る">';
//			print '</form>';
		?>
	</body>
</html>