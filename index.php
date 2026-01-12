<?php
include_once("function.php");
$csrf_token = generate_csrf_token();

if(isset($_SESSION['id'])) {
	header("Location:/welcome.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Ajax通信</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <header>
            <img class="header_logo" src="images/logo.jpg" alt="ロゴ">
        </header>
        <main>
            <div id="form_content">
                <div id="sign_in">
                    <h1>Sign in</h1>
                    <div id="mes" style="margin-bottom: 15x;"></div>
                    <form id="main_form" method="post">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="input_grp">
                            <label for="email">メールアドレス</label>
                            <input type="email" id="email" name="email" placeholder="メールアドレスを入力">
                        </div>
                        <div class="input_grp">
                            <label for="passwd">パスワード</label>
                            <input type="password" id="passwd" name="passwd" placeholder="パスワードを入手">
                        </div>
                        <button type="button" class="btn" id="submit_btn">ログイン</button>                    
                    </form>
                <p><a href="register_form.html">登録</a></p>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>