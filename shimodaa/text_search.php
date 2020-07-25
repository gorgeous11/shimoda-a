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
			require_once('_database_conf.php');
			require_once('_h.php');

			session_cache_expire(30);// 有効期間30分
			session_start();

			//DB処理
			try
			{
				//DB接続
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//DB読取
				$sql='SELECT * FROM mst_dat_text';
				$stmt=$db->prepare($sql);
				$stmt->execute();

				//DB切断
				$dbh=null;

				//教科書一覧
				//print '教科書一覧<br /><br />';

				//検索キーワード入力
				print '<form method="post" action="">';
					print '検索キーワード';
					print '<input type="text" name="keyword">';
					print '<input type="submit" value="検索">';
				print '</form>';

				//検索キーワード空チェック
				if (isset($_POST['keyword'])){
					$keyword=$_POST['keyword'];
				}
				else{
					$keyword='';
				}
				print '<br />';

				//検索キーワード表示
				if ($keyword!==''){
					print h($keyword).'が含まれる教科書';
					print '<br />';
				}

				//検索結果表示
				while(true)
				{
					$rec=$stmt->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}

					//検索処理
					if (($keyword==='')||(strpos($rec['name_text'],$keyword)!==false)){
						$pro_gazou_name=$rec['gazou'];
						if($pro_gazou_name==''){$disp_gazou='';}
						//else{$disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';}
						else{$disp_gazou='<img src="gazou/'.$pro_gazou_name.'" height="100">';}
						print $disp_gazou;
						print '<a href="text_search_link.php?procode='.$rec['code_text'].'">';
						print h($rec['code_text']).' ';
						print h($rec['name_text']).' ';
						print h($rec['price']).'円';
						print '</a>';
						print '<br />';
					}
				}
			}
			//DBエラー
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
	 			exit();
			}
			print '<a href="my_page.php">マイページに戻る</a><br />';
		?>
	</body>
</html>