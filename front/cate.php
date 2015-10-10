<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 14:13
 * file: front/cate.php 前端的栏目页
 */

require_once('./common/include.php');

// 获得导航条的参数
$cate_id = isset($_GET['cate_id'])? $_GET['cate_id'] : 1;
$navlist = ToolsInfClassify::FamilyTree($ALLCATE, $cate_id);
//print_r($navlist);

// 获得子栏目
$cur_catelist = ToolsInfClassify::ClassifyForMul($ALLCATE, $cate_id);
if(!$cur_catelist) {
    // 没有子栏目 取父栏目的子栏目
    $parent_id = ToolsInfClassify::FamilyTree($ALLCATE,$cate_id)[1]['cate_id'];
    $cur_catelist = ToolsInfClassify::ClassifyForMul($ALLCATE, $parent_id);
}
//print_r($cur_catelist);die();

// 本周热销
$hotlist = $mg->select(array('goods_id','goods_name','goods_price','goods_img'),'is_hot order by sale_total desc limit 0,3');
// 本周新品
$newlist = $mg->select(array('goods_id','goods_name','goods_price','goods_img'),'is_new order by sale_total desc limit 0,3');


// 或的该栏目下的所有商品
$allCateId = ToolsInfClassify::ChildrenId($ALLCATE, $cate_id);
array_unshift($allCateId, $cate_id);


// 分页显示
$list_per_page = 16; // 每页显示的条数
$sql = 'select count(*) from bl_goods where cate_id in (' . implode(',', $allCateId) . ')';
$list_total = $mg->getOne($sql); // 显示的总条数
$page_total = ceil($list_total / $list_per_page);  // 总页数
// 获得当前显示的页
if (!isset($_GET['page']) || intval($_GET['page']) < 1) {
    $page = 1;
} else if (intval($_GET['page']) > $page_total) {
    $page = $page_total;
} else {
    $page = intval($_GET['page']);
}

// 获得要显示的页码数组
$result = ToolsPage::DividePage($list_per_page, $list_total, $page, 'cate.php?cate_id=' . $cate_id);
$pages = $result['pages'];
$html = $result['html'];

$sql = "select g.goods_id,g.goods_name,g.cate_id,g.goods_price,g.goods_img from bl_goods as g where g.cate_id in (" . implode(',', $allCateId) . ') limit ' . ($page-1)*$list_per_page . ',' . $list_per_page;
$goodslist = $mg->getAll($sql);
//print_r($goodslist);die();

require(ROOT . 'view/front/cate.html');