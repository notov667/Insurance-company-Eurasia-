<?php 
    $mysql = new mysqli('localhost', 'oopbd', 'TjPnQow/pCEd5w3g', 'oopbd');
    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    function Hashing($val) {
        $val = md5($val."ExtraPass@8674");
        return $val;
    }

    $pass_error = 0;

    $iin = ClearData($_POST['iin']);
    $login = ClearData($_POST['login']);

    $mysql->query("UPDATE `user` SET `login`='$login' WHERE `iin` = '$iin';");

    $oldpass = ClearData($_POST['oldpass']);
    $oldpass = Hashing($oldpass);
    $newpass = ClearData($_POST['newpass']);
    $newpass = Hashing($newpass);
    

    if ($oldpass != '') {
        $search = $mysql->query("SELECT * FROM `user` WHERE `iin` = '$iin' AND `pass` = '$oldpass';");
        $searchress = $search->fetch_assoc(); 
        if (count($searchress) != 0) {
            $mysql->query("UPDATE `user` SET `pass`='$newpass' WHERE `iin` = '$iin';");
            $pass_error = 0;
        }
        else {
            $pass_error = 1;
        }
    }
    else {
        $pass_error = 0;
    }



?>