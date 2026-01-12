<?php
session_start();

if(!isset($_SESSION['id'])) {
	header("Location:/");
}

echo "<h1>Welcome ", htmlspecialchars($_SESSION['name'], $ENT_QUOTES), "</h1>";
?>

<!DOCTYPE html>
<html lang="ja">
<body>
	<form action="logout.php" method="POST">
		<button type="submit">ログアウト</button>
	</form>
</body>
</html>