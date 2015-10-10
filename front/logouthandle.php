<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/8
 * Time: 9:25
 * 退出登录
 */
require_once('./common/include.php');

//echo session_save_path();die();

if($_SESSION['cart'] instanceof ToolsShoppingCart) {
    // 购物车里有内容

    // 存入文件中
    $shoppingCart = serialize($_SESSION['cart']) ;
    $file = ROOT . 'data/shoppingCart/' . $_SESSION['name'];
    file_put_contents($file, $shoppingCart);


    // 存入数据库中



    // 删除购物车
    unset($_SESSION['cart']);
}

if(isset($_SESSION['name'])) {
    unset($_SESSION['name']);
    setcookie('name', '', time()-1);
}

header('location: ' . 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/index.php');