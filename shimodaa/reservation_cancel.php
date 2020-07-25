<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>予約削除</title>
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

				$sql='SELECT * FROM dat_reserv WHERE code_reservation=:code';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':code', $pro_code, PDO::PARAM_INT);
				$stmt->execute();

				$rec=$stmt->fetch(PDO::FETCH_ASSOC);

				$dbh=null;

				if($rec==false)
				{
					print'予約番号が正しくありません。';
					print'<a href="reservation_index.php">戻る</a>';
					print '<br />';
					exit();
				}

				$_SESSION['code'] = "$pro_code";
				$pro_code_reservation = $rec['code_reservation'];
				$pro_code_order = $rec['code_order'];
			}
			catch(Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
		?>
		予約削除<br />
		<br />
        予約番号：
        <?php print '　　';print $pro_code_reservation; ?><br>
        注文番号：
        <?php print '　　';print $pro_code_order ?><br><br>
		この予約を削除してよろしいですか？<br />
		<br />

		<form method="post" action="reservation_cancel_done.php">
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="削除">
		</form>

	</body>
</html>