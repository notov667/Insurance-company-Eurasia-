<?php

    $mysql = new mysqli('localhost', 'oopbd', 'TjPnQow/pCEd5w3g', 'oopbd');

    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    $package = ClearData($_POST['package']);
    $user = ClearData($_POST['user']);
    $carnum = ClearData($_POST['car']);
    $period = ClearData($_POST['subs_period']);
    $price = 0;
    $factor = ($period == '6 месяцев') ? 1 : 1.8;

    if ($package == 'osago') {
        $price = 6555 * $factor;
    }
    elseif ($package == 'casco') {
        $price = 9000 * $factor;
    }
    elseif ($package == 'green') {
        $price = 5660 * $factor;
    }
    else {
        $price = 0;
    }
    $setdate = new DateTime('now');
    if ($period == '6 месяцев') {
        $enddate = new DateTime('+6 months');
    }
    else {
        $enddate = new DateTime('+12 months');
    }
    $setdate = $setdate->format('y/m/d');
    $enddate = $enddate->format('y/m/d');


    $mysql->query("INSERT INTO `package` (`type`, `user`, `carnum`, `settime`, `endtime`, `price`) 
    VALUES ('$package', '$user', '$carnum', '$setdate', '$enddate', '$price');");

    header('Location: ../lk.php');
?>