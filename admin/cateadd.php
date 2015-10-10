<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 20:40
 * file: cateadd.php  栏目添加
 */

require_once('./common/include.php');

$mu = new ModelUser('bl_cate');
$sql = 'select * from bl_cate where 1 order by cate_id ';
$res = $mu->getAll($sql);

// 无限极分类 返回 一维数组
$catelist = ToolsInfClassify::ClassifyForOne($res);

require(ROOT . 'view/admin/templates/cateadd.html');