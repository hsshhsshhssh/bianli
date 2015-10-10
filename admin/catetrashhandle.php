<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/5
 * Time: 14:15
 * file: catetrashhandle 栏目回收站的处理 有还原和彻底删除
 */
require_once('./common/include.php');

$cate_id = $_POST['cate_id'] + 0;
$parent_id = $_POST['parent_id'] + 0;
$type = $_POST['type']; // return 代表还原 drop代表彻底删除

// 创建数据库实例
$mu = new ModelUser('bl_cate');

// 还原
if($type == 'return') {

    // 先判断父栏目是否存在 不存在的话 不能还原
    $allDelId = $mu->getOneAllValue('cate_id','is_delete=1');
//    print_r($allDelId);return;
    if(in_array($parent_id, $allDelId)) {
        // 父栏目在回收站中 还原失败 应该先还原父栏目
        echo "2";return;
    }

    $arr = array('is_delete'=>0);
    $res = $mu->update($arr, 'cate_id=' . $cate_id);
    if($res != 1) {
        // 还原失败
        echo '1';return;
    }
    else {
        // 还原成功
        echo '0';return;
    }
}

// 彻底删除
else if($type = 'drop') {
    $res = $mu->delete('cate_id=' . $cate_id);
    if($res != 1) {
        // 彻底删除失败
        echo '1';return;
    }
    else {
        // 彻底删除成功
        echo '0';return;
    }
}