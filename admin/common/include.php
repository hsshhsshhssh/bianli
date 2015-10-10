<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 15:03
 * file: admin/common/inlcude.php  用于每一个控制器的include头
 */

define('HSSH', true);
require_once('../include/init.php'); // include.php 是被包含的 不能以include.php为相对路径 应该以包含的文件以相对路径

if(!isset($_SESSION['name']) ||  $_SESSION['name'] != 'admin') {
    header('location: http://' . $_SERVER['SERVER_NAME'] . '/bianli/admin/login.php');
}