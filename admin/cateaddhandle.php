<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/5
 * Time: 11:45
 * file: cateaddhandle.php  处理添加栏目
 */
require_once('./common/include.php');

// 获取数据库实例
$mu = new ModelUser('bl_cate');

// 获得插入的数据
$arr = array(
    'cate_name' => $_POST['cate_name'],
    'parent_id' => $_POST['parent_id'],
    'cate_desc' => $_POST['cate_desc']
);

$res = $mu->insert($arr);

// 失败
if($res != 1) {
    echo "1";
}
else {
    echo "0";
}