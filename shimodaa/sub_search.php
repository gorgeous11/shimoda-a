<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>科目検索</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<h1>科目一覧</h1>
		<?php
			require_once('_database_conf.php');
			require_once('_h.php');

//			session_cache_expire(30);// 有効期間30分
			session_start();

			//DB処理
			try
			{
				//DB接続
				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//DB読取
				$sql='SELECT * FROM mst_dat_sub';
				$stmt=$db->prepare($sql);
				$stmt->execute();

				//科目一覧
				//print '科目一覧<br /><br />';
				
				//DB切断
				$dbh=null;


				//検索キーワード入力
				print '<form method="post" action="">';
					print '検索キーワード';
					print '<input type="sub" name="keyword">';
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

				//検索科目表示
				if ($keyword!==''){
					print h($keyword).'が含まれる科目';
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
					if (($keyword==='')||(strpos($rec['name_subject'],$keyword)!==false)){
						print '<a href="sub_search_link.php?procode='.$rec['code_subject'].'">';
						print h($rec['code_subject']).' ';
						print h($rec['name_subject']).' ';
						print h($rec['name_teacher']).' ';
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