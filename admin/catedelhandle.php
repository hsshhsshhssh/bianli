<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/5
 * Time: 12:18
 * file: catedelhandle.php  处理栏目删除
 */
require_once('./common/include.php');

// 生成数据库实例
$mu = new ModelUser('bl_cate');

//判断操作类型 query为查询要删除的栏目是否存在子栏目 delete为软删除
$type = $_POST['type'];
$cate_id = $_POST['cate_id'] + 0;

// 查询
if($type == 'query') {
    $sql = "select count(c2.cate_id) from bl_cate as c1 left join bl_cate as c2 on c1.cate_id=c2.parent_id where c1.cate_id=" . $cate_id;
    $res = $mu->getOne($sql);
    echo $res; return;
}
// 软删除
else if($type == 'delete'){

    // 把要删除的栏目中所有的子栏目找出 把要删除的id全部放在allid中
    $sql = "select * from bl_cate";
    $res = $mu->getAll($sql);
    $childrenid = ToolsInfClassify::ChildrenId($res, $cate_id);
    $allid = array_merge(array($cate_id), $childrenid);

    $arr = array(
       'is_delete' => 1
    );
    $where = 'cate_id in(' . implode(',', $allid) . ')';
    $res = $mu->update($arr, $where);
    if($res != count($allid)) {
        // 删除失败
        echo '1'; return;
    }
    else {
        // 删除成功
        echo '0'; return;
    }
}