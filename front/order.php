<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/9
 * Time: 16:46
 * 订单填写
 */

require_once('./common/include.php');

if(!isset($_SESSION['name'])) {
    header("location: " . 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/login.php');
}

// 获得购物车内容
$shopping_cart = $cart->getItems();

require(ROOT . 'view/front/order.html');