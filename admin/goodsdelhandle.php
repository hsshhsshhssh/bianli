<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 20:00
 * file: goodsdelhandle.php 删除商品 get入goods_id
 */

require_once('./common/include.php');

// 实例化数据库
$mu = new ModelUser('bl_goods');

// 获得删除的goods_id
if(!isset($_GET['goods_id']) || intval($_GET['goods_id']) < 1) {
    echo "1"; return;
}
$goods_id = intval($_GET['goods_id']);

$res = $mu->update(array('is_delete'=>1), 'goods_id=' . $goods_id);
if($res != 1) {
    echo "1"; return;
}
else {
    echo "0"; return;
}