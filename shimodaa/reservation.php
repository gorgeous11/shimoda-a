<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書一覧</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<h1>教科書一覧</h1>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				/*
				$sql='INSERT INTO dat_order(code_subject, code_text)
				SELECT dat_sub.code_subject, dat_text.code_text FROM dat_sub, dat_text';
				*/
				$sql='SELECT * FROM mst_dat_order 
				LEFT OUTER JOIN mst_dat_sub ON mst_dat_order.code_subject = mst_dat_sub.code_subject 
				LEFT OUTER JOIN mst_dat_text ON mst_dat_order.code_text = mst_dat_text.code_text';
				/*******************************************************************************
				$sql='SELECT distinct code_subject, code_text FROM dat_order ';
				$sql='SELECT code_order FROM dat_order';
				select * from テーブル名1
				left outer join テーブル名2
				on テーブル名1.フィールド名 = テーブル名2.フィールド名;
				**************************************************************************************/
				$prepare=$db->prepare($sql);
				$prepare->execute();


				$db=null;

				//print '教科書一覧<br /><br />';

				while(true)
				{
					$rec=$prepare->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print '注文番号：';
					print h($rec['code_order']).'　';
					print '科目名：';
					print h($rec['name_subject']).'　';
					print '教員名：';
					print h($rec['name_teacher']).'　';
					print '教科書名：';
					print h($rec['name_text']).'　';
					print '<br />';
					}
					print '<br />';
					print '<form method="get" action="reservation_check.php">';
					print '教科書予約：注文番号';
					print '<input type="text" name="procode" style="width:20px">';
					print '<input type="submit" value="決定">';
					print '</form>';
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