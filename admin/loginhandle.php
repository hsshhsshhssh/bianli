<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 15:49
 * file: admin/loginhandle.php 登录界面的处理程序
 */
require_once('./common/include.php');

$mu = new ModelUser('bl_user');

$sql = "select count(*) from bl_user where username='" . $_POST['username'] . "' && password='"  .  $_POST['password'] . "'";
//echo $sql;

$res = $mu->getOne($sql);

if($res == 1) {
    $_SESSION['name'] = $_POST['username'];
}

echo $res;



