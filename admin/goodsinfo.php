<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 21:26
 * file: goodsinfo.php 查看商品
 */
require_once('./common/include.php');

//实例化数据库
$mu = new ModelUser('bl_goods');

// 获得商品good_id
if(!isset($_GET['goods_id']) || intval($_GET['goods_id'])<1) {
    exit('商品不存在');
}
$goods_id = intval($_GET['goods_id']);

//获得商品信息
$sql = "select g.*,c.cate_name from bl_goods as g left join bl_cate as c on g.cate_id=c.cate_id where g.goods_id=" . $goods_id;
$gi= $mu->getRow($sql);
//print_r($gi);

// 修改时间样式
$gi['goods_time'] = date('Y-m-d H:i:s', $gi['goods_time']);
// 更改图片路径
$basename =  basename(dirname(dirname(__FILE__)));
$gi['goods_img'] = '/' . strstr($gi['goods_img'], $basename);
//echo $gi['goods_time'];
require(ROOT . 'view/admin/templates/goodsinfo.html');
