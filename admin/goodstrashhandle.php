<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 20:50
 *
 */

require_once('./common/include.php');

// 实例化数据库
$mu = new ModelUser('bl_goods');

// 获得操作方法
$type = $_POST['type'];
// 获得要操作的goods_id
if(!isset($_POST['goods_id']) || intval($_POST['goods_id']) < 1) {
    echo "1"; return;
}
$goods_id = intval($_POST['goods_id']);

// 还原被删除的商品
if($type == 'return') {
    $res = $mu->update(array('is_delete'=>0), 'goods_id=' . $goods_id);
    if($res != 1) {
        echo "1"; return ;
    }
    else {
        echo "0"; return;
    }
}

else if($type = 'fulldel') {
    $res = $mu->delete('goods_id=' . $goods_id);
    if($res != 1) {
        echo "1";return;
    }
    else {
        echo "0";return;
    }
}

else {
    echo "1";return ;
}
