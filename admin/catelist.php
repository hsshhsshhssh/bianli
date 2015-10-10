<?php 
/**
file: amdin/drag.php
功能: MVC中的控制器 负责显示view/admin/templates/catelist.html
**/

require_once('./common/include.php');

// 实例化数据库
$mu = new ModelUser('bl_cate');

// 因为需要无限极分类所以不能分页
//// 分页显示
//// 每页显示的条数
//$list_per_page = 5;
//// 总条数
//$sql = 'select count(*) from bl_cate where is_delete=0';
//$list_total = $mu->getOne($sql);
//// 获得当前显示的页
//$page_total = ceil($list_total / $list_per_page);
//if (!isset($_GET['page']) || intval($_GET['page']) < 1) {
//    $page = 1;
//} else if (intval($_GET['page']) > $page_total) {
//    $page = $page_total;
//} else {
//    $page = intval($_GET['page']);
//}
//// 获得要显示的页码数组和分页的html代码
//$result = ToolsPage::DividePage($list_per_page, $list_total, $page, 'catelist.php?cate_id=1');
//$pages = $result['pages'];
//$html = $result['html'];
////echo $page;
//
//// 根据分类的结果取出数据
//$sql = 'select * from bl_cate where is_delete=0  order by cate_id limit ' . ($page-1)*$list_per_page . ',' . $list_per_page;
//$res = $mu->getAll($sql);

// 无需分页的话 直接取就行了
$sql = "select * from bl_cate where is_delete=0 order by cate_id";
$res = $mu->getAll($sql);
// 无限极分类 返回 一维数组
$catelist = ToolsInfClassify::ClassifyForOne($res);



include(ROOT . 'view/admin/templates/catelist.html');

 ?>