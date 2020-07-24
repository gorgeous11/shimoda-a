<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>入力内容チェック</title>
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_start();

			$pro_name=$_POST['name'];
			$pro_name2=$_POST['name2'];

			if($pro_name=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
				print  h($pro_name);
				print '<br />';
			}

			if($pro_name2=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
				print h($pro_name2);
				print '<br />';
			}

			if($pro_name=='' || $pro_name2=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容に修正します。<br />';
				print '<br />';

				$_SESSION['name'] = "$pro_name";
				$_SESSION['name2'] = "$pro_name2";

				print '<form method="post" action="user_edit_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
