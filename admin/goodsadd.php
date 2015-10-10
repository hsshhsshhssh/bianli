<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/4
 * Time: 14:29
 * file: goodsadd.php 后台添加商品
 */

require_once('./common/include.php');

// 实例栏目数据库
$mu = new ModelUser('bl_cate');

// 获取所有栏目
$res = $mu->select(array('cate_id','cate_name','parent_id'), "is_delete=0 order by cate_id");
$catelist = ToolsInfClassify::ClassifyForOne($res);
//print_r($catelist);

require(ROOT . 'view/admin/templates/goodsadd.html');