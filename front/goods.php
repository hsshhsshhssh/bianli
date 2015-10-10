<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 14:08
 * file: front/goods.php  前端的商品页
 */
require_once('./common/include.php');

// 获得商品信息
$goods_id = isset($_GET['goods_id'])? $_GET['goods_id'] : 12;

$sql = "select * from bl_goods where goods_id=" . $goods_id;
$goodsinfo = $mg->getRow($sql);
if(!$goodsinfo) {
    header('location: ' . 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/index.php');
}

// 获得导航条的参数
$navlist = ToolsInfClassify::FamilyTree($ALLCATE, $goodsinfo['cate_id']);


// 本周热销
$hotlist = $mg->select(array('goods_id','goods_name','goods_price','goods_img'),'is_hot order by sale_total desc limit 0,3');
// 本周新品
$newlist = $mg->select(array('goods_id','goods_name','goods_price','goods_img'),'is_new order by sale_total desc limit 0,3');

require(ROOT . 'view/front/goods.html');