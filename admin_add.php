<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教科書情報入力</title>
	</head>
	<body>
		教科書情報入力<br />
		<br />

		<form method="post" action="admin_add_check.php">
			名前を入力してください。<br />
			<input type="text" name="name_text" style="width:100px"><br />
			価格を入力してください。<br />
			<input type="text" name="price" style="width:50px"><br />
			<br />
			<input type="button" onclick="history.back()" value="戻る">
			<input type="submit" value="確認">
		</form>

	</body>
</html>
