<?php 
/**
file: admin/index.php
功能: MVC中的控制器 负责显示view/admin/index.html
**/

require_once('./common/include.php');

// 更新用户状态
$ip = get_client_ip();
$time = time();
$mu = new ModelUser('bl_user');
$res = $mu->update(array('logintime'=>$time, 'loginip'=>$ip), "username='" . $_SESSION['name'] . "'");
//echo $res;

include(ROOT . 'view/admin/templates/index.html');

 ?>