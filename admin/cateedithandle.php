<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/5
 * Time: 17:55
 * file: cateedithandle.php  编辑栏目信息的处理函数
 */
require_once('./common/include.php');
//print_r($_POST);
$cate_id = $_POST['cate_id'] + 0;
$cate_name = $_POST['cate_name'];
$cate_desc = $_POST['cate_desc'];
$newparent_id = $_POST['parent_id'] + 0;

// 实例化数据库
$mu = new ModelUser('bl_cate');

// 判断新的父栏目是否在子栏目中 如果是的话 就返回错误
$field = array('cate_id', 'parent_id');
$res = $mu->select($field, 'is_delete=0 order by cate_id');
$allChildId = ToolsInfClassify::ChildrenId($res, $cate_id);

// 父栏目选取错误
if(in_array($newparent_id, $allChildId) || $newparent_id == $cate_id) {
    echo '2';return;
}

// 改变父栏目
$arr = array(
    'parent_id' => $newparent_id,
    'cate_name' => $cate_name,
    'cate_desc' => $cate_desc
);
$res = $mu->update($arr, 'cate_id=' . $cate_id);
//echo $res;
if($res != 1) {
    // 编辑失败
    echo '1';return;
}
else {
    // 编辑成功
    echo '0';return;
}


