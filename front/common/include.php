<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 15:03
 * file: fron/common/inlcude.php  用于每一个控制器的include头
 */


define('HSSH', true);
require_once('../include/init.php'); // include.php 是被包含的 不能以include.php为相对路径 应该以包含的文件以相对路径

// 实例化数据库
$mu = new ModelUser('bl_user');
$mc = new ModelCate('bl_cate');
$mg = new ModelGoods('bl_goods');


// 得到购物车实例
$cart = ToolsShoppingCart::GetCart();

// 获得登录用户名 如果有的话 先判=判断是否设置cookie
if(!empty($_COOKIE['name'])) {
    $_SESSION['name'] = $_COOKIE['name']; // 允许的话 可以判断name是否合法
}


if(isset($_SESSION['name'])) {
    $username = $_SESSION['name'];

}
else {
    $username = '';
}

// 获得所有栏目
//$sql = 'select * from bl_cate where is_delete=0 order by cate_id';
$ALLCATE = $mc->select(array('cate_id','cate_name', 'parent_id'), 'is_delete=0 order by cate_id');




