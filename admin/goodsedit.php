<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/6
 * Time: 22:29
 * file: goodsedit.php 商品编辑页
 */
require_once('./common/include.php');

//实例化数据库
$mu = new ModelUser('bl_goods');

// 获得商品good_id
if(!isset($_GET['goods_id']) || intval($_GET['goods_id'])<1) {
    exit('商品不存在');
}
$goods_id = intval($_GET['goods_id']);

//获得商品信息
$sql = "select g.*,c.cate_name from bl_goods as g left join bl_cate as c on g.cate_id=c.cate_id where g.goods_id=" . $goods_id;
$gi= $mu->getRow($sql);
//print_r($gi);
if(empty($gi)) {
    exit('商品不存在');
}
// 更改图片的
$gi['goods_img'] = basename($gi['goods_img']);


// 实例栏目数据库
$mu = new ModelUser('bl_cate');

// 获取所有栏目
$res = $mu->select(array('cate_id','cate_name','parent_id'), "is_delete=0 order by cate_id");
$catelist = ToolsInfClassify::ClassifyForOne($res);
//print_r($catelist);

require(ROOT . 'view/admin/templates/goodsedit.html');