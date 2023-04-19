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
    $pass = ClearData($_POST['pass']);

    $pass = md5($pass."ExtraPass@8674");

    $result = $mysql->query("SELECT * FROM `user` WHERE `tel` = '$tel' AND `pass` = '$pass';");
    $user = $result->fetch_assoc();

    if (count($user) === 0) {
        
        $mysql->close();      
        setcookie('pass_err', '1', time() + 360, "/authpanel.php");
        header('Location: ../authpanel.php');
        exit();
    }
    
    setcookie('pass_err', '', 0, "/authpanel.php");
    setcookie('user', $user['iin'], 0, "/");
    $mysql->close();
    header('Location: ../lk.php');
?>