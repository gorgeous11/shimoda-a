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

			$max_size=4*1024*1024;

			$pro_name=$_POST['name_text'];
			$pro_price=$_POST['price'];
			$pro_auther=$_POST['name_auther'];
			$pro_publisher=$_POST['name_publisher'];
			$pro_year=$_POST['name_year'];
			$pro_date=$_POST['date'];
			$pro_gazou=$_FILES['gazou'];

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
			if($pro_auther=='')
			{
				print '著者が入力されていません。<br />';
			}
			else
			{
				print '著者:';
				print  h($pro_auther);
				print '<br />';
			}

			if($pro_publisher=='')
			{
				print '出版社が入力されていません。<br />';
			}
			else
			{
				print '出版社:';
				print  h($pro_publisher);
				print '<br />';
			}

			if($pro_year=='')
			{
				print '出版年が入力されていません。<br />';
			}
			else
			{
				print '出版年:';
				print  h($pro_year);
				print '<br />';
			}

			if($pro_date=='')
			{
				print '日付が入力されていません。<br />';
			}
			else
			{
				print '日付:';
				print  h($pro_date);
				print '<br />';
			}

			if($pro_gazou['size']>0)
			{
				if($pro_gazou['size']>$max_size)
				{
					print '画像が大き過ぎます';
				}
				else
				{
					move_uploaded_file($pro_gazou['tmp_name'],'../gazou'.$pro_gazou['name']);
					print '<img src="../gazou'.$pro_gazou['name'].'">';
					print '<br />';
				}
			}

			if($pro_name=='' || $pro_price==''|| $pro_auther==''|| $pro_publisher==''|| $pro_year==''|| $pro_date==''|| $pro_gazou=='')
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記の内容に修正します。<br />';
				print '<br />';

				$_SESSION['name_text'] = "$pro_name";
				$_SESSION['price'] = "$pro_price";
				$_SESSION['name_auther'] = "$pro_auther";
				$_SESSION['name_publisher'] = "$pro_publisher";
				$_SESSION['name_year'] = "$pro_year";
				$_SESSION['date'] = "$pro_date";
				$_SESSION['gazou'] = $pro_gazou['name'];

				print '<form method="post" action="admin_edit_done.php">';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="登録">';
				print '</form>';

			}
		?>
	</body>
</html>
