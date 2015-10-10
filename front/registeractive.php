<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 18:19
 */
require_once('./common/include.php');

// 实例化数据库
$mu = new ModelUser('bl_user');

$username = $_GET['username'];

// 激活用户
$res = $mu->update(array('is_active'=>1), "username='" . $username . "'");
if($res != 1) {
    // 激活失败
    exit('激活失败 或者 已经激活');
}
else {
    // 激活成功 跳转到商城首页
    header("location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/index.php');
    // 状态为已经登录
    $_SESSION['name'] = $username;
}
