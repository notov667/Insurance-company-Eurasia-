<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/icon_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Вход</title>
</head>
<body>
        <div class="auth_wrapper _panel">
            <div class="container">
                <div class="auth_content">
                    <div class="auth_info">
                        <div class="auth_logo"><img src="img/auth_logo.png" alt="Euro"></div>
                        <p>Первая в Казахстане страховая компания</p>
                    </div>
                    <div class="auth_panel show" id="login">
                        <h2>Войти</h2>
                        <form action="php/auth.php" class="auth_form" id="login_form" method="post"> 
                            <div class="auth_input">
                                <label for="login_tel">НОМЕР ТЕЛЕФОНА</label>
                                <input id="login_tel" class="_tel _req" type="text" name="tel" autocomplete="off">
                                <small>Номер телефона введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="password">ПАРОЛЬ</label>
                                <input id="password" class="_pass _req" type="password" name="pass" autocomplete="off">
                                <?php if ($_COOKIE['pass_err'] == '1'): ?>
                                <small style="display: block">Пароль не правельный</small>
                                <?php endif; ?>
                            </div>
                            <a href="">Забыли пароль?</a>
                            <button class="auth_btn" id="login_btn" type="submit" disabled>Войти</button>
                        </form>
                        <a href="regpanel.php">У вас нет аккаунта?</a>
                        <a href="index.html"><span class="icon-left_arrow"></span>Назад</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/authval.js"></script>
</body>
</html>