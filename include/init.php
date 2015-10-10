<?php  header("content-type:text/html;charset=utf-8");

/**
file: init.php
作用: 框架初始化
**/
defined('HSSH') || exit("Denied access");
//初始化当前的觉得路径
define('ROOT', str_replace('\\', '/', dirname(dirname(__FILE__))) . '/');
// echo ROOT;
define('DEBUG',true);



//引入各种类
// require(ROOT . 'include/db.class.php');
// require(ROOT . 'include/conf.class.php');
// require(ROOT . 'include/log.class.php');
require(ROOT . 'include/lib_base.php');
// require(ROOT . 'include/mysql.class.php');
// require(ROOT . 'model/Model.class.php');
// require(ROOT . 'model/ModelTest.class.php');
//实现自动加载 此函数在需要用到类名的时候自动执行
// 类名与磁盘上文件的映射规则: M: 项目根目录 model文件夹下 类名.class.php
//                          基本类：项目根目录 include文件夹下 类名.class.php
function __autoload($class) {
    if (substr($class, 0, 5) == 'Model') {
        require(ROOT . 'model/' . $class . '.class.php');
    }
else if (substr($class, 0, 5) == 'Tools') {
        require(ROOT . 'tools/' . $class . '.class.php');
    }
else {
        require(ROOT . 'include/' . $class . '.class.php');
    }
}

// 开启session  一定要放在框架里面 不然session里面不能存放自定义的类型
session_start();


//过滤参数 用递归的方式过滤$_GET, $_POST, $_COOKIE
$_GET    = _addslashes($_GET);
$_POST   = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);


//设置报错级别
if(defined('DEBUG')) {
	error_reporting(E_ALL);
} else {
	error_reporting(0);
}








?>