<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>入力内容チェック</title>
	</head>
	<body>
		<?php
			require_once '_h.php';

			session_cache_expire(30);// 有効期間30分
			session_start();

			$pro_name=$_POST['name_user'];
			$pro_id=$_POST['student_id'];
			$pro_pass=$_POST['password'];
			

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

			if($pro_id=='')
			{
				print '学籍番号が入力されていません。<br />';
			}
			else
			{
				print '学籍番号:';
				print h($pro_id);
				print '<br />';
			}

			if($pro_pass=='')
			{
				print 'パスワードが入力されていません。<br />';
			}
			else
			{
				print 'パスワード:非表示';
				print '<br />';
			}

			

			if($pro_name=='' || $pro_id=='' || $pro_pass=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容で進めます。<br />';
				print '<br />';

				$_SESSION['name_user'] = "$pro_name";
				$_SESSION['student_id'] = "$pro_id";
				$_SESSION['password'] = "$pro_pass";

			

				print '<form method="post" action="user_add_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="進む">';
				print '</form>';

			}
		?>
	</body>
</html>
