<?php

    $mysql = new mysqli('localhost', 'oopbd', 'TjPnQow/pCEd5w3g', 'oopbd');
    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }
    
    $user_id = $_COOKIE['user'];

    $user_t = $mysql->query("SELECT * FROM `user` WHERE `iin` = '$user_id';");
    $user = $user_t->fetch_assoc();

    if ($user['admin'] == '0') {
        header('Location: /index.html');
    }

    if ($user['login'] == '') {
        $user['login'] = $user['iin'];
    }

    $package_iin = ClearData($_POST['package_iin']);
    $package_carnum = ClearData($_POST['car']);
    $package_name = ClearData($_POST['package']);
    $user_iin = ClearData($_POST['user_iin']);

    $mysql->query("DELETE FROM `package` WHERE `type` = '$package_name' AND `user` = '$package_iin' AND `carnum` = '$package_carnum';");
    $mysql->query("DELETE FROM `user` WHERE `iin` = '$user_iin';");


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="fonts/icon_style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">    

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

        <div class="auth_wrapper" id="popUp">
            <div class="container">
                <div class="auth_content">
                    <div class="auth_info">
                        <div class="auth_logo"><img src="img/auth_logo.png" alt="Euro"></div>
                        <p>Первая в Казахстане страховая компания</p>
                    </div>
                    <div class="auth_panel" id="login">
                        <h2>Войти</h2>
                        <form action="php/auth.php" class="auth_form" id="login_form" method="post"> 
                            <div class="auth_input">
                                <label for="login_tel">НОМЕР ТЕЛЕФОНА</label>
                                <input id="login_tel" class="_tel _req" type="text" name="tel">
                                <small>Номер телефона введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="password">ПАРОЛЬ</label>
                                <input id="password" class="_pass _req" type="password" name="pass">
                                <small>Пароль должен содержать буквы, цпец. символы и цифры не менее 8 символов</small>
                            </div>
                            <a href="php/logout.php">Забыли пароль?</a>
                            <button class="auth_btn" id="login_btn" type="submit" disabled>Войти</button>
                        </form>
                        <a id="no_account">У вас нет аккаунта?</a>
                        <a onclick="ClosePopUp()"><span class="icon-left_arrow"></span>Назад</a>
                    </div>
                    <div class="auth_panel" id="reg">
                        <h2>Регистрация</h2>
                        <form action="php/reg.php" class="auth_form" id="reg_form" method="post">
                            <div class="auth_input">
                                <label for="iin_num">ИИН</label>
                                <input id="iin_num" class="_iin _req" type="text" name="iin">
                                <small>ИИН введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_tel">НОМЕР ТЕЛЕФОНА</label>
                                <input id="reg_tel" class="_tel _req" type="text" name="tel">
                                <small>Номер телефона введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_email">Email</label>
                                <input id="reg_email" class="_email _req" type="text" name="email">
                                <small>email введен не коректно</small>
                            </div>
                            <div class="auth_input">
                                <label for="reg_pass">ПАРОЛЬ</label>
                                <input id="reg_pass" class="_pass _req" type="password" name="pass">
                                <small>Пароль должен содержать буквы, цпец. символы и цифры не менее 8 символов</small>
                            </div>
                            <button class="auth_btn" id="reg_btn" type="submit" disabled>Зарегистрироваться</button>
                        </form>
                        <a id="have_account">У вас уже есть аккаунт?</a>
                        <a onclick="ClosePopUp()"><span class="icon-left_arrow"></span>Назад</a>
                    </div>
                </div>
            </div>
            <div class="auth_wrapper_bg" onclick="ClosePopUp()"></div>
        </div>

        <div class="admin_wrapper">
            <div class="container">
                <div class="admin_content">
                    <h2><?php echo $user['login'] . " - admin"?></h2>
                    <div class="admin_nav">
                        <a class="prem_users _active" id="prem_users">Аккаунты с подпиской</a>
                        <a class="all_users" id="all_users">Все Аккаунты</a>
                    </div>
                    <div class="prem_users_table _shown">
                        <?php
                            if($package_table = $mysql->query("SELECT * FROM `package` WHERE 1;")){
                                        
                                echo "<table><tr><th>Название</th><th>Номер Авто</th><th>Пользователь (ИИН)</th><th>Срок договора (ДО)</th><th>Цена</th></tr>";
                                foreach($package_table as $row){
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
                                        echo "<td>" . $row['user'] . "</td>";
                                        echo "<td>" . $row['endtime'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                echo "</table>";
                            }
                        ?>
                        <form class="delete_form" action="" method="post">
                            <div class="delete_input">
                                <label for="package_iin">Пользователь (ИИН)</label>
                                <input id="package_iin" type="text" name="package_iin">
                            </div>
                            <div class="delete_input">
                                <label for="delete_carnum">номер авто</label>
                                <input id="delete_carnum" type="text" name="car">
                                <small>Введите номер в формате A000AAA или 000AAA00</small>
                            </div>
                            <div class="delete_input">
                                <label for="delete_choice">Вид страховки</label>
                                <select name="package" id="delete_choice">
                                    <option selected value="osago" >Обязательная автостраховка</option>
                                    <option value="casco">Каско по подписке</option>
                                    <option value="green">Зеленая Карта</option>
                                </select>
                            </div>
                            <button class="delete_btn" type="submit">Удалить</button>
                        </form>
                    </div>
                    <div class="all_users_table">
                        <?php
                            if($user_table = $mysql->query("SELECT * FROM `user` WHERE 1;")){
                                        
                                echo "<table><tr><th>Логин</th><th>ИИН</th><th>Тел. номер</th><th>email</th></tr>";
                                foreach($user_table as $row){
                                    if ($row['login'] == NULL) {
                                        $row['login'] = $row['iin'];
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $row['login'] . "</td>";
                                    echo "<td>" . $row['iin'] . "</td>";
                                    echo "<td>" . $row['tel'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        ?>
                        <form class="delete_form" action="" method="post">
                            <div class="delete_input">
                                <label for="user_iin">Введите ИИН</label>
                                <input id="user_iin" type="text" name="user_iin">
                            </div>
                            <button class="delete_btn" type="submit">Удалить</button>
                        </form>
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
        
        <script src="js/script.js"></script>
        <script src="js/admin.js"></script>
    </body>
</html>