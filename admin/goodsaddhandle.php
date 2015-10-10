<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 12:05
 * file: goodsaddhandles.php
 */
require_once('./common/include.php');

// 获取数据库实例
$mu = new ModelUser('bl_goods');

// 补充部分数据
$goods_sn = empty($_POST['goods_sn']) ? ToolsGoodsSn::GetGoodsSn() : $_POST['goods_sn']; // 获得唯一的货单号
$goods_weight = empty($_POST['goods_weight']) ? '0' : $_POST['goods_weight'];
$goods_total = empty($_POST['goods_total']) ? 0 : $_POST['goods_total'] + 0;

// 移动照片
$tempimg = ROOT . 'data/images/temp/' . $_POST['goods_img'];
$img = ROOT . 'data/images/goods/' . $_POST['goods_img'];
if(!is_file($tempimg) || !rename($tempimg, $img) ) {
    echo "1"; return;
}
//并生成400*400中图 和1000*1000的大图
ToolsImage::ResizeImage($img, 400, 400, 'mid');
ToolsImage::ResizeImage($img, 1000, 1000, 'big');


$data = array(
    'goods_name' => $_POST['goods_name'],
    'cate_id' => $_POST['cate_id'] + 0,
    'goods_time' => time(),
    'goods_sn' => $goods_sn,
    'goods_price' => $_POST['goods_price'],
    'price_unit' => '1',
    'goods_weight' => $goods_weight,
    'weight_unit' => "1",
    'goods_total' => $goods_total,
    'is_best' => $_POST['is_best'] + 0,
    'is_new' => $_POST['is_new'] + 0,
    'is_hot' => $_POST['is_hot'] + 0,
    'is_delete' => 0,
    'on_sale' => $_POST['on_sale'] + 0,
    'goods_key' => $_POST['goods_key'],
    'goods_img' =>  $img,
    'goods_desc' => $_POST['goods_desc'],
    'goods_details' => $_POST['goods_details'],
    'seller_note' => $_POST['seller_note']
);

$res = $mu->insert($data);
//echo $res;
if($res != 1) {
    echo "1";return;
}
else {
    echo "0";return;
}

// 生成唯一的货号
