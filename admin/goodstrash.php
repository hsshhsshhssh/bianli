<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 20:19
 * files: goodstrash.php
 */

require_once('./common/include.php');

// 实例化数据库 注意 不是用bl_goods 是用 bl_cate
$mu = new ModelUser('bl_cate');

if(!isset($_GET['cate_id']) || intval($_GET['cate_id']) < 1 ) {
    $cate_id = 1;
}
else {
    $cate_id = $_GET['cate_id'] + 0;
}

// 获取所有栏目
$res = $mu->select(array('cate_id','cate_name','parent_id'), "1 order by cate_id");
$catelist = ToolsInfClassify::ClassifyForOne($res);
//print_r($catelist);

// 获取该栏目下所有的子栏目
$allCateId = ToolsInfClassify::ChildrenId($res, $cate_id);
array_unshift($allCateId, $cate_id);
//print_r($allCateId);

// 获得cate_id栏目下的所有商品
$sql = "select g.* from bl_goods as g left join bl_cate as c on g.cate_id=c.cate_id where c.cate_id in (" . implode(',', $allCateId) . ') && g.is_delete=1';
$goodslist = $mu->getAll($sql);



require(ROOT . 'view/admin/templates/goodstrash.html');
