<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書情報入力</title>
		<link rel="stylesheet" href="shimodaa.css">
	</head>
	<body>
		<h1>教科書情報入力</h1>

		<form method="post" action="admin_add_check.php" enctype="multipart/form-data">
			名前を入力してください。<br />
			<input type="text" name="name_text" style="width:100px"><br />
			価格を入力してください。<br />
			<input type="text" name="price" style="width:50px"><br />
			著者を入力してください。<br />
			<input type="text" name="name_auther" style="width:100px"><br />
			出版社を入力してください。<br />
			<input type="text" name="name_publisher" style="width:100px"><br />
			出版年を入力してください。<br />
			<input type="text" name="name_year" style="width:100px"><br />
			日付を入力してください。<br />
			<input type="date" name="date" style="width:100px"><br />
			画像を選んでください。<br />
			<input type="file" name="gazou" style="width:400px"><br />
			<br />



			<br />
			<input type="button" onclick="history.back()" value="戻る">
			<input type="submit" value="確認">
		</form>

	</body>
</html>
