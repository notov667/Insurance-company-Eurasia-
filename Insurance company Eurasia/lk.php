<?php
    include 'php/change.php';

    $id_user = $_COOKIE['user'];
    $mysql = new mysqli('localhost', 'oopbd', 'TjPnQow/pCEd5w3g', 'oopbd');

    $osago = $mysql->query("SELECT * FROM `package` WHERE `type` = 'osago' AND `user` = '$id_user';");
    $casco = $mysql->query("SELECT * FROM `package` WHERE `type` = 'casco' AND `user` = '$id_user';");
    $greencard = $mysql->query("SELECT * FROM `package` WHERE `type` = 'green' AND `user` = '$id_user';");

    $check = $mysql->query("SELECT * FROM `user` WHERE `iin` = '$id_user';");
    $ress = $check->fetch_assoc();

    if (!isset($_COOKIE['user']) OR trim($_COOKIE['user']) == '') {
        header('Location: /authpanel.php');
    }
    if ($ress['login'] == NULL) {
        $ress['login'] = $ress['iin'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/lk.css">
        <link rel="stylesheet" href="fonts/icon_style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">    
        <title>Личный кабинет</title>
    </head>
    <body id="body">
        <div class="nav">
            <div class="container">
                <div class="nav_panel">
                    <a href="index.html" class="logo"><img src="img/nav_logo.png" alt="Euro"></a>
                    <div class="nav_links">
                        <a href="package.html">Виды пакетов</a>
                        <a href="aboutus.html">О нас</a>
                    </div>
                    <div class="nav_btn"><span class="icon-login"></span>Личный кабинет</div>
                </div>
            </div>
        </div>

        <div class="lk_wrapper">
            <div class="container">
                <div class="lk_panel">
                    <div class="sidenav">
                        <h2><?php echo $ress['login'] ?></h2>
                        <a class="_chosen" id="mysubs">Мои подписки</a>
                        <a id="addsubs">Создать заявку для страховки</a>
                        <?php if ($ress['admin'] == '1'): ?> 
                        <a href="admin.php" id="admin_panel">Админ панель</a>
                        <?php endif; ?>
                        <a id="settings_panel">Настройки</a>
                        <a href="php/logout.php">Выйти</a>

                    </div>
                    <div class="lk_content">
                        <div class="mysubs _active">
                            <h3>Мои подписки</h3>
                            <div class="mysubs_nav">
                                <a class="active_btn mysubs_nav_active" id="able_subs">Действующие подписки</a>
                                <a class="inactive_btn" id="disable_subs">Недействующие подписки</a>
                            </div>
                            <div class="active_subs _show_p">
                                <?php
                                    if($mysubs = $mysql->query("SELECT * FROM `package` WHERE `user` = '$id_user';")){
                                        
                                        echo "<table><tr><th>Название</th><th>Номер Авто</th><th>Срок договора (ДО)</th><th>Цена</th></tr>";
                                        foreach($mysubs as $row){
                                            if ($row['endtime'] > date('Y-m-d')){
                                                if ($row['type'] == 'osago') {
                                                    $subs_name = 'Обязательная автостраховка';
                                                }
                                                elseif ($row['type'] == 'casco') {
                                                    $subs_name = 'Каско по подписке';
                                                }
                                                else {
                                                    $subs_name = 'Зеленая Карта';
                                                }

                                                echo "<tr>";
                                                    echo "<td>" . $subs_name . "</td>";
                                                    echo "<td>" . $row['carnum'] . "</td>";
                                                    echo "<td>" . $row['endtime'] . "</td>";
                                                    echo "<td>" . $row['price'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        echo "</table>";
                                    }
                                ?>
                            </div>
                            <div class="inactive_subs">
                                <?php
                                    if($mysubs = $mysql->query("SELECT * FROM `package` WHERE `user` = '$id_user';")){
                                        
                                        echo "<table><tr><th>Название</th><th>Номер Авто</th><th>Срок договора (ДО)</th><th>Цена</th></tr>";
                                        foreach($mysubs as $row){
                                            if ($row['endtime'] < date('Y-m-d')){
                                                if ($row['type'] == 'osago') {
                                                    $subs_name = 'Обязательная автостраховка';
                                                }
                                                elseif ($row['type'] == 'casco') {
                                                    $subs_name = 'Каско по подписке';
                                                }
                                                else {
                                                    $subs_name = 'Зеленая Карта';
                                                }

                                                echo "<tr>";
                                                    echo "<td>" . $subs_name . "</td>";
                                                    echo "<td>" . $row['carnum'] . "</td>";
                                                    echo "<td>" . $row['endtime'] . "</td>";
                                                    echo "<td>" . $row['price'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        echo "</table>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="addsubs">
                            <h3>Создать заявку для страховки</h3>
                            <form action="php/addsubs.php" method="post">
                            <div class="addsubs_input">
                                <label for="addsubs_iin">ИИН владельца</label>
                                <input id="addsubs_iin" type="text" name="user" value="<?php echo $_COOKIE['user'] ?>" readonly>
                            </div>
                            <div class="addsubs_input">
                                <label for="car_num">НОМЕР АВТО</label>
                                <input id="car_num" type="text" name="car">
                                <small>Введите номер в формате A000AAA или 000AAA00</small>
                            </div>
                            <div class="addsubs_input">
                                <label for="addsubs_choice">Вид страховки</label>
                                <select name="package" id="addsubs_choice">
                                    <option selected value="osago" >Обязательная автостраховка</option>
                                    <option value="casco">Каско по подписке</option>
                                    <option value="green">Зеленая Карта</option>
                                </select>
                            </div>
                            <div class="addsubs_radio">
                                <label class="addsubs_radio_input" for="date_period1">
                                    6 месяцев
                                    <input class="subs_period" id="date_period1" type="radio" name="subs_period" value="6 месяцев" checked>
                                </label>
                                <hr>
                                <label class="addsubs_radio_input" for="date_period2">
                                    12 месяцев
                                    <input class="subs_period" id="date_period2" type="radio" name="subs_period" value="12 месяцев">
                                </label>
                            </div>
                            <div class="addsubs_input">
                                <label for="date_show">Срок договора</label>
                                <input id="date_show" type="text" name="date" readonly>
                            </div>
                            <div class="addsubs_input">
                                <label for="price_show">Цена договора</label>
                                <input id="price_show" type="text" name="price" readonly>
                            </div>
                            <button class="addsubs_btn" id="addsubs_btn" type="submit" disabled>Создать заявку</button>
                            </form>
                        </div>
                        <div class="settings_panel">
                            <h3>Ваши данные</h3>
                            <form class="change_form" action="" method="post">
                                <div class="change_input">
                                    <label for="change_tel">НОМЕР ТЕЛЕФОНА</label>
                                    <input id="change_tel" type="text" name="tel" value="<?php echo $ress['tel'] ?>" readonly>
                                </div>
                                <div class="change_input">
                                    <label for="change_email">email</label>
                                    <input id="change_email" type="text" name="email" value="<?php echo $ress['email'] ?>" readonly>
                                </div>
                                <div class="change_input">
                                    <label for="change_iin">ИИН</label>
                                    <input id="change_iin" type="text" name="iin" value="<?php echo $ress['iin'] ?>" readonly>
                                </div>
                                <div class="change_input">
                                    <label for="change_login">Логин</label>
                                    <input id="change_login" type="text" name="login" value="<?php echo $ress['login'] ?>">
                                </div>
                                <h3>Сменить пароль</h3>
                                <div class="change_input">
                                    <label for="old_pass">старый пароль</label>
                                    <input id="old_pass" type="password" name="oldpass">
                                    <?php if ($pass_error == 1): ?>
                                    <small class="pass_error">Пароль не правельный</small>
                                    <?php endif; ?>
                                </div>
                                <div class="change_input">
                                    <label for="new_pass">новый пароль</label>
                                    <input id="new_pass" type="password" name="newpass">
                                    <small>Пароль должен содержать буквы, цпец. символы и цифры не менее 8 символов</small>
                                </div>
                                <button id="change_btn" class="change_btn" type="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer_panel">
                <div class="footer_info">
                    <a href="index.html"><div class="footer_logo"><img src="img/footer_logo.png" alt="Euro"></div></a>
                    <p>Евразия страховая компания – первая в Казахстане страховая компания, которая работает для удобства автовладельцев. Именно для них мы запускаем полезные продукты и сервисы: простое оформление электронных полисов на сайте, Страховая подписка, цифровые выплаты и другие онлайн сервисы.</p>
                </div>
                <div class="footer_contacts">
                    <a href="https://goo.gl/maps/4epZyDzT3oz5tiDP6"><span class="icon-address" style="font-size: 25px;"></span>Офис: улица, Манасова 31</a>
                    <a href="https://web.whatsapp.com/send/?phone=77070223264"><span class="icon-whatsapp"></span>+7 (707) 022 3264<p>WhatsApp</p></a>
                    <a href="tel:0001"><span class="icon-tel"></span>0001<p>Бесплатно с мобильного</p></a>
                    <a href="mailto:info@mail.ru"><span class="icon-mail"></span>info@mail.ru</a>
                </div>
                <div class="footer_find">
                    <div class="footer_map"><iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=43.23512957999003,%2076.9096455246314+(IITU)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html"></a></iframe></div>
                        
                    <div class="footer_links">
                        <a href="https://www.instagram.com/e.notov/"><span class="icon-instagram"></span></a>
                        <a href="https://t.me/ergalinotov"><span class="icon-telegram"></span></a>
                        <a href="https://ru-ru.facebook.com"><span class="icon-facebook"></span></a>
                        <a href="https://www.youtube.com/channel/UCy3wJQTHB41J9JnUCIBSMTg"><span class="icon-youtube"></span></a>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/lk.js"></script>
        <script src="js/addsubs.js"></script>
    </body>
</html>