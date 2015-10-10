<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/9
 * Time: 19:27
 * 订单提交处理
 */
require_once('./common/include.php');

// 先判断是否已经登录
if(!isset($_SESSION['name'])) {
    header("location: " . 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/login.php');
}

$moi = new ModelOrderInfo('bl_order_info');
$mog = new ModelOrderGoods('bl_order_goods');

// 获得用户id
$user_id = $mu->getOne("select id from bl_user where username=\"" . $_SESSION['name'] . '"');

// 支付方式
$pay_type = $_POST['pay_type'] ? 1 : 0;

// 生成订单号
$order_sn = ToolsGoodsSn::GetOrderSn();

// 写一条数据到 bl_order_info
$data = array(
    'order_sn' => $order_sn,
    'reciver' => $_POST['name'],
    'user_id' => $user_id,
    'tel' => $_POST['tel'],
    'zone' => $_POST['zone'],
    'address' => $_POST['address'],
    'zipcode' => $_POST['zipcode'],
    'order_time' => time(),
    'pay_type' => $pay_type,
    'total_price' => $cart->getTotalPrice()
);

// 新插入订单信息
$order_id = $moi->insertOrder($data);
//插入失败
if($order_id === false) {
    echo json_encode(array(
        'status'=> 1
    ));
    return;
}


// 写入n条数据到bl_order_goods表 知道购物车为空
while(!$cart->isEmpty()) {
    $mog->writeAllItem($order_id, $order_sn, $user_id);
}

echo json_encode(array(
    'status'=> 0,
    'order_sn' => $order_sn
));
