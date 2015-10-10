<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 14:25
 * file: goodslist.php  后台商品列表
 */

require_once('./common/include.php');

// 实例栏目数据库
$mu = new ModelUser('bl_cate');

// 获取要显示的栏目 cate_id
if(!isset($_GET['cate_id']) || intval($_GET['cate_id']) < 1 ) {
    $cate_id = 1;
}
else {
    $cate_id = $_GET['cate_id'] + 0;
}

// 获取所有栏目
$res = $mu->select(array('cate_id','cate_name','parent_id'), "is_delete=0 order by cate_id");
$catelist = ToolsInfClassify::ClassifyForOne($res);
//print_r($catelist);

// 获取该栏目下所有的子栏目
$allCateId = ToolsInfClassify::ChildrenId($res, $cate_id);
array_unshift($allCateId, $cate_id);
//print_r($allCateId);
$inCateId = '(' . implode(',', $allCateId) . ')';

// 分页显示
// 每页显示的条数
$list_per_page = 10;
// 总条数
$sql = 'select count(*) from bl_goods where cate_id in ' . $inCateId . ' && is_delete=0';
$list_total = $mu->getOne($sql);
// 总页数
$page_total = ceil($list_total / $list_per_page);
// 获得当前显示的页
if (!isset($_GET['page']) || intval($_GET['page']) < 1) {
    $page = 1;
} else if (intval($_GET['page']) > $page_total) {
    $page = $page_total;
} else {
    $page = intval($_GET['page']);
}
// 获得要显示的页码数组
$result = ToolsPage::DividePage($list_per_page, $list_total, $page, 'goodslist.php?cate_id=' . $cate_id);
$pages = $result['pages'];
$html = $result['html'];
//echo $result['html'];die();

// 获得cate_id栏目下的所有商品  从($page-1)*$list_per_page条开始取 取$list_per_page条
$sql = "select g.* from bl_goods as g left join bl_cate as c on g.cate_id=c.cate_id where c.cate_id in (" . implode(',', $allCateId) . ') && g.is_delete=0 limit ' . ($page-1)*$list_per_page . ',' . $list_per_page;
$goodslist = $mu->getAll($sql);


require(ROOT . '/view/admin/templates/goodslist.html');