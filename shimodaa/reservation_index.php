<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>予約教科書一覧</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<h1>あなたが予約した教科書一覧</h1>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';

			session_start();
			if (isset($_SESSION['user_id'])) {
				$pro_name=$_SESSION['user_id'];
			}
			else{
				print'利用者コードが受信できません。';
				exit();
			}			

			try{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM dat_reserv WHERE code_user=:code';

				$prepare=$db->prepare($sql);
				$prepare->bindValue(':code', $pro_name, PDO::PARAM_INT);
				$prepare->execute();


				//print 'あなたが予約した教科書一覧<br /><br />';

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					$sql='SELECT * FROM mst_dat_order 
					LEFT OUTER JOIN mst_dat_sub ON mst_dat_order.code_subject = mst_dat_sub.code_subject 
					LEFT OUTER JOIN mst_dat_text ON mst_dat_order.code_text = mst_dat_text.code_text
					WHERE mst_dat_order.code_order=:code';
					$stmt=$db->prepare($sql);
					$stmt->bindValue(':code', $rec['code_order'], PDO::PARAM_INT);
					$stmt->execute();

					$rec2=$stmt->fetch(PDO::FETCH_ASSOC);

					print('予約番号：');
					print h($rec['code_reservation']).'　　';
					print('注文番号：');
					print h($rec['code_order']).'　　';
					print('科目名：');
					print h($rec2['name_subject']).'　　';
					print('教員名：');
					print h($rec2['name_teacher']).'　　';
					print('教科書名：');
					print h($rec2['name_text']).'　　';
					print '<br />';

				}
				print '<br />';
				print '<form method="get" action="reservation_cancel.php">';
				print '予約削除：予約番号';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				$db=null;
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
            ?>
		<a href="my_page.php">マイページへ</a>	
	</body>
</html>