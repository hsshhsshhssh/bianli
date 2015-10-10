<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 19:11
 * file:front/login.php  前台的用户登录
 */
require_once('./common/include.php');

$mu = new ModelUser('bl_user');


require(ROOT . '/view/front/login.html');
