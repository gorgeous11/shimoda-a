<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登録教科書一覧</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			try
			{
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT code_text,name_text,price FROM mst_dat_text WHERE 1';
				$stmt=$db->prepare($sql);
				$stmt->execute();

				$db=null;

				print '教科書一覧<br /><br />';

				while(true)
				{
					$rec=$stmt->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					print h($rec['code_text']).' ';
					print h($rec['name_text']).' ';
					print h($rec['price']).' ';
					print '<br />';
				}

				print '<br />';
				print '<a href="admin_add.php">教科書入力</a><br />';

				print '<br />';
				print '<form method="get" action="admin_disp.php">';
				print '教科書表示：番号';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="admin_edit.php">';
				print '教科書修正：番号';
				print '<input type="text" name="procode" style="width:20px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				print '<br />';
				print '<form method="get" action="admin_delete.php">';
				print '教科書削除：番号';
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
	</body>
</html>
