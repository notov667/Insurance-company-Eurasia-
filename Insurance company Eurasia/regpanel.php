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
                    <div class="auth_panel show" id="reg">
                        <h2>Регистрация</h2>
                        <form action="php/reg.php" class="auth_form" id="reg_form" method="post">
                            <div class="auth_input">
                                <label for="iin_num">ИИН</label>
                                <input id="iin_num" class="_iin _req" type="text" name="iin" autocomplete="off">
                                <?php if ($_COOKIE['reg_iin_err'] == '1'): ?>
                                <small style="display: block">Такой ИИН уже зарегистрирован</small>
                                <?php endif; ?>
                                <small>ИИН введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_tel">НОМЕР ТЕЛЕФОНА</label>
                                <input id="reg_tel" class="_tel _req" type="text" name="tel" autocomplete="off">
                                <?php if ($_COOKIE['reg_tel_err'] == '1'): ?>
                                <small style="display: block">Такой номер уже зарегистрирован</small>
                                <?php endif; ?>
                                <small>Номер телефона введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_email">Email</label>
                                <input id="reg_email" class="_email _req" type="email" name="email" autocomplete="off">
                                <?php if ($_COOKIE['reg_email_err'] == '1'): ?>
                                <small style="display: block">Такой email уже зарегистрирован</small>
                                <?php endif; ?>
                                <small>email введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_pass">ПАРОЛЬ</label>
                                <input id="reg_pass" class="_pass _req" type="password" name="pass" autocomplete="off">
                                <small>Пароль должен содержать буквы, спец. символы и цифры не менее 8 символов</small>
                            </div>
                            <button class="auth_btn" id="reg_btn" type="submit" disabled>Зарегистрироваться</button>
                        </form>
                        <a href="authpanel.php">У вас уже есть аккаунт?</a>
                        <a href="index.html"><span class="icon-left_arrow"></span>Назад</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/regval.js"></script>
</body>
</html>