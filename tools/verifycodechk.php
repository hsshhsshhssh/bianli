<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 17:16
 * file: verifycodechk.php 验证验证码
 */
session_start();

$verify = addslashes($_GET['verify']);

if($verify == $_SESSION['verify']) {
    echo "0";
}
else {
    echo "1";
}