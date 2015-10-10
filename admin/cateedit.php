<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 20:41
 * file: cateedit.php  栏目管理
 */
require_once('./common/include.php');

$cate_id = $_GET['cate_id']+0;

// 实例化数据库对象
$mu = new ModelUser('bl_cate');

// 获取全部栏目
$field = array('cate_id', 'cate_name', 'parent_id', 'cate_desc');
$res = $mu->select($field, 'is_delete=0 order by cate_id');
$catelist = ToolsInfClassify::ClassifyForOne($res);
//print_r($catelist);

// 获取当前栏目的信息
$sql = "select c1.*,c2.cate_name as parent_name from bl_cate as c1 left join bl_cate as c2 on c1.parent_id=c2.cate_id where c1.cate_id=" . $cate_id;
$cateinfo = $mu->getRow($sql);
//print_r($cateinfo);

require(ROOT . 'view/admin/templates/cateedit.html');