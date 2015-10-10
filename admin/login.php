<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 15:01
 * file: login.php  后台登录界面
 * 不能用common 否则会循环重定向
 */

define('HSSH', true);
require_once('../include/init.php'); // include.php 是被包含的 不能以include.php为相对路径 应该以包含的文件以相对路径

require(ROOT . 'view/admin/templates/login.html');