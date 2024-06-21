<?php

if (!isset($_SESSION['csrf_token'])) {
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;
}else{
    $csrf_token =  $_SESSION['csrf_token'];
}
$smarty->assign("VTopo", "N");
$smarty->assign("csrf", $csrf_token);
$smarty->display("login.html");