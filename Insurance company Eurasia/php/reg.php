<?php 

    $mysql = new mysqli('localhost', 'oopbd', 'TjPnQow/pCEd5w3g', 'oopbd');
    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    $tel = ClearData($_POST['tel']);
    $iin = ClearData($_POST['iin']);
    $email = ClearData($_POST['email']);
    $pass = ClearData($_POST['pass']);

    $pass = md5($pass."ExtraPass@8674");

    $uniq_check = $mysql->query("SELECT * FROM `user` WHERE `tel` = '$tel' OR `iin` = '$iin' OR `email` = '$email';");
    $check_ress = $uniq_check->fetch_assoc();
    if (count($check_ress) == 0) {
        $mysql->query("INSERT INTO `user` (`tel`, `iin`, `email`, `pass`) VALUES ('$tel', '$iin', '$email', '$pass');");
        setcookie('reg_iin_err', '', 0, "/regpanel.php");
        setcookie('reg_tel_err', '', 0, "/regpanel.php");
        setcookie('reg_email_err', '', 0, "/regpanel.php");
        setcookie('user', $iin, 0, "/");
        $mysql->close();    
        header('Location: ../lk.php');
        exit();
    }
    $uniq_check = $mysql->query("SELECT * FROM `user` WHERE `iin` = '$iin';");
    $check_ress = $uniq_check->fetch_assoc();
    if (count($check_ress) != 0) {
        setcookie('reg_iin_err', '1', time() + 360, "/regpanel.php");
    }
    else {
        setcookie('reg_iin_err', '', 0, "/regpanel.php");
    }

    $uniq_check = $mysql->query("SELECT * FROM `user` WHERE `tel` = '$tel';");
    $check_ress = $uniq_check->fetch_assoc();
    if (count($check_ress) != 0) {
        setcookie('reg_tel_err', '1', time() + 360, "/regpanel.php");
    }
    else {
        setcookie('reg_tel_err', '', 0, "/regpanel.php");
    }

    $uniq_check = $mysql->query("SELECT * FROM `user` WHERE `email` = '$email';");
    $check_ress = $uniq_check->fetch_assoc();
    if (count($check_ress) != 0) {
        setcookie('reg_email_err', '1', time() + 360, "/regpanel.php");
    }
    else {
        setcookie('reg_email_err', '', 0, "/regpanel.php");
    }

    $mysql->close();
    header('Location: ../regpanel.php');


?>