<?php

$login = true;
include_once("../config_admin.php");

if(isset($_REQUEST['username']) and isset($_REQUEST['password'])){
    $username = sqi($_REQUEST['username']);
    $password = md5(sqi($_REQUEST['password']));
    $r = getrecord('tbl_admin',"username='$username' and password='$password'");
    if(count($r) > 0){
        $_SESSION['idadmin'] = $r[0]['id'] ;
        echo true;
        //echo ok
    }
    else{
        echo 'نام کاربری یا رمز عبور اشتباه است';
    }
}
else{
    echo 0;
}