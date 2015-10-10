<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/9
 * Time: 20:58
 * 支付页面
 */
require_once('./common/include.php');

// 先判断是否已经登录
if(!isset($_SESSION['name'])) {
    header("location: " . 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/login.php');
}

$order_sn = isset($_GET['order_sn']) ? $_GET['order_sn'] : '';


$moi = new ModelOrderInfo('bl_order_info');
$sql = "select * from bl_order_info where order_sn='" . $order_sn  . "'";
$oi = $moi->getRow($sql);

if(!$oi) {
    exit('订单不存在');
}

require(ROOT . 'view/front/pay.html');