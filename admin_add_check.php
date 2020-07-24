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
			session_cache_expire(30);// 有効期間30分

			$pro_name_text=$_POST['name_text'];
			$pro_price=$_POST['price'];

			if($pro_name_text=='')
			{
				print '名前が入力されていません。<br />';
			}
			else
			{
				print '名前:';
				print  h($pro_name_text);
				print '<br />';
			}

			if($pro_price=='')
			{
				print '価格が入力されていません。<br />';
			}
			else
			{
				print '価格:';
				print h($pro_price);
				print '<br />';
			}

			if($pro_name=='' || $pro_price=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容を追加します。<br />';
				print '<br />';

				print '<form method="post" action="admin_add_done.php">';
//				print '<input type="hidden" name="name" value="'.$pro_name.'">';
//				print '<input type="hidden" name="price" value="'.$pro_price.'">';
				$_SESSION['name_text'] = "$pro_name_text";
				$_SESSION['price'] = "$pro_price";
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';
			}
		?>
	</body>
</html>
