<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/8
 * Time: 20:25
 * 结算页面
 */
require_once('./common/include.php');


//获得要操作的类型
$type = isset($_GET['type'])? $_GET['type'] : '';


if($type == 'buy') {  // 购买商品

    // 获得要操作的goods_id
    if(!isset($_GET['goods_id']) || $_GET['goods_id'] <=0 ) {
        exit('商品不存在');
    }
    $goods_id = intval($_GET['goods_id']);

    $sql = "select goods_id,goods_name,goods_price,goods_img,goods_total from bl_goods where goods_id=" . $goods_id;
    $goodsinfo = $mg->getRow($sql);
    if(!$goodsinfo) {
        // 商品不存在
        exit('商品不存在');
    }

    if(!isset($_GET['num']) || $_GET['num'] <1 ) {
        exit('操作不合法');
    }
    $num = intval($_GET['num']);
    // 添加商品到购物车
    $cart->addItem($goodsinfo, $num);
}
else if($type == 'del') {  // 删除某一个商品
    // 获得要操作的goods_id
    if(!isset($_GET['goods_id']) || $_GET['goods_id'] <=0 ) {
        exit('商品不存在');
    }
    $goods_id = intval($_GET['goods_id']);

    // 从购物车删除商品
    $cart->delItem($goods_id);
}
else if ($type == 'clr') {  // 清空购物车
    $cart->clear();
}
else if($type == 'inc_one') { // 商品加一
    // 获得要操作的goods_id
    if(!isset($_GET['goods_id']) || $_GET['goods_id'] <=0 ) {
        exit('商品不存在');
    }
    $goods_id = intval($_GET['goods_id']);

    // 商品加一
    $cart->incOne($goods_id);
}
else if($type == 'dec_one') { // 商品减一
    // 获得要操作的goods_id
    if(!isset($_GET['goods_id']) || $_GET['goods_id'] <=0 ) {
        exit('商品不存在');
    }
    $goods_id = intval($_GET['goods_id']);

    // 商品加一
    $cart->decOne($goods_id);

}







// 获得购物车了的所有商品
$shopping_cart = $cart->getItems();


require(ROOT . 'view/front/flow.html');

